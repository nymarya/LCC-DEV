<?php

namespace App\Http\Controllers\Exams;

use App\Assunto;
use App\Facades\Perfil;
use App\Http\Controllers\Controller;
use App\Models\Questao;
use App\Models\Turma;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('role:professor');
        $this->request = $request;
    }

    public function index(){
        return view('provas.index', [
            'provas' => Questao::whereNull('deleted_at')->get()
        ]);
    }

    public function create(){
        return view('provas.create',[
            'turmas' => Turma::whereNull('deleted_at')->get(),
            'assuntos' => Assunto::with('questoes')->whereNull('deleted_at')->get(),
        ]);
    }

    public function store() {
        $this->validate($this->request, [
            'turma_id' => ['required'],
            'questoes' => ['required', 'array'],
        ]);

        $turma = Turma::findOrFail(intval($this->request->input('turma_id')));


        return redirect()->route('provas.create')
            ->with('success', 'Prova cadastrada com sucesso!');

    }

    public function show($id){
        $questao = Questao::findOrFail($id);

        return view('questoes.show', [
            'questao' => $questao
        ]);
    }

    public function destroy($id){
        Questao::findOrFail($id)->delete();

        return redirect()->route('questoes.index')->with('success', 'Questão excluída com sucesso');
    }
}
