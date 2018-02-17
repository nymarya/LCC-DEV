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

        //Verificação se há apenas um perfil e redirecionamento para página inicial
        if (count($perfis) == 1) {
            PerfilFacade::definir($perfis->first());

            return Redirect::to('/');
            //Caso tenha mais de um perfil e apenas um ativo, redireciona pra pagina inicial
            //com o perfil ativo
        } elseif (count($perfis) > 1) {
            if ($perfis->count('deleted_at') == 1) {
                PerfilFacade::definir($perfis->where('deleted_at', null)->first());

                return Redirect::to('/');
            }
        }
        
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
