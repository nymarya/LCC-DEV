<?php

namespace App\Http\Controllers\Exams;

use App\Assunto;
use App\Facades\Perfil;
use App\Http\Controllers\Controller;
use App\Models\Alternativa;
use App\Models\Bloco;
use App\Models\Prova;
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
            'provas' => Prova::whereNull('deleted_at')->get()
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

        $prova = Prova::create(array_add($this->request->only('turma_id'), 'tipo', 'teste'));

        foreach ( $this->request->input('questoes') as $assuntos){
            foreach ($assuntos as $questao_id){
                if($questao_id != null){
                    Bloco::create([
                        'prova_id' => $prova->id,
                        'questao_id' => $questao_id
                    ]);
                }

            }
        }


        return redirect()->route('provas.index')
            ->with('success', 'Prova cadastrada com sucesso!');

    }

    public function show($id){
        $questao = Prova::findOrFail($id);

        return view('provas.show', [
            'provas' => $questao
        ]);
    }

    public function destroy($id){
        Prova::findOrFail($id)->delete();

        return redirect()->route('provas.index')->with('success', 'Prova excluída com sucesso');
    }

    /**
     * função que verifica acertos do aluno e atribui nota
     */
    public function check(){

        $nota = 0;
        $acertos = 0;

        $questoes = Perfil::papel()->turmas->first()->provas->first()->questoes;

        $aa = [];

        foreach ($questoes as $questao){
            //recupera id da alternativa q o aluno marcou
            $id = intval(6, strlen($this->request->input('questao'.$questao->id))-1);
            dd($id);

            $alternativa = Alternativa::find($id);
            if($alternativa->correta){
                $acertos++;
            }
        }

        dd($acertos);

    }
}
