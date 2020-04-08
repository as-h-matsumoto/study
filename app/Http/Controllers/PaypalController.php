<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;

use App\models\Place;

use App\models\Messages;
use App\models\Messages_notread;

use Response;
use Mail;
use Validator;
use Redirect;
use Auth;
use DB;
use Storage;
use Session;
use Util;
use Utilowner;
use UtilYoyaku;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller {


  private $_api_context;
  private $client_id;
  private $secret;


public function __construct() {

    // Zunächst wird geprüft, in welchem Modus sich die App befindet
    if(config('paypal.settings.mode') == 'live'){
        $this->client_id = config('paypal.credentials.live.client_id');
        $this->secret = config('paypal.credentials.live.secret');
    } else {
        $this->client_id = config('paypal.credentials.sandbox.client_id');
        $this->secret = config('paypal.credentials.sandbox.secret');
    }

    //logger('client_id: ' . $client_id);
    //logger('secret: ' . $secret);
 
    // Nun legst Du den Paypal API Context fest
    //$oAuthToken = new OAuthTokenCredential($client_id, $secret);
    $this->_api_context = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
    $this->_api_context->setConfig(config('paypal.settings'));

}







public function foodYoyakuComfirmDone(Request $request)
{

  //logger($request->all());

  /** Get the payment ID before session clear **/
  $content_date_user_id = Session::get('content_date_user_id');
  $content_date_user = Content_date_users::find($content_date_user_id);
  /** clear the session payment ID **/
  Session::forget('content_date_user_id');
  if ( !($request->has('token') and $request->has('PayerID')) ) {
      return redirect('/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTenKey($content->service).'/contents/'.$content_date_user->content_id.'/desc')->with('warning', '支払いが失敗しました。もう一度お試しください。');
  }
  $token = $request->get('token');
  $PayerID = $request->get('PayerID');

  $user = User::find($content_date_user->user_id);
  $content_date = Content_date::find($content_date_user->content_date_id);
  $content = Contents::find($content_date_user->content_id);

  $err_back_url = '/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTenKey($content->service).'/contents/'.$content->id.'/desc';







  // all use
  //check status
  $result = UtilYoyaku::checkDateStatus($content_date->status);
  if($result['err']) return redirect($err_back_url)->with('warning', $result['message']);
  $status = $content_date->status;
  $content_date->status = 30;
  $content_date->save();

  if( !($content->service===62 or $content->service===69 or $content->service===101) ){
    //check time public ok (last_order=everything use)
    //---------------
    $result = UtilYoyaku::checkDateYoyaku(
        $content_date_user->start,
        $content->last_time_yoyaku,
        $content_date->start,
        $content_date->end,
        $content->last_time_order);
    if($result['err']){
      $content_date->status = $status;
      $content_date->save();
      return redirect($err_back_url)->with('warning', $result['message']);
    }
    //----------------
  }

  if( !(
    $content->service===39 or
    $content->service===85 or
    $content->service===89
    )
  ){
    //check used over to menus
    $useMenus = Utilowner::checkUsedMenus($content, $content_date_user);
    if($useMenus['err']){
      $content_date->status = $status;
      $content_date->save();
      return redirect($err_back_url)->with('warning', $useMenus['message']);
    }
  }

  //--^----------
  //check same capa only for service 1
  //--------------
  if( $content->service===15 ){
    $result = $this->checkAndGetUseCapacities($content, $content_date, $content_date_user);
    if($result['err']){
      $content_date->status = $status;
      $content_date->save();
      return redirect($err_back_url)->with('warning', $result['message']);
    }elseif($result['type']===2){
      $content_date_user->allUse = 1;
    }
    $use_capa = array_count_values($result['use_capa']);
    $use_capa_original = json_decode($content_date_user->capacities_summary,true);
    $no_same_capa = false;
    //logger($use_capa);
    //logger($use_capa_original);
    foreach($use_capa as $capacity_id=>$number){
      if( isset($use_capa_original[$capacity_id]) and $use_capa_original[$capacity_id]['number']===$number ){
        //logger('the same ok');
      }else{
        $no_same_capa = true;
      }
    }
    if($no_same_capa){
      $content_date->status = $status;
      $content_date->save();
      //return ['err'=>1, 'message'=>'同一の席が埋まってしまいました。'];
      return redirect($err_back_url)->with('warning', '同一の席が埋まってしまいました。');
    }
  }elseif(
    $content->service===39 or
    $content->service===81 or
    $content->service===85 or
    $content->service===89
  ){
    $useCapacities = Utilowner::checkUsedCapacities($content, $content_date_user);
    if($useCapacities['err']){
      $content_date->status = $status;
      $content_date->save();
      return $useCapacities;
    }
  }

  $payment_id = $content_date_user->payment_charge_id;
  $payment = Payment::get($payment_id, $this->_api_context);
  /** PaymentExecution object includes information necessary **/
  /** to execute a PayPal account payment. **/
  /** The payer_id is added to the request query parameters **/
  /** when the user is redirected from paypal back to your site **/
  $execution = new PaymentExecution();
  $execution->setPayerId($PayerID);
  /**Execute the payment **/
  $result = $payment->execute($execution, $this->_api_context);
  //logger($result);


  /** dd($result);exit; /** DEBUG RESULT, remove it later **/
  if ($result->getState() != 'approved') return redirect($err_back_url)->with('warning', '支払い失敗。PAYPALアカウントをご確認ください。');

  //change status
  $content_date_user->goin = 2;
  $content_date_user->yoyaku_id = 'coordiy_' . $content_date_user->id . '_' . uniqid();
  $content_date_user->save();

  if( $content_date_user->allUse ){
    //logger('貸切');
    $content_date->status = 10;
    $content_date->save();
  }else{
    UtilYoyaku::chengeStatus($content, $content_date);
  }

  UtilYoyaku::yoyakuDoneMail($content, $content_date_user, $user);
  UtilYoyaku::yoyakuDoneMessage($content, $content_date_user);
  UtilYoyaku::postOwnersUsersUsedContent($content, $content_date_user);

  if($content->user_id===$user->id){
    return redirect($err_back_url)->with('warning', 'エラー。owners_yoyaku_paypal判定');
  }else{
    //return $content_date_user->id;
    return redirect('/account/yoyaku/history/' . $content_date_user->id . '/show')->with('success', '予約しました。予約内容をご確認ください。');
  }


}




function checkAndGetUseCapacities($content, $content_date, $content_date_user){

  $no = true;
  $use_capa = [];

  if( $content_date_user->allUse ){
    if($content_date_users = Content_date_users::where('content_date_id',$content_date->id)
      ->whereIn('goin',[1,2])
      ->first()){
      $ans['err'] = 1;
      $ans['message'] = '予約有になってしまいました。';
      return $ans;
    }
    $no = false;
  }

  $capa_active_users = [];
  //logger('requ_start' . $content_date_user->start);
  //logger('requ_end' . $content_date_user->end);
  $active_users = Content_date_users::select('start','end','capacities_summary')
    ->where('content_id', $content->id)
    ->where('start', '<', $content_date_user->end)
    ->where('end', '>', $content_date_user->start)
    ->whereIn('goin', [1,2])
    ->take(100000)
    ->get();
/*
    if( !($DT_request_date >= $DT_request_date_tostart && $DT_request_date <= $DT_request_date_toclose_lastorder) ){
  */
  foreach($active_users as $active_user){
    $capacities_summary = json_decode($active_user->capacities_summary,true);
    //logger($capacities_summary);
    foreach($capacities_summary as $capa_id=>$capacity_summary){
      //logger('capa_id: ' . $capa_id . '  used_number: ' . $used_number);
      if(isset($capa_active_users[$capa_id])){
        $capa_active_users[$capa_id] += $capacity_summary['number'];
      }else{
        $capa_active_users[$capa_id] = $capacity_summary['number'];
      }
    }
  }
  //logger('capa_active_users :');
  //logger($capa_active_users);
  //exit;
  //capacity check food only check (table などのtype が異なるため)
  $capacities_person = [];
  $capacities_tmp = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  foreach($capacities_tmp as $key=>$val){
    if($val->delete_flug) continue;
    $capacities_person[(int)$val['person']][] = ["id"=>$val->id, "type"=>$val->type, "person"=>$val->person, "number"=>$val->number, "private"=>$val->private, "nonesmoking"=>$val->nonesmoking, "sheet"=>$val->sheet ];
  }
  //logger('capacities_person :');
  //logger($capacities_person);

  ksort($capacities_person);
  if($content_date_user->join_user_number===1){
    $check_limit_number = 4;
  }else{
    $check_limit_number = 5+$content_date_user->join_user_number;
  }

  //logger($content_date_user->join_user_number . '人以上の席確認');
  foreach($capacities_person as $person=>$capacities){
    //logger('person: ' . $person);
    //logger('check_limit_number: ' . $check_limit_number);
    if($person > $check_limit_number){
      //logger('check_limit_number > person !');
      break;
    }
    if(!$no){
      break;
    }
    if($person >= $content_date_user->join_user_number){
      foreach($capacities as $capacity){    
        if($content_date_user->nonesmoking){ if(!$capacity['nonesmoking']){continue;} }
        if($content_date_user->private){ if(!$capacity['private']){continue;} }
        if($content_date_user->sheet){ if(!$capacity['sheet']){continue;} }
        $aki = (isset($capa_active_users[$capacity['id']])) ? $capacity['number'] - $capa_active_users[$capacity['id']] : $capacity['number'];
        //logger($aki);
        if( $aki <= 0 ){ continue; }
        //logger('find aki !!!');
        $no = false;
        $use_capa[] = (int)$capacity['id'];
        break;
      }
    }
  }

  //logger($content_date_user->join_user_number . '人以下の席、且つ、同一キャパ内を複数利用してチェック。');
  ksort($capacities_person);
  foreach($capacities_person as $person=>$capacities){
    if(!$no){
      break;
    }
    if($person < $content_date_user->join_user_number){
      //logger($person . '人席');
      //logger($content_date_user->join_user_number . '人申込');
      $person_plus = 0;
      foreach($capacities as $capacity){    
        //logger($capacity);
        if($capacity['private']){continue;}
        if($content_date_user->nonesmoking){ if(!$capacity['nonesmoking']){continue;} }
        if($content_date_user->private){ if(!$capacity['private']){continue;} }
        if($content_date_user->sheet){ if(!$capacity['sheet']){continue;} }

        $aki = (isset($capa_active_users[$capacity['id']])) ? $capacity['number'] - $capa_active_users[$capacity['id']] : $capacity['number'];
        $person_plus = $person*$aki;
        //logger('何名用: ' . $person);
        //logger('空き数: ' . $aki);
        //logger('何名可?: ' . $person_plus);
        if($person_plus >= $content_date_user->join_user_number){
          $no = false;
          //logger('find aki !!!');
          //tekisei aki edit
          while(true){
            $akiIf = $aki-1;
            if($person*$akiIf >= $content_date_user->join_user_number){
              $aki--;
            }else{
              break;
            }
          }
          while(true){
            $use_capa[] = (int)$capacity['id'];
            $aki--;
            if($aki===0){break;}
          }
          break;
        }
      }
    }
  }
  
  //logger($content_date_user->join_user_number . '人以下の席、且つ、全テーブルタイプ同士を複数利用してチェック');
  $person_plus = $content_date_user->join_user_number;
  foreach($capacities_person as $person=>$capacities){
    if(!$no){
      break;
    }
    if($person_plus<=0){
      break;
    }
    if( $person < $content_date_user->join_user_number ){
      foreach($capacities as $capacity){
        if($person_plus<=0){
          break;
        }
        if($capacity['type'] === 2){ //テーブル席チェック

          if($capacity['private']){continue;}
          if($content_date_user->nonesmoking){ if(!$capacity['nonesmoking']){continue;} }
          if($content_date_user->private){ if(!$capacity['private']){continue;} }
          if($content_date_user->sheet){ if(!$capacity['sheet']){continue;} }

          $aki = (isset($capa_active_users[$capacity['id']])) ? $capacity['number'] - $capa_active_users[$capacity['id']] : $capacity['number'];
          while(true){
            if($aki<=0){break;}
            $use_capa[] = (int)$capacity['id'];
            $aki--;
            $person_plus = $person_plus - $capacity['person'];
            if($person_plus<=0){
              break;
            }
          }

        }
      }
    }
  }
  if( $person_plus<=0 ){
    //logger('find aki !!!');
    $no = false;
  }

  //logger($content_date_user->join_user_number . '人以下の席、且つ、全座敷タイプ内を複数利用してチェック');
  $person_plus = $content_date_user->join_user_number;
  foreach($capacities_person as $person=>$capacities){
    if(!$no){
      break;
    }
    if($person_plus <= 0){
      break;
    }
    if( $person < $content_date_user->join_user_number ){
      foreach($capacities as $capacity){
        if($person_plus <= 0){
          break;
        }
        if($capacity['type'] === 3){ //座敷席チェック

          if($capacity['private']){continue;}
          if($content_date_user->nonesmoking){ if(!$capacity['nonesmoking']){continue;} }
          if($content_date_user->private){ if(!$capacity['private']){continue;} }
          if($content_date_user->sheet){ if(!$capacity['sheet']){continue;} }

          $aki = (isset($capa_active_users[$capacity['id']])) ? $capacity['number'] - $capa_active_users[$capacity['id']] : $capacity['number'];
          while(true){
            if($aki<=0){break;}
            $use_capa[] = (int)$capacity['id'];
            $aki--;
            $person_plus = $person_plus - $capacity['person'];
            if($person_plus <= 0){
              break;
            }
          }
        }
      }
    }
  }
  if( $person_plus <= 0 ){
    //logger('find aki !!!');
    $no = false;
  }

  //logger($content_date_user->join_user_number . '貸切可能チェック');
  if($no){
    //logger('last check capa');
    //logger($content_date_user->join_user_number);
    //logger($content->allUseNumber);
    if($content->allUseNumber and $content_date_user->join_user_number >= $content->allUseNumber){
      if(!$content_date_users = Content_date_users::where('content_date_id',$content_date->id)
        ->whereIn('goin',[1,2])
        ->first())
      {
        $no=false;
        //logger('find it allUse OK');
        $content_date_user->allUse = 1;
        return ['err'=>0, 'type'=>2, 'use_capa'=>$use_capa];
      }
    }
  }

  //logger('use_capa:');
  //logger($use_capa);
  if($no){
    $ans['err'] = 1;
    $ans['message'] = 'ご指定の条件では席がございませんでした。';
    return $ans;
  }else{
    return ['err'=>0, 'type'=>1, 'use_capa'=>$use_capa];
  }

}





}


