<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

use App\models\License_question_contents;

class CheckLicenseQuestionContentsOwner
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
        if( License_question_contents::select('id')->where('user_id',Auth::user()->id)->where('id',$request->license_question_contents_id)->doesntExist() ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
