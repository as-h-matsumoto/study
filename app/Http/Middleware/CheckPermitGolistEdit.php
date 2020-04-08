<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use App\models\Content_date;
use App\models\Contents;

class CheckPermitGolistEdit
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
        
        //logger($request->id);
        $content = Contents::select('service')->find($request->id);
        if($content->serivce===69 or $content->serivce===101){
            $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
            if(
                $content_date_users = Content_date::select('id')
                  ->where('content_id',$request->id)
                  ->where('start', '>=', date('Y-m-d H:i:s'))
                  ->where('start', '<=', $last_day)
                  ->orderBy('start', 'asc')
                  ->first()
            ){
                return back()->with('longMessage','予約受付スケジュールが登録されています。予約スケジュールが存在するため所在地は変更できません。新しいコンテンツを作成してください。');
            }
        }
        return $next($request);
    }
}
