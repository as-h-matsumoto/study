<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use Hash;

use App\PasswordSecurity;

class PasswordSecurityController extends Controller
{

    public function show2faForm(Request $request){
        $user = Auth::user();
 
        $google2fa_url = "";
        if($user->passwordSecurity()->exists()){
	    $google2fa = app('pragmarx.google2fa');
	    $google2fa->setAllowInsecureCallToGoogleApis(true);
            $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                'YOYAKU.SITE',
                $user->email,
                $user->passwordSecurity->google2fa_secret
            );
        }
        $data = array(
            'user' => $user,
            'google2fa_url' => $google2fa_url
        );
        return view('auth.2fa')->with('data', $data);
    }


    public function generate2faSecret(Request $request){
        $user = Auth::user();
        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');
     
        // Add the secret key to the registration data
        PasswordSecurity::create([
            'user_id' => $user->id,
            'google2fa_enable' => 0,
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);
     
        return redirect('/account/2fa')->with('success',"シークレットキーを作成しました。QRコードからGOOGLE認証システムにこのアカウントを登録してください。");
    }

    public function enable2fa(Request $request){
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
	$google2fa->setAllowInsecureCallToGoogleApis(true);
        $secret = $request->input('verify-code');
        $valid = $google2fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);
        if($valid){
            $user->passwordSecurity->google2fa_enable = 1;
            $user->passwordSecurity->save();
            return redirect('/account/2fa')->with('success',"二段階認証が有効になりました。");
        }else{
            return redirect('/account/2fa')->with('error',"GOOGLE認証システムにこのアカウントが登録されませんでした。 もう一度お試しください。");
        }
    }

    public function disable2fa(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","アカウントのパスワードが一致しませんでした。もう一度お試しください");
        }
 
        $validatedData = $this->validate($request, [
            'current-password' => 'required',
        ]);
        $user = Auth::user();
        $user->passwordSecurity->google2fa_enable = 0;
        $user->passwordSecurity->save();
        return redirect('/account/2fa')->with('success',"２段階認証は無効になっています。");
    }


}
