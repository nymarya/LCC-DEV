<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use App\Models\Questao;
use Illuminate\Http\Request;

class QuestaoController extends Controller
{
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->middleware('role:administrador');
        $this->request = $request;
    }

    public function index(){
        return view('questoes.index', [
            'questoes' => Questao::whereNull('deleted_at')->get()
        ]);
    }

    public function create(){
        return view('questoes.create');
    }

    public function store() {
        $this->validate($this->request, [
            'questao' => ['required'],
            'alternativas' => ['required', 'array'],
            'alternativas.*.alternativa' => ['required'],
        ]);

        $questao = Questao::create($this->request->only('questao'));

        $alternativas = collect($this->request->get('alternativas'))->map(function ($item, $key) {
            if($item['correta'] == null){
                $item['correta'] = false;
            }

            return $item;
        })->toArray();

        $questao->alternativas()
            ->createMany($alternativas);

        //continua na mesma tela para facilitar o cadastro de varias questoes
        return redirect()->route('questoes.create')
            ->with('success', 'Questão cadastrada com sucesso!');

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
