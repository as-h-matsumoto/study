<?php

namespace App\Http\Middleware;

use Closure;
use UtilYoyaku;

class AllSenMonTenPutData
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

        $GLOBALS['yoyaku_type_name'] = $request->service_name;
        $GLOBALS['yoyaku_type_id'] = UtilYoyaku::getNewMenuSenMonTenReverce($request->service_name);
        if(!$GLOBALS['yoyaku_type_id']) return redirect()->route('404');
        $GLOBALS['yoyaku_type_key'] = UtilYoyaku::getNewMenuSenMonTenKey($GLOBALS['yoyaku_type_id']);
        $GLOBALS['yoyaku_type_tag_name'] = '';
        if(isset($_COOKIE['yoyaku_type_id'])){
            if( $_COOKIE['yoyaku_type_id'] != $GLOBALS['yoyaku_type_id'] ) {
                setcookie('yoyaku_type_id',$GLOBALS['yoyaku_type_id']);
                setcookie('yoyaku_type_tag_id',0);
                $GLOBALS['yoyaku_type_tag_id'] = 0;
            }else{
                if(isset($_COOKIE['yoyaku_type_tag_id'])){
                    $GLOBALS['yoyaku_type_tag_id'] = $_COOKIE['yoyaku_type_tag_id'];
                    $GLOBALS['yoyaku_type_tag_name'] = UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_id'], $GLOBALS['yoyaku_type_tag_id']);
                }else{
                    $GLOBALS['yoyaku_type_tag_name'] = '';
                    $GLOBALS['yoyaku_type_tag_id'] = 0;
                }
            }
        }else{
            setcookie('yoyaku_type_id',$GLOBALS['yoyaku_type_id']);
            setcookie('yoyaku_type_tag_id',0);
            $GLOBALS['yoyaku_type_tag_id'] = 0;
            $GLOBALS['yoyaku_type_tag_name'] = '';
        }
        
        return $next($request);

    }
}
