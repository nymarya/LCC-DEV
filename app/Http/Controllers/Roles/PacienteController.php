<?php

namespace App\Http\Controllers\Roles;

use App\Models\PlanoSaude;
use App\Models\Roles\Paciente;
use App\Models\Vinculo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        return array_merge(parent::rules($request),[
                'registro' => ['required', 'numeric'],
        ]);
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
            'registro'=> ['required','numeric'],
            'admissao' => ['required'],
            'nome' => ['required'],
            'quant_mot' => ['required', 'numeric'],
            'quant_resp' => ['required', 'numeric'],
            'plano_saude_id' => ['required', 'numeric', 'exists:planos_saude,id'],
            'local_id' => ['required', 'numeric', 'exists:planos_saude,id'],
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
            //'pacientes' => Paciente::orderBy('id')->get(),
            'vinculos' => Vinculo::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rulesFromRole($request));

        $paciente = Paciente::withTrashed()->where('registro', $request->only('registro')['registro'])->first();

        if($paciente == null){
            $usuario = User::create([
                'name' => $request->only('nome')['nome']
            ]);

            $paciente = $usuario->perfis()->create(['tipo' => $this->type])->papel()->create(
                $this->getRoleDataFromRequest($request));
        }

        $request->request->add(['paciente_id' => $paciente->id]);

        Vinculo::create(
            $request->only('admissao', 'quant_mot', 'quant_resp',
                'plano_saude_id', 'local_id', 'paciente_id' )
        );

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente cadastrado com sucesso!');
    }

    public function edit($id)
    {
        return view('papeis.paciente.edit', [
            'vinculo' => Vinculo::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $regras = $this->rulesFromRole($request);

        unset($regras['registro']);

        $this->validate($request, $regras);

        $vinculo = Vinculo::findOrFail($id);

        $vinculo->update(
            $request->only('admissao', 'quant_mot', 'quant_resp',
                'plano_saude_id', 'local_id', 'paciente_id' )
        );

        $vinculo->paciente->perfil->usuario->update([
            'name' => $request->only('nome')['nome']
        ]);

        return Redirect::route('pacientes.index')
            ->with('success', 'Paciente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Vinculo::findOrFail($id)->delete();
        
        return redirect()->route($this->routes['index'])
            ->with('success', 'Vínculo removido com sucesso.');
    }
}
