<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Aluno;
use App\Models\Roles\Professor;
use App\Models\Turma;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class ProfessorController extends Controller
{
    /**
     * Role type.
     *
     * @var string
     */
    protected $type = 'professor';

    /**
     * Views' names for every action.
     *
     * @var array
     */
    protected $views = [
        'index' => 'papeis.professor.index',
        'create' => 'papeis.professor.create',
        'show' => 'papeis.professor.show',
    ];

    /**
     * Routes' names for every action.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'professores.index',
        'create' => 'professores.create',
        'store' => 'professores.store',
        'show' => 'professores.show',
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
            'professores' => Professor::orderBy('id')->get(),
        ]);
    }

    /**
     * Envia os perfis que responderam o questionario
     * enviado pelo email (e que portanto tem
     * endereco cadastrado)
     *
     * @return mixed
     */
    public function alunos(){
        return View::make('papeis.professor.alunos', [
            'alunos' => Aluno::doesnthave('turmas')->get(),
        ]);
    }

    public function matricula_aluno($id){
        return view('papeis.professor.matricula_aluno', [
            'aluno' => Aluno::findOrFail($id),
            'turmas' => Turma::all(),
        ]);
    }

    public function matricular_aluno(Request $request, $id){
        $this->validate($request, [
            'turma_id' => ['required'],
        ]);

        Aluno::findOrFail($id)->turmas()->sync($request->get('turma_id'));

        return Response::redirectToRoute('alunosmatricula')
            ->with('success', 'Aluno matriculado com sucesso.');
    }



}
