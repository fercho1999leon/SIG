<?php

namespace App\Http\Middleware;
use App\User;
use Sentinel;

use Closure;

class AdminStudenteMiddleware
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
        $user = Sentinel::getUser();
		$user_profile = User::where('userid', $user->id)->first();
        $role = $user_profile->cargo;
        if($role == 'Administrador' || $role == 'Estudiante') {
            return $next($request);
        } else {
            redirect('/perfil');
        }
    }
}
