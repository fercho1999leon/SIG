<?php

namespace App\Http\Middleware;

use Closure;
use App\MessageDetail;
use App\User;
use Sentinel;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
		$user = Sentinel::getUser();
		$user_profile = User::where('userid', $user->id)->first();
		$role = $user_profile->cargo;
        //dd($role);
        if($role == 'Administrador' || $role == 'Colecturia' || $role == 'Secretaria' || $role == 'Financiero') {
            return $next($request);
        } else {
            redirect('/perfil');
        }

    }
}
