<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use App\Administrative;
use App\MessageDetail;
class UsersMiddleware
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
        if(Sentinel::check()){
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            $cm = MessageDetail::getNewMessages($user_profile->id)->count();
            session()->put('tMessages', $cm);
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
