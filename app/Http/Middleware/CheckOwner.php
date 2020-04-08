<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
use DB;

use App\models\Owner_request;

class CheckOwner
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
        
        if(!Auth::user()->owner){
            if($request_done = Owner_request::where('user_id',Auth::user()->id)->first()){
                return redirect('/owner/register')->with('warning','リクエスト済みです。修正の場合は修正後再度リクエストください。');
            }
            return redirect('/owner/register')->with('warning','オーナー機能をご利用の際は、オーナー登録をお願いいたします。');
        }
        return $next($request);
    }
}
