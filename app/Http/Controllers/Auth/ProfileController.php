<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Foundation\Etnia;
use App\Models\Foundation\Genero;
use App\Http\Controllers\Controller;
use App\Models\Foundation\PovoIndigena;

class ProfileController extends Controller
{
    /**
     * [__construct description].
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.profile.show', [
            'user' => auth()->user(),
        ]);
    }
    /**
     * Set the user's avatar.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterarAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => ['required', 'image'],
        ]);

        $request->user()->update([
            'avatar' => $request->file('avatar')->store('avatars', 'public'),
        ]);

        return back()->with('success', 'Avatar atualizado com sucesso.');
    }

}
