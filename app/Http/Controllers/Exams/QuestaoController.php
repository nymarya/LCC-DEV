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
        $this->middleware('auth');
        $this->request = $request;
    }

    public function index(){
        return view('questoes.index');
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

        $questao->alternativas()
            ->createMany($this->request->get('alternativas'));

        //continua na mesma tela para facilitar o cadastro de varias questoes
        return redirect()->route('questoes.create')
            ->with('success', 'Questão cadastrada com sucesso!');

    }
}
