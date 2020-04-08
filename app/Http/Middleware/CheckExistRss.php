<?php

namespace App\Http\Middleware;

use Closure;
use App\models\Rss;
use Redirect;

class CheckExistRss
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

        if( !$rss = Rss::select('id')->find($request->rss_id) ){
            return redirect('/speak')->with('info','記事がみつかりません。');
        }
        return $next($request);

    }
}
