<?php

namespace App\Http\Middleware;
Use Sentinel;

use Closure;

class RepresentativeMiddleware
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
     //1. User shuould be authenticate

        //2. Role as Representante
        if(session('rol')->name == 'Representante' )
            return $next($request);
        else
           return redirect('/');
    }
}
