<?php

namespace App\Http\Middleware;

use Closure;

class colecturiaMiddleware
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
        if(session('rol')->name == 'Colecturia')
            return $next($request);
        else
           return redirect('/');
    }
}
