<?php

namespace App\Http\Controllers;

use App\Models\PlanoSaude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PlanoSaudeController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('role:administrador');
        $this->request = $request;
    }

    public function index()
    {
        return Response::view('plano_saude.index', [
            'planos' => PlanoSaude::all(),
        ]);
    }

    public function create()
    {
        return Response::view('plano_saude.create');
    }

    public function store()
    {
        $this->validate($this->request, [
            'nome' => 'required',
            'motora_UTI' => ['required', 'numeric'],
            'motora_APT' => ['required', 'numeric'],
            'resp_UTI' => ['required', 'numeric'],
            'resp_APT' => ['required', 'numeric'],
        ]);

        PlanoSaude::create(
            $this->request->only([
                'nome', 'resp_APT', 'motora_UTI', 'motora_APT', 'resp_UTI'
            ])
        );

        return redirect()->route('planos.index')
            ->with('success', 'Plano de saúde criado com sucesso!');

    }

    public function edit($id)
    {
        return Response::view('plano_saude.edit', [
            'plano' => PlanoSaude::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'motora_UTI' => ['required', 'numeric'],
            'motora_APT' => ['required', 'numeric'],
            'resp_UTI' => ['required', 'numeric'],
            'resp_APT' => ['required', 'numeric'],
        ]);

        PlanoSaude::findOrFail($id)
            ->update($request->only([
                'nome', 'resp_APT', 'motora_UTI', 'motora_APT', 'resp_UTI',
                ]));

        return redirect()->route('planos.index')
            ->with('success', 'Plano modificado com sucesso!');
    }

    public function destroy($id)
    {

        PlanoSaude::findOrFail($id)->delete();

        return redirect()->route('planos.index')
            ->with('success', 'Plano excluído com sucesso!');

    }

    /**
     * Display a listing of the resource as a Select2-compatible JSON.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        $planos = PlanoSaude::when(
            $q = $request->input('q'),
            function ($query) use ($q) {
                return $query->where('nome', 'ilike', "%{$q}%");
            }
        )->orderBy('nome')->paginate(20);
        return response()->json([
            'results' => $planos->map(function ($plano) {
                return [
                    'id' => $plano->id,
                    'text' => "{$plano->nome}",
                ];
            }),
            'pagination' => [
                'more' => $planos->hasMorePages(),
            ],
        ]);
    }

    /**
     * Cria uma api para os Planos de Saude
     *
     * @param Request $request
     */
    public function json(Request $request)
    {
        $planos = PlanoSaude::when(
            $q = $request->input('q'), function ($query) use ($q) {
            return $query->where('nome', 'ilike', "%{$q}%");
        })->paginate(10);;

        return Response()->json([
            'results' => $planos->map(function ($plano) {
                return [
                    'id' => $plano->id,
                    'text' => strip_tags($plano->nome),
                ];
            }),
            'pagination' => [
                'more' => $planos->hasMorePages(),
            ],
        ]);

    }
}
