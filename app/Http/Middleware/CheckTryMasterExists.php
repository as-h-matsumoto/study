<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\models\License_question_try_master;

class CheckTryMasterExists
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
        if( License_question_try_master::select('id')->where('id',$request->try_master_id)->where('user_id',Auth::user()->id)->doesntExist() ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
