<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Professor;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
}
