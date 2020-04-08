<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckOwnerSuperReturnAjax
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
        
        if(Auth::user()->owner!==1) return [];
        if(Auth::user()->owner_super_id>=1) return [];

        return $next($request);

    }
}
