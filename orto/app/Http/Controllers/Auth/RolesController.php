<?php

namespace App\Http\Controllers\Auth;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Http\Middleware\VerifyRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Facades\Perfil as PerfilFacade;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, VerifyRole $manager)
    {
        $perfis = $request->user()->perfis()->with('papel')->get();



        return view('auth.roles.select', [
            'perfis' => $request->user()->perfis()
                ->withTrashed()->get(),
            'ativos' => $perfis,
            'inativos' => $request->user()->perfis()
                ->onlyTrashed()->get(),
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Middleware\VerifyRole  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'perfil_id' => 'required|numeric',
        ]);

        PerfilFacade::definir(
            Perfil::findOrFail($request->input('perfil_id'))
        );

        return redirect('/');
    }
}
