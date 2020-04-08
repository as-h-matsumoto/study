<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

use Utilowner;

use App\models\company;
use App\models\Company_calendar;
use App\models\Contents;

class CheckLoginOwner
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
        if(!Auth::check()){
            return redirect('/login')->with('warning','オーナー機能をご利用の際は、ログインしてください。');
        }

        $company = company::where('user_id',Utilowner::getOwnerId())->first();
        $company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first();
        if( 
            !( $GLOBALS['urls'][1]==='owner' and $GLOBALS['urls'][2]==='calendar' and $GLOBALS['urls'][3]==='edit') and
            empty($company_calendar)
        ){
            return redirect('/owner/calendar/edit')->with('info', 'まずは営業時間を登録しましょう。');
        }

        return $next($request);
    }
}
