<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\Administrador;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
        'create' => 'papeis.create',
        'show' => 'papeis.show',
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
}
