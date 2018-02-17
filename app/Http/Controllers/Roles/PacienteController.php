<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Role type.
     *
     * @var string
     */
    protected $type = 'paciente';

    /**
     * Views' names for every action.
     *
     * @var array
     */
    protected $views = [
        'index' => 'papeis.paciente.index',
        'create' => 'papeis.paciente.create',
        'show' => 'papeis.show',
    ];

    /**
     * Routes' names for every action.
     *
     * @var array
     */
    protected $routes = [
        'index' => 'pacientes.index',
        'create' => 'pacientes.create',
        'store' => 'pacientes.store',
        'show' => 'pacientes.show',
    ];


    public function __construct()
    {
        $this->middleware('roles:administrador');
    }
    /**
     * Controller's form validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function rules(Request $request)
    {
        return array_add(parent::rules($request),
            'registro', ['required', 'numeric']);
    }

    /**
     * Get keys to be filtered in a specific request for role instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function getRoleDataFromRequest(Request $request)
    {
        return $request->only('registro');
    }

    /**
     * Role's validation rules.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function rulesFromRole(Request $request)
    {
        return array_merge(parent::rulesFromRole($request), [
            'registro'=> ['required', 'numeric'],
        ]);
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
            'pacientes' => Paciente::orderBy('id')->get(),
        ]);
    }

}
