<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserAuthID
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

        //check auth user
        if(!empty(Auth::user()))
        {
            $get_user_id = Auth::user()->id;
            if(!empty($get_user_id))
            {
                return redirect()->route('frontend_home');
            }
        }
        return $next($request);
        
    }
}
