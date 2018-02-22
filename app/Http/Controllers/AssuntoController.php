<?php

namespace App\Http\Controllers;

use App\Assunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AssuntoController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:professor,administrador');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('assuntos.index', [
            'assuntos' => Assunto::orderBy('assunto')->get(),
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
        return view('assuntos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'assunto' => [
                'required',
            ],
        ]);

        Assunto::create($request->only(
            'assunto'));

        return redirect()->route('assuntos.index')->with('success', 'Assunto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('assuntos.show', [
            'assunto' => Assunto::findOrFail($id),
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
        return view('assuntos.edit', [
            'assunto' => Assunto::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'assunto' => ['required'],
        ]);


        Assunto::findOrFail($id)->update($request->only([
            'codigo',
        ]));

        return Response::redirectToRoute('assuntos.index')
            ->with('success', 'Assunto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        Assunto::findOrFail($id)->delete();

        return Response::redirectToRoute('assuntos.index')
            ->with('success', 'Assunto deletado com sucesso.');
    }
}