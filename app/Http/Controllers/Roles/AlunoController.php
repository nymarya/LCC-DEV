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
}
