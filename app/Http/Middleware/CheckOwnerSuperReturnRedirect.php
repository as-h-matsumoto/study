<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class CheckOwnerSuperReturnRedirect
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

        if(Auth::user()->owner!==1) return redirect('/owner/register');
        if($request->id){
            $to = '/owner/contents/' . $request->id . '/date/edit';
        }else{
            $to = '/owner/contents';
        }
        if(Auth::user()->owner_super_id>=1) return redirect($to)->with('info','売上げを確認する場合はADMIN管理者でアクセスしてください');
        return $next($request);

    }
}
