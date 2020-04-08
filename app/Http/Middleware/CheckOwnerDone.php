<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use DB;

class CheckOwnerDone
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
        if(Auth::user()->owner){
            return redirect('/owner');
        }
        return $next($request);
    }
}
