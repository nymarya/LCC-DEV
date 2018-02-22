<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Aluno;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlunoController extends Controller
{
    /**
     * Role type.
     *
     * @var string
     */
    protected $type = 'aluno';

    /**
     * Views' names for every action.
     *
     * @var array
     */
    protected $views = [
        'index' => 'papeis.aluno.index',
        'create' => 'papeis.aluno.create',
        'show' => 'papeis.aluno.show',
    ];

    /**
     * Routes' names for every action.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'alunos.index',
        'create' => 'alunos.create',
        'store' => 'alunos.store',
        'show' => 'alunos.show',
    ];

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
            'alunos' => Aluno::orderBy('id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cadastroAluno(Request $request)
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

        return redirect()->route('login')
            ->with('success', ucfirst($this->type).' foi cadastrado com sucesso, realize seu login!');
    }

}
