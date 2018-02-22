<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Carbon\Carbon;
use App\Facades\Perfil;
use App\Models\RegiaoSaude;
use App\Models\Roles\Aluno;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TurmaController extends Controller
{
  public function __construct()
  {
    $this->middleware('roles:professor');

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('turmas.index', [
            'turmas' => Turma::orderBy('codigo')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('turmas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => [
                'required',
                Rule::unique('turmas')
                    ->whereNull('deleted_at'),
            ],
        ]);

        Turma::create($request->only(
            'codigo'));

        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $turma = Turma::findOrFail($id);

        return view('turmas.show', [
            'turma' => $turma,
            'alunos' => $turma->alunos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        return view('turmas.edit', [
            'turma' => Turma::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'codigo' => ['required'],
        ]);

        $turma = Turma::findOrFail($id);

        $turma->update($request->only([
            'codigo',
        ]));

        return Response::redirectToRoute('turmas.index')
            ->with('success', 'Turma atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        Turma::findOrFail($id)->delete();

        return Response::redirectToRoute('turmas.index')
            ->with('success', 'Turma deletada com sucesso.');
    }

    /**
     * Display a listing of the resource as a Select2-compatible JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $turmas = Turma::all()->orderBy('codigo')->paginate(5);

        return response()->json([
            'results' => $turmas->map(function ($turma) {
                return [
                    'id' => $turma->id,
                    'text' => "Turma {$turma->codigo} ({$turma->id}).",
                ];
            }),
            'pagination' => [
                'more' => $turmas->hasMorePages(),
            ],
        ]);
    }
}
