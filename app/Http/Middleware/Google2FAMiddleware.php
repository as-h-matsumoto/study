<?php
 
namespace App\Http\Middleware;
 
use App\Support\Google2FAAuthenticator;
use Closure;
 
class Google2FAMiddleware
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
        $authenticator = app(Google2FAAuthenticator::class)->boot($request);
 
        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }
        //logger($authenticator->makeRequestOneTimePasswordResponse());
        //$test = json_decode($authenticator->makeRequestOneTimePasswordResponse());
        //logger('test');
        //logger($test);
        return $authenticator->makeRequestOneTimePasswordResponse();
        //return json_encode(['message'=>'place 2fa.']);
        
    }
}
