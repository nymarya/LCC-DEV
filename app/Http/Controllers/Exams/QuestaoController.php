<?php

namespace App\Http\Controllers\Exams;

use App\Assunto;
use App\Http\Controllers\Controller;
use App\Models\Midia;
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
        $this->middleware('role:administrador,professor');
        $this->request = $request;
    }

    public function index(){
        return view('questoes.index', [
            'questoes' => Questao::whereNull('deleted_at')->get()
        ]);
    }

    public function create(){
        return view('questoes.create',[
            'assuntos' => Assunto::all(),
        ]);
    }

    public function store() {
        $this->validate($this->request, [
            'assunto_id' => ['required'],
            'questao' => ['required'],
            'alternativas' => ['required', 'array'],
            'alternativas.*.alternativa' => ['required'],
        ]);

        $questao = Questao::create($this->request->only(['questao','assunto_id']));

        if($this->request->file('arquivo')){
            $this->validate($this->request, [
                'arquivo' => [
                    'file',
                ],
            ]);
            Midia::create([
                'arquivo'=> $this->request->file('arquivo')
                    ->store('midias', 'public'),
                'questao_id' => $questao->id,
            ]);

        }

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
            'questao' => $questao,
            'midia' => Midia::where('questao_id',$questao->id)->first(),
        ]);
    }

    public function destroy($id){
        Questao::findOrFail($id)->delete();

        return redirect()->route('questoes.index')->with('success', 'Questão excluída com sucesso');
    }

    public function select(){
        $instrumentos = Questao::when(
            $q = $this->request->input('q'), function ($query) use ($q) {
            return $query->where('questao', $q);
        })->with('assunto')->paginate(20);

        return response()->json([
            'results' => $instrumentos->groupBy('assunto_id')->map(function ($instrumentos, $tipo) {
                return [
                    'text' => $instrumentos->first()->assunto->assunto,
                    'children' => $instrumentos->map(function ($instrumento) {
                        return [
                            'id' => $instrumento->id,
                            'text' => $instrumento->questao ,
                        ];

                    }),
                ];
            })->values(),
            'pagination' => [
                'more' => $instrumentos->hasMorePages(),
            ],
        ]);
    }
}
