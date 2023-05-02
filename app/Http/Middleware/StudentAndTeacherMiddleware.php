<?php

namespace App\Http\Middleware;

use Closure;

class StudentAndTeacherMiddleware
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
        if(session('rol')->name == 'Docente' || session('rol')->name == 'Estudiante' || session('rol')->name == 'Administrador' )
            return $next($request);
        else
            return redirect('/');
    }
}
