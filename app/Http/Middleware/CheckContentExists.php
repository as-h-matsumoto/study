<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use App\models\Contents;

class CheckContentExists
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
        if( !$content = Contents::select('id')->find($request->content_id) ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
