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

    public function create()
    {
        return Response::view('plano_saude.create');
    }

    public function store()
    {
        $this->validate($this->request, [
            'nome' => [
                'required',
                'max:255',
            ],
        ]);

    }

    public function index()
    {
        return Response::view('plano_saude.index', [
            'planos' => PlanoSaude::all(),
        ]);
    }

    public function edit($id)
    {
        return Response::view('plano_saude.edit', [
            'plano' => PlanoSaude::findOrFail($id),
        ]);
    }
}
