<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Administrador;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdministradorController extends Controller
{
    /**
     * Role type.
     *
     * @var string
     */
    protected $type = 'administrador';

    /**
     * Views' names for every action.
     *
     * @var array
     */
    protected $views = [
        'index' => 'papeis.administrador.index',
        'create' => 'papeis.administrador.create',
        'show' => 'papeis.administrador.show',
    ];

    /**
     * Routes' names for every action.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'administradores.index',
        'create' => 'administradores.create',
        'store' => 'administradores.store',
        'show' => 'administradores.show',
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
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            'rg' => ['required', 'string', 'max:30'],
            'nome' => ['required', 'max:255'],
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
            'nome', 'rg',  'email', 'password',
        ];

        return array_merge(
            array_keys($this->getUniqueKeysForRequest($request)), $original
        );
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
            'administradores' => Administrador::orderBy('id')->get(),
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
                $query->where('cpf', 0);
            })->first();

        if (! $usuario) {
            $regras = $this->rules($request);

            $this->validate($request, $regras, $this->messages());

            $usuario = User::create(
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
}
