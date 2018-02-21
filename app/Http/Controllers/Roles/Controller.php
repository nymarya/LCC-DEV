<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Administrador;
use App\User;
use Carbon\Carbon;
use App\Models\Perfil;
use App\Models\Endereco;
use App\Models\Escolaridade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Facades\Perfil as Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;
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
            'name' => ['required', 'max:255'],
            'email' => [
                'required', 'string', 'max:255' ,'email', Rule::unique('users')->whereNull('deleted_at'),
            ],
            'password' => ['required', 'max:255','string', 'min:6', 'confirmed'],
        ];
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
            'name',  'email',
        ];

        return array_merge(
            array_keys($this->getUniqueKeysForRequest($request)), $original
        );
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

        if ($email = $request->get('email')) {
            $arr['email'] = $email;
        }

        return $arr;
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
        $usuario = User::when(
            count($keys = $this->getUniqueKeysForRequest($request)),
            function (Builder $query) use ($keys) {
                foreach ($keys as $key => $value) {
                    $query->where($key, $value);
                }
            },
            function (Builder $query) {
                $query->where('email', 0);
            })->first();

        if (! $usuario) {
            $regras = $this->rules($request);
            $this->validate($request, $regras, $this->messages());

            $usuario = User::create(
                array_add($request->only($this->getKeysFromRequest($request)), 'password', bcrypt($request->get('password'))));
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

    protected function messagesFromRole(Request $request)
    {
        return [
            'email.unique' => 'O email cadastrado já existe',
        ];
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
}
