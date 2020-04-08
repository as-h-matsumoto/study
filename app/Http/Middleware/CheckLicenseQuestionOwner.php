<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use App\models\License_question;

class CheckLicenseQuestionOwner
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
        
        if( License_question::select('id')->where('user_id',Auth::user()->id)->where('id',$request->license_question_id)->doesntExist() ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
