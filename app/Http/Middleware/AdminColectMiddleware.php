<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class AdminColectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $role = session('rol')->name;
        //if( $role == 'Administrador' || $role == 'Secretaria' || $role == 'Colecturia')
        if( $role == 'Administrador' || $role == 'Colecturia')
            return $next($request);
        else
            redirect('/perfil');
    }
}
