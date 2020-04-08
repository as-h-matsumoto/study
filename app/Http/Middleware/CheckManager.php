<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class CheckManager
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
        if(Auth::user()->id!==1){
            return redirect('/login')->with('warning','err');
        }
        return $next($request);
    }
}
