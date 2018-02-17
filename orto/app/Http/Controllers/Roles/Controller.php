<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Administrador;
use Carbon\Carbon;
use App\Models\Perfil;
use GuzzleHttp\Client;
use App\Models\Usuario;
use App\Models\Endereco;
use App\Models\Escolaridade;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Models\Foundation\Pais;
use Illuminate\Validation\Rule;
use App\Models\Foundation\Etnia;
use App\Models\Foundation\Genero;
use App\Facades\Perfil as Profile;
use App\Mail\AlertarUsuarioCriado;
use App\Mail\AlertaNovoPerfilCriado;
use Illuminate\Support\Facades\Mail;
use App\Models\Foundation\PovoIndigena;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Foundation\UnidadeFederativa;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * Role type.
     *
     * @var string
     */
    protected $type;

    /**
     * Views' names for every action.
     *
     * @var array
     */
    protected $views = [
        'create' => 'papeis.create',
    ];

    /**
     * Routes' names for every action.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'papeis.index',
        'create' => 'papeis.create',
        'store' => 'papeis.store',
        'show' => 'papeis.show',
    ];

    /**
     * Controller's form validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function rules(Request $request)
    {
        return [
            'cpf' => [
                'required', 'numeric', 'digits:11', 'cpf',
                Rule::unique('usuarios')->whereNull('deleted_at'),
            ],
            'rg' => ['required', 'string', 'max:30'],
            'nome' => ['required', 'max:255'],
            'email' => [
                'nullable', 'email', Rule::unique('usuarios')->whereNull('deleted_at'),
            ],
        ];
    }

    /**
     * Get used unique key (CPF or passport) for a specific request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function getUniqueKeysForRequest(Request $request)
    {
        $arr = [];

        if ($cpf = $request->get('cpf')) {
            $arr['cpf'] = $cpf;
        }

        return $arr;
    }

    /**
     * Get keys to be filtered in a specific request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function getKeysFromRequest(Request $request)
    {
        $original = [
            'nome', 'rg',  'email',
        ];

        return array_merge(
            array_keys($this->getUniqueKeysForRequest($request)), $original
        );
    }

    /**
     * Get keys to be filtered in a specific request for role instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function getRoleKeysFromRequest(Request $request)
    {
        return [];
    }

    /**
     * Get data to be assigned to a role instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function getRoleDataFromRequest(Request $request)
    {
        return $request->only($this->getRoleKeysFromRequest($request));
    }

    /**
     * @return Model
     */
    public function getType()
    {
        return array_get(Relation::morphMap(), $this->type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $this->getType();
        return view($this->views['index'], [
            'tipo' => (new $type)->getTable(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->views['create'], [
            'rota' => $this->routes['store'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $usuario = Usuario::when(
            count($keys = $this->getUniqueKeysForRequest($request)),
            function (Builder $query) use ($keys) {
                foreach ($keys as $key => $value) {
                    $query->where($key, $value);
                }
            },
            function (Builder $query) {
                $query->where('cpf', 0);
            })->first();

        if (! $usuario) {
            $regras = $this->rules($request);

            $this->validate($request, $regras, $this->messages());

            if ($request->has('email')) {
                $resposta = (new Client())->post('https://api.sabia.ufrn.br/usuarios/', [
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Token ' . env('SABIA_ID'),
                    ],
                    RequestOptions::FORM_PARAMS => [
                        'cpf' => $request->get('cpf'),
                        'email' => $request->get('email'),
                        'nome' => $request->get('nome_civil'),
                        'genero' => $request->get('sexo'),
                        'data_de_nascimento' => Carbon::createFromFormat(
                            'd/m/Y', $request->get('data_nascimento')
                        )->format('Y-m-d'),
                    ],
                ]);

                switch ($resposta->getStatusCode()) {
                    case 200:
                        break;
                    case 201:
                        break;
                    default:
                        return Redirect::back()->with(
                            'error',
                            'Ocorreu um problema ao criar esse usuário.'
                        );
                        break;
                }
            }

            $usuario = Usuario::create(
                $request->only($this->getKeysFromRequest($request)));
        } else {
            $this->validate($request, $this->rulesFromRole($request), $this->messagesFromRole($request));
        }
        $usuario->perfis()->create(['tipo' => $this->type])->papel()->create(
            $this->getRoleDataFromRequest($request)
        );


        return redirect()->route($this->routes['index'])
            ->with('success', ucfirst($this->type).' foi cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = $this->getType();

        return view($this->views['show'], [
            'usuario' => $type::findOrFail($id),
            'tipo' => (new $type)->getTable(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = $this->getType();

        $type::findOrFail($id)->delete();

        return redirect()->route($this->routes['index'])
            ->with('success', 'Vínculo removido com sucesso.');
    }
    /**
     *Role's validation rules.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function rulesFromRole(Request $request)
    {
        return [];
    }

    /**
     * Custom error messages.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function messages()
    {
        return [
            'cpf' => 'O CPF fornecido não é válido',
        ];
    }

    protected function messagesFromRole(Request $request)
    {
        return [
            'cpf' => 'O CPF fornecido não é válido',
            'email.unique' => 'O email cadastrado já existe',
        ];
    }
}
