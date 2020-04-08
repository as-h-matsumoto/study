<?php

namespace App\Http\Middleware;

use Closure;
use App\models\License_question_theme;

class CheckLicenseQuestionTheme
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
        if( License_question_theme::select('id')->where('id',$request->license_question_theme_id)->doesntExist() ){
            return redirect('/err404');
        }
        return $next($request);
    }
}
