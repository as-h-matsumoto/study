<?php

namespace App\Http\Middleware;

use Closure;
use Util;
use UtilYoyaku;

use App\models\Contents;

class CheckContentMenuExists
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
        if( !$content = Contents::select('id','service')->find($request->content_id) ){
            return redirect('/err404');
        }
        $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->menu_id);
        if( empty($menu) ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
