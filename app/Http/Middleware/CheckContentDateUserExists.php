<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;
use App\models\Content_date_users;

class CheckContentDateUserExists
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
        //Utilowner::getOwnerId()
        if( !$content_date_user = Content_date_users::select('user_id')->find($request->content_date_user_id) ){
            return redirect('/err404');
        }
        if(Auth::user()->owner_super_id >=1){
            $user_id = Auth::user()->owner_super_id;
        }else{
            $user_id = Auth::user()->id;
        }
        if($content_date_user->user_id !== $user_id) return redirect('/err404');
        return $next($request);
    }
}
