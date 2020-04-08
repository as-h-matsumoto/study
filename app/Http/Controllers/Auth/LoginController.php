<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

use Auth;
use App\PasswordSecurity;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;
    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->to('/license/1/top');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/license/1/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        Session::put('backUrl', URL::previous());
    }

    protected function credentials(Request $request)
    {
      return [
        'email' => $request->email,
        'password' => $request->password
      ];
    }

    public function redirectTo()
    {
        if(Auth::check()){
            /*
            if($secua = PasswordSecurity::where('user_id',Auth::user()->id)->first())
            {
                if($secua->google2fa_enable){
                    return '/account/2fa';
                }
            }
            */
            if(Auth::user()->referer){
                $referer = Auth::user()->referer;
                $user = Auth::user();
                $user->referer = null;
                $user->save();
                return $referer;
            }
        }
        return Session::get('backUrl') ? Session::get('backUrl') :   $this->redirectTo;
    }
}
