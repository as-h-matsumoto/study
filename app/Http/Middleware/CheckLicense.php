<?php

namespace App\Http\Middleware;

use Closure;

use App\models\License;

class CheckLicense
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
        if( !$license = License::select('id')->find($request->license_id) ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
