<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Cria uma api para os locais
     *
     * @param Request $request
     */
    public function json(Request $request)
    {
        $locais = Local::when(
            $q = $request->input('q'), function ($query) use ($q) {
            return $query->where('nome', 'ilike', "%{$q}%");
        })->paginate(10);;

        return Response()->json([
            'results' => $locais->map(function ($local) {
                return [
                    'id' => $local->id,
                    'text' => strip_tags($local->nome),
                ];
            }),
            'pagination' => [
                'more' => $locais->hasMorePages(),
            ],
        ]);

    }
}
