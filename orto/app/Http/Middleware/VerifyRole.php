<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\Perfil;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        Perfil::verificar();

        return $next($request);
    }
}
