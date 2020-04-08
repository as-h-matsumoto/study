<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;
use Utilowner;

use App\models\Contents;

class CheckContentOwner
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
        if(Auth::user()->id<=100) return $next($request);
        
        if( !$content = Contents::select('user_id')->find($request->id) ){
            return redirect('/err404');
        }
        if( $content->user_id === Utilowner::getOwnerId() ){
            return $next($request);
        }else{
            return redirect('/owner/contents')->with('warning', '許可がありません。');
        }
    }
}
