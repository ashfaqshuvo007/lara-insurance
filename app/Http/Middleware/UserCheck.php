<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class UserCheck
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
        $user = Auth::user()->user_type;
        if($user == 'admin'){
            return $next($request);
        }
        else{
            auth()->logout();
            Session()->flush();
        
            return Redirect::to('/');
        }
        
    }
}
