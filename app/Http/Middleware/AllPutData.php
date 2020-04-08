<?php

namespace App\Http\Middleware;

use Closure;

class AllPutData
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
      if(isset($_SERVER["REQUEST_URI"])){
        $tmp = explode('?',$_SERVER["REQUEST_URI"]);
        $GLOBALS['urls'] = explode('/',$tmp[0]);
        if(!isset($GLOBALS['urls'][1])){ $GLOBALS['urls'][1]=null; }
        if(!isset($GLOBALS['urls'][2])){ $GLOBALS['urls'][2]=null; }
        if(!isset($GLOBALS['urls'][3])){ $GLOBALS['urls'][3]=null; }
        if(!isset($GLOBALS['urls'][4])){ $GLOBALS['urls'][4]=null; }
        if(!isset($GLOBALS['urls'][5])){ $GLOBALS['urls'][5]=null; }
        if(!isset($GLOBALS['urls'][6])){ $GLOBALS['urls'][6]=null; }
        if(!isset($GLOBALS['urls'][7])){ $GLOBALS['urls'][7]=null; }
        if(!isset($GLOBALS['urls'][8])){ $GLOBALS['urls'][8]=null; }
        if(!isset($GLOBALS['urls'][9])){ $GLOBALS['urls'][9]=null; }
      }
      return $next($request);
    }
}
