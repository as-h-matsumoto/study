<?php
namespace App\Libs;

use Util;
use Utilowner;
use DateTime;
use Auth;
use Mail;
use DB;
use Session;

use App\User;
use App\models\User_recruit;

use App\models\Messages;
use App\models\Content_date_users;
use App\models\Contents;
use App\models\Content_date;
use App\models\Owners_users;
use App\models\Owners_users_used_content;

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

class UtilYoyaku
{








public function paypal($content, $content_date_user)
{

    if($content_date_user->payment_sum===0) return 0;
    // Zunächst wird geprüft, in welchem Modus sich die App befindet
    if(config('paypal.settings.mode') == 'live'){
        $client_id = config('paypal.credentials.live.client_id');
        $secret = config('paypal.credentials.live.secret');
    } else {
        $client_id = config('paypal.credentials.sandbox.client_id');
        $secret = config('paypal.credentials.sandbox.secret');
    }

    //logger('client_id: ' . $client_id);
    //logger('secret: ' . $secret);
 
    // Nun legst Du den Paypal API Context fest
    //$oAuthToken = new OAuthTokenCredential($client_id, $secret);
    $api_context = new ApiContext(new OAuthTokenCredential($client_id, $secret));
    $api_context->setConfig(config('paypal.settings'));

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $item_1 = new Item();
    $item_1->setName($content->name . ' ご予約') /** item name **/
        ->setCurrency('JPY')
        ->setQuantity(1)
        ->setPrice($content_date_user->payment_sum); /** unit price **/
    $item_list = new ItemList();
    $item_list->setItems(array($item_1));
    $amount = new Amount();
    $amount->setCurrency('JPY')
        ->setTotal($content_date_user->payment_sum);
    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription("オーダー #" . $content_date_user->id . ' ' . $content->name . ' ご予約');
    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl('https://www.coordiy.com/paypal/'.UtilYoyaku::getNewMenuSenMonTenKey($content->service).'/comfirm/done') /** Specify return URL **/
        ->setCancelUrl('https://www.coordiy.com/SenMonTen/'.UtilYoyaku::getNewMenuSenMonTenKey($content->service).'/contents/'.$content->id.'/desc');
    $payment = new Payment();
    $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));
    try {
        $payment->create($api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
        if (\Config::get('app.debug')) {
            Session::put('error','Connection timeout');
            return null;
            /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
            /** $err_data = json_decode($ex->getData(), true); **/
            /** exit; **/
        } else {
            Session::put('error','Some error occur, sorry for inconvenient');
            return null;
            /** die('Some error occur, sorry for inconvenient'); **/
        }
    }
    foreach($payment->getLinks() as $link) {
        if($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            break;
        }
    }

    //logger($payment);
    

    /** add payment ID to session **/
    Session::put('content_date_user_id', $content_date_user->id);
    if(isset($redirect_url)) {
        /** redirect to paypal **/
        //return Redirect::away($redirect_url);
        $content_date_user->payment_charge_id = $payment->getId();
        $content_date_user->save();
        return $redirect_url;
    }
    Session::put('error','Unknown error occurred');
    //return Redirect::route('addmoney.paywithpaypal');
    return null;
}









public static function postOwnersUsersUsedContent($content, $content_date_user)
{

  //if($content->user_id === $content_date_user->user_id) return;
  if(!$owners_users_used_content = Owners_users_used_content::where('owners_user_id',$content_date_user->owners_user_id)
    ->where('content_id',$content->id)
    ->first()
  ){
    $owners_users_used_content = new Owners_users_used_content;
    $owners_users_used_content->owners_user_id = $content_date_user->owners_user_id;
    $owners_users_used_content->content_id = $content->id;
    $owners_users_used_content->save();
  }
}

public static function postOwnersUsers($content, $request)
{

  if( $request->has('ownersUser') ){

    //logger('in1');
    $tell = $request->get('ownersUserTel');
    $tell = str_replace('-','',$tell);
    if( !ctype_digit($tell) ) return ['err'=>1, 'message'=>'電話番号は半角の数字とハイフンのみ有効です。'];
    if( !(strlen($tell)>=10 and strlen($tell)<=11) ) return ['err'=>1, 'message'=>'電話番号は10-11桁で登録してください。'];

    if( $owners_user = Owners_users::where('tell','=',$tell)->where('owner_id',$content->user_id)->first() ){
    }elseif( $owners_user = Owners_users::find((int)$request->get('ownersUserId')) ){
    }else{
      $owners_user = new Owners_users;
      $owners_user->user_id = 0;
      $owners_user->owner_id = $content->user_id;
      $owners_user->tell = $tell;
    }

    $owners_user->name = $request->get('ownersUserName');
    $owners_user->description = $request->get('ownersUserDescription');
    $owners_user->save();
    
  }else{

    //logger('in2');

    $user_id = ( Utilowner::getOwnerId() === $content->user_id ) ? 0 : Utilowner::getOwnerId();

    if( !$owners_user = Owners_users::where('user_id',$user_id)->where('owner_id',$content->user_id)->first() ){
      //logger('in3');
      $owners_user = new Owners_users;
      $owners_user->user_id = $user_id;
      $owners_user->owner_id = $content->user_id;
      if($user_recruit = User_recruit::where('user_id',Utilowner::getOwnerId())->first()){
        if($user_recruit->tell){
          //logger('in6');
          //logger('tell: '.$user_recruit->tell);
          $owners_user->tell = $user_recruit->tell;
        }else{
          //logger('in7');
          $owners_user->tell = 0;
        }
        $owners_user->name = $user_recruit->name_first . ' ' . $user_recruit->name_second;
      }else{
        //logger('in4');
        $owners_user->tell = 0;
        $owners_user->name = '[N]'.Auth::user()->name;
      }
      $owners_user->description = '';
    }else{
      //logger('in5');
      $owners_user->updated_at = date("Y-m-d H:i:s");
    }

    $owners_user->save();

  }

  return $owners_user;

}








public static function recruitDoneMail($content, $content_date_user, $user)
{
  
  if($content_date_user->owners_user_id) return;

  $owner = User::find($content->user_id);
  $data = array(
    'user' => $user,
    'content' => $content,
    'owner' => $owner,
    'content_date_user' => $content_date_user
  );
  Mail::send('emails.account.recruit.done', $data, function ($m) use ($user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($user->email, $user->name);
    $m->subject('[Coordiy予約]求人エントリーを承りました。');
  });
  Mail::send('emails.owner.recruit.done', $data, function ($m) use ($owner) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($owner->email, $owner->name);
    $m->subject('[Coordiy予約]求人エントリーを承りました。');
  });

}

public static function recruitDoneMessage($content, $content_date_user)
{
  
  $from_user = User::find(1);

  $to_user = User::find($content->user_id);
  $message = new Messages;
  $message->user_id = $from_user->id;
  $message->to_user_id = $to_user->id;
  $message->message = '求人エントリーが着ております。詳細は<a class="text-blue-400" href="/owner/contents/'.$content->id.'/recruit/edit">こちら</a>をご確認ください。';
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();
  
  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>$from_user->id,
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  
  $to_user = User::find($content_date_user->user_id);
  $message = new Messages;
  $message->user_id = $from_user->id;
  $message->to_user_id = $to_user->id;
  $message->message = '求人エントリーを承りました。詳細は<a class="text-blue-400" href="/account/yoyaku/history/'.$content_date_user->id.'/show">こちら</a>をご確認ください。';
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();
  
  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>$from_user->id,
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

}


















public static function yoyakuDoneMail($content, $content_date_user, $user)
{
  
  $owner = User::find($content->user_id);
  $data = array(
    'user' => $user,
    'content' => $content,
    'owner' => $owner,
    'content_date_user' => $content_date_user
  );
  Mail::send('emails.account.yoyaku.done', $data, function ($m) use ($user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($user->email, $user->name);
    $m->subject('[Coordiy予約]ご予約を承りました。');
  });
  Mail::send('emails.owner.yoyaku.done', $data, function ($m) use ($owner) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($owner->email, $owner->name);
    $m->subject('[Coordiy予約]ご予約を承りました。');
  });

}


public static function yoyakuDoneRecruitMail($content, $content_date_user, $user)
{
  
  $owner = User::find($content->user_id);
  $data = array(
    'user' => $user,
    'content' => $content,
    'owner' => $owner,
    'content_date_user' => $content_date_user
  );
  Mail::send('emails.account.yoyaku.doneRecruit', $data, function ($m) use ($user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($user->email, $user->name);
    $m->subject('[Coordiy予約]面接のご予約を承りました。');
  });
  Mail::send('emails.owner.yoyaku.doneRecruit', $data, function ($m) use ($owner) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($owner->email, $owner->name);
    $m->subject('[Coordiy予約]面接のご予約を承りました。');
  });

}



public static function yoyakuDoneMessage($content, $content_date_user)
{
  
  if($content_date_user->owners_user_id) return;

  $from_user = User::find(1);

  $to_user = User::find($content->user_id);
  $message = new Messages;
  $message->user_id = $from_user->id;
  $message->to_user_id = $to_user->id;
  $message->message = 'ご予約が入りました。詳細は<a class="text-blue-400" href="/owner/contents/'.$content->id.'/date/yoyaku">こちら</a>をご確認ください。';
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();
  
  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>$from_user->id,
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  
  $to_user = User::find($content_date_user->user_id);
  $message = new Messages;
  $message->user_id = $from_user->id;
  $message->to_user_id = $to_user->id;
  $message->message = 'ご予約を承りました。詳細は<a class="text-blue-400" href="/account/yoyaku/history/'.$content_date_user->id.'/show">こちら</a>をご確認ください。';
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();
  
  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>$from_user->id,
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

}














  



public static function paing($request, $content, $content_date, $content_date_user)
{
  if($content_date->payment===1){
    //logger($request->all());
    $user = Auth::user();
    \Payjp\Payjp::setApiKey('sk_test_f62734f365fdf0a40536374b');
    if($request->has('payjp-token')){ //新カード利用
      if($user->payjp_customer_id){ //既存ユーザ
        $payjp_token = $request->get('payjp-token');
        $customer = \Payjp\Customer::retrieve($user->payjp_customer_id);
        try{
          $card = $customer->cards->create(array(
            "card" => $payjp_token
          ));
        }catch(\Exception $e){
         //logger($e);
          return ['err'=>1, 'redirect'=>1, 'message'=>'このカードは作成できません。'];
        }
        try{
          $charge = \Payjp\Charge::create(array(
            "customer" => $user->payjp_customer_id,
            "card"     => $card->id,
            "currency" => 'jpy',
            "amount"   => $content_date_user->payment_sum
          ));
        }catch(\Exception $e){
         //logger($e);
          return ['err'=>1, 'redirect'=>1, 'message'=>'もう一度お試しください。'];
        }
        $payment_charge_id = $charge->id;
      }else{ //新規ユーザ
        if(!$request->has('payjp-token')) return ['err'=>1, 'redirect'=>1, 'message'=>'カードが確認できませんでした。'];
        $payjp_token = $request->get('payjp-token');
        try{
          $customer = \Payjp\Customer::create(array(
            "card" => $payjp_token
          ));
        }catch(\Exception $e){
         //logger($e);
          return ['err'=>1, 'redirect'=>1, 'message'=>'もう一度お試しください。'];
        }
        try{
          $charge = \Payjp\Charge::create(array(
            "customer" => $customer->id,
            "currency" => 'jpy',
            "amount"   => $content_date_user->payment_sum
          ));
        }catch(\Exception $e){
         //logger($e);
          return ['err'=>1, 'redirect'=>1, 'message'=>'もう一度お試しください。'];
        }
        $payment_charge_id = $charge->id;
        $user->payjp_customer_id = $customer->id;
        $user->save();
        
      }
    }else{ //過去に利用したカード利用
      
      if(!$request->has('useCard')) return ['err'=>1, 'redirect'=>0, 'message'=>'「新しいカードを利用」もしくは「カード選択」してください。'];
      $useCard = (int)$request->get('useCard');
      $customer = \Payjp\Customer::retrieve(Auth::user()->payjp_customer_id);
      try{
        $charge = \Payjp\Charge::create(array(
          "customer" => $user->payjp_customer_id,
          "card"     => $customer->cards->data[$useCard]->id,
          "currency" => 'jpy',
          "amount"   => $content_date_user->payment_sum
        ));
      }catch(\Exception $e){
       //logger($e);
        return ['err'=>1, 'redirect'=>0, 'message'=>'もう一度お試しください。'];
      }
      $payment_charge_id = $charge->id;
    }

    return ['err'=>0, 'payment_charge_id'=>$payment_charge_id];

  }
  
}





public static function chengeStatus($content, $content_date)
{

  $content_date_ids = [];
  if(
    $content->service===39 or
    $content->service===65 or
    $content->service===77 or
    $content->service===85 or
    $content->service===89 or
    $content->service===91 or
    $content->service===90
  ){
    //2, 10, 11 は最大3日利用が存在するため、この期間のステータスを変更する
    $DT_startAgo = new DateTime($content_date->start);
    $DT_startAgo->modify('3 day');
    $content_dates = Content_date::select('id')
      ->where('content_id', $content->id)
      ->where('start', '>=', $content_date->start)
      ->where('start', '<=', $DT_startAgo->format('Y-m-d 20:00:00'))
      ->take(10)
      ->get();
    $content_date_ids = [];
    foreach($content_dates as $val){
      $content_date_ids[] = $val->id;
    }
  }else{
    $content_date_ids[] = $content_date->id;
  }

  foreach($content_date_ids as $content_date_id){

    $content_date = Content_date::find($content_date_id);  
    //logger('start status: ' . $content_date->status);
    // use service1 only 
    $lunch = json_decode($content_date->lunchs_summary,true);

    $DT_start = new DateTime($content_date->start);
    $DT_end = new DateTime($content_date->end);
    //logger('date_start: ' . $DT_start->format('Y-m-d H:i:s'));
    //logger('date_end: ' . $DT_end->format('Y-m-d H:i:s'));
    $DT_startPlus = new DateTime($content_date->start);
    $DT_endPlus = new DateTime($content_date->start);
    $DT_endPlus->modify('30 minute');
  
    $count = 0;
    $sum_person_total = 0;
    $sum_number_total = 0;
  
    $content_capacity = 0;
    $sum_capacity = 0;
  
    if(
      $content->service===15 or
      $content->service===39 or
      $content->service===65 or 
      $content->service===77 or 
      $content->service===85 or 
      $content->service===89 or
      $content->service===91 or
      $content->service===90
    ){
      //開放タイプ 開催期間を30分間隔で計測し平均を出す 1,2,5,8,10,11,13のみ(2018/03/25現在)
      while(true){
        if($DT_endPlus>$DT_end){
          $sum_person_total = $sum_person_total/$count;
          $sum_number_total = $sum_number_total/$count;
          break;
        }
        //logger($DT_startPlus->format('Y-m-d H:i:s'));
        //logger($DT_endPlus->format('Y-m-d H:i:s'));
        $count++;
        $sum_person = 0;
        $sum_number = 0;
        $content_date_users = Content_date_users::where('content_id',$content->id)
          ->whereIn('goin',[1,2])
          ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('start', '<=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->take(10000)
          ->get();
          //logger($content_date_users);
        if($content->service===65 or $content->service===77 or $content->service===90){
          //logger('in this');
          foreach($content_date_users as $active_user){
            $menus_summary = json_decode($active_user->menus_summary, true);
            //logger($menus_summary);
            foreach($menus_summary as $menu_summary){
              $sum_person += $menu_summary['person'];
            }
          }
        }elseif($content->service===15){ //food1
          foreach($content_date_users as $active_user){
            $capacities_summary = json_decode($active_user->capacities_summary, true);
            foreach($capacities_summary as $capacity_summary){
              $sum_person += $capacity_summary['person']*$capacity_summary['number'];
            }
          }
        }else{
          foreach($content_date_users as $content_date_user){
            $capacities_summary = json_decode($content_date_user->capacities_summary, true);
            foreach($capacities_summary as $capacity_summary){
              if( ($content->service===39 and $capacity_summary['type']>=5) ){
                $sum_person += $capacity_summary['person'];
              }else{ //2->type<=4, 5, 8, 10, 11, 13
                $sum_number += $capacity_summary['number'];
              }
            }
          }
        }
        $sum_person_total += $sum_person;
        $sum_number_total += $sum_number;
        //logger('sum_person: ' . $sum_person . ' count: ' . $count);
        
        $DT_startPlus->modify('30 minute');
        $DT_endPlus->modify('30 minute');
      }
    }else{ //lesson4,tour6,ticket7,stay9,
      //消費タイプ 一度の開催の個数が決まっていて、開放されないため開催単位で計測
      $content_date_users = Content_date_users::where('content_date_id',$content_date->id)
        ->whereIn('goin',[1,2])
        ->take('100000')
        ->get();
      if($content->service===81){ //stay9
        foreach($content_date_users as $active_user){
          $capacities_summary = json_decode($active_user->capacities_summary, true);
          foreach($capacities_summary as $capacity_summary){
            $sum_person_total += $capacity_summary['person']*$capacity_summary['number'];
          }
        }
      }else{ //lesson4,tour6,ticket7
        foreach($content_date_users as $active_user){
          $menus_summary = json_decode($active_user->menus_summary, true);
          foreach($menus_summary as $menu_summary){
            //$number_or_person = 'number';
            if( $content->service===62 or $content->service===69){ //lesson4,tour6
              $sum_person_total += $menu_summary['person'];
            }else{ //ticket
              $sum_number_total += $menu_summary['number'];
            }
          }
        }
      }
    }
  
    //logger('全体平均予約人数チェック service: ' . $content->service);
    //logger('sum_number_total: ' . $sum_number_total);
    //logger('sum_person_total: ' . $sum_person_total);

    $dateTotalCapacities = UtilYoyaku::getDateTotalCapacities($content_date->id);
    //logger('dateTotalCapacities: ');
    //logger($dateTotalCapacities);
    if($content->service===39){
      $total_use = $sum_person_total;
      $waru8 = $dateTotalCapacities['person']/8;
      $waru2 = $dateTotalCapacities['person']/2;
      if( $dateTotalCapacities['person'] < $total_use ){
        //logger('service2->person: err キャパ以上に予約した');
        $ans_person = 4;
      }elseif( $dateTotalCapacities['person'] === $total_use ){
        //logger('service2->person: キャンセル待ち：残り0%');
        $ans_person = 4;
      }elseif( $waru8 >= $dateTotalCapacities['person']-$total_use ){
        //logger('service2->person: 残りわずか(残り20%未満)');
        $ans_person = 3;
      }elseif( $waru2 >= $dateTotalCapacities['person']-$total_use ){
        //logger('service2->person: 残り中(残り50%未満)');
        $ans_person = 2;
      }else{
        //logger('service2->person: 受付中(残り50%以上)');
        $ans_person = 1;
      }
      $total_use = $sum_number_total;
      $waru8 = $dateTotalCapacities['number']/8;
      $waru2 = $dateTotalCapacities['number']/2;
      if( $dateTotalCapacities['number'] < $total_use ){
        //logger('service2->number: err キャパ以上に予約した');
        $ans_number = 4;
      }elseif( $dateTotalCapacities['number'] === $total_use ){
        //logger('service2->number: キャンセル待ち：残り0%');
        $ans_number = 4;
      }elseif( $waru8 >= $dateTotalCapacities['number']-$total_use ){
        //logger('service2->number: 残りわずか(残り20%未満)');
        $ans_number = 3;
      }elseif( $waru2 >= $dateTotalCapacities['number']-$total_use ){
        //logger('service2->number: 残り中(残り50%未満)');
        $ans_number = 2;
      }else{
        //logger('service2->number: 受付中(残り50%以上)');
        $ans_number = 1;
      }
      //logger('ans_person: ' . $ans_person);
      //logger('ans_number: ' . $ans_number);
      if( $ans_person===4 and $ans_number===4) $content_date->status = 4;
      if( $ans_person===4 and $ans_number===3) $content_date->status = 3;
      if( $ans_person===4 and $ans_number===2) $content_date->status = 3;
      if( $ans_person===4 and $ans_number===1) $content_date->status = 2;
      if( $ans_person===3 and $ans_number===4) $content_date->status = 3;
      if( $ans_person===3 and $ans_number===3) $content_date->status = 3;
      if( $ans_person===3 and $ans_number===2) $content_date->status = 3;
      if( $ans_person===3 and $ans_number===1) $content_date->status = 2;
      if( $ans_person===2 and $ans_number===4) $content_date->status = 3;
      if( $ans_person===2 and $ans_number===3) $content_date->status = 3;
      if( $ans_person===2 and $ans_number===2) $content_date->status = 2;
      if( $ans_person===2 and $ans_number===1) $content_date->status = 2;
      if( $ans_person===1 and $ans_number===4) $content_date->status = 3;
      if( $ans_person===1 and $ans_number===3) $content_date->status = 2;
      if( $ans_person===1 and $ans_number===2) $content_date->status = 2;
      if( $ans_person===1 and $ans_number===1) $content_date->status = 1;
    }
    elseif($content->service===15 or $content->service===65 or $content->service===77 or $content->service===81 or $content->service===90)
    {
      $total_use = $sum_person_total;
      $waru8 = $dateTotalCapacities['person']/8;
      $waru2 = $dateTotalCapacities['person']/2;
      if( $dateTotalCapacities['person'] < $total_use ){//logger('err キャパ以上に予約した'); $content_date->status = 4;
      }elseif( $dateTotalCapacities['person'] === $total_use ){ $content_date->status = 4;
      }elseif( $waru8 >= $dateTotalCapacities['person']-$total_use ){ $content_date->status = 3;
      }elseif( $waru2 >= $dateTotalCapacities['person']-$total_use ){ $content_date->status = 2;
      }else{ $content_date->status = 1;
      }
    }
    elseif( $content->service===85 or $content->service===89 or $content->service===91 )
    {
      $total_use = $sum_number_total;
      $waru8 = $dateTotalCapacities['number']/8;
      $waru2 = $dateTotalCapacities['number']/2;
      if( $dateTotalCapacities['number'] < $total_use ){//logger('err キャパ以上に予約した'); $content_date->status = 4;
      }elseif( $dateTotalCapacities['number'] === $total_use ){ $content_date->status = 4;
      }elseif( $waru8 >= $dateTotalCapacities['number']-$total_use ){ $content_date->status = 3;
      }elseif( $waru2 >= $dateTotalCapacities['number']-$total_use ){ $content_date->status = 2;
      }else{ $content_date->status = 1;
      }
    }elseif($content->service===62 or $content->service===69 or $content->service===101){
      //menuで残を計算するタイプ。　今までのはcapacityで残を計算するタイプ
      if($content->service===62 or $content->service===69){
        $total_use = $sum_person_total;
      }elseif($content->service===101){
        $total_use = $sum_number_total;
      }
      $waru8 = $dateTotalCapacities['number']/8;
      $waru2 = $dateTotalCapacities['number']/2;
      if( $dateTotalCapacities['number'] < $total_use ){//logger('err キャパ以上に予約した'); $content_date->status = 4;
      }elseif( $dateTotalCapacities['number'] === $total_use ){ $content_date->status = 4;
      }elseif( $waru8 >= $dateTotalCapacities['number']-$total_use ){ $content_date->status = 3;
      }elseif( $waru2 >= $dateTotalCapacities['number']-$total_use ){ $content_date->status = 2;
      }else{ $content_date->status = 1;
      }
    }

    //logger('end status: ' . $content_date->status);
    $content_date->save();
  
  }

  return 1;

}


public static function getDateTotalCapacities($content_date_id)
{

  $content_date = Content_date::find($content_date_id);
  $content = Contents::find($content_date->content_id);
  $menus_summary = json_decode($content_date->menus_summary,true);
  $lunchs_summary = json_decode($content_date->lunchs_summary,true);
  $capacities_summary = json_decode($content_date->capacities_summary,true);
  //logger($capacities_summary);

  $total_number = 0;
  $total_person = 0;
  $total = 0;

  if($content->service===39)
  {
    foreach($capacities_summary as $capacity_summary){
      if($capacity_summary['type']<=4){
        $total_number += $capacity_summary['number'];
      }else{
        $total_person += $capacity_summary['person'];
      }
    }
    return ['number'=>$total_number, 'person'=>$total_person];
  }
  elseif($content->service===15 or $content->service===81){
    //logger($capacities_summary);
    foreach($capacities_summary as $capacity_summary){
      $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $capacity_summary['id']);
      $total += $capacity_summary['number']*$capacity->person;
    }
    return ['person'=>$total];
  }
  elseif($content->service===62 or $content->service===69)
  {
    foreach($menus_summary as $menu_summary){
      $total += $menu_summary['number'];
    }
    return ['number'=>$total];
  }
  elseif($content->service===101)
  {
    foreach($menus_summary as $menu_summary){
      $total += $menu_summary['number'];
    }
    return ['number'=>$total];
  }
  elseif( $content->service===85 or $content->service===89 or $content->service===91 )
  {
    foreach($capacities_summary as $capacity_summary){
      $total += $capacity_summary['number'];
    }
    return ['number'=>$total];
  }
  elseif( $content->service===65 or $content->service===77 or $content->service===90 )
  {
    /*
    foreach($menus_summary as $menu_summary){
      $total += $menu_summary['simultaneously'];
    }
    return ['person'=>$total];
    */
    //logger('in');
    foreach($capacities_summary as $capacity_summary){
        $total += $capacity_summary['number']*$capacity_summary['person'];
    }
    //logger($total);
    return ['person'=>$total];
  }

}





public static function checkDateYoyaku($time, $last_yoyaku, $start, $end, $last_order)
{

    //logger($time);
    //logger($last_yoyaku);
    //logger($last_order);
    //logger($start);
    //logger($end);
  
    $dt_now = date('Y-m-d H:i:s');
    $dt_request_date = date('Y-m-d H:i:s', strtotime($time));
    $dt_request_date_tostart = date('Y-m-d H:i:s', strtotime($start));
    $dt_request_date_toclose = date('Y-m-d H:i:s', strtotime($end));
    $dt_last_yoyaku_minutes = Util::ToMin($last_yoyaku);
    if($last_order){
      $dt_last_order_minutes = Util::ToMin($last_order);
    }
    
    //logger($dt_now);
    //logger($dt_request_date);
    //logger($dt_request_date_toclose);
    //logger($last_yoyaku);
    //logger($dt_last_yoyaku_minutes);
    //logger($last_order);
    //logger($dt_last_order_minutes);
  
    $DT_now = new DateTime($dt_now);
    $DT_request_date = new DateTime($dt_request_date);
    $DT_request_date_tostart = new DateTime($dt_request_date_tostart);
    $DT_request_date_toclose = new DateTime($dt_request_date_toclose);
    $DT_request_date_toclose_lastyoyaku = new DateTime($dt_request_date);
    $DT_request_date_toclose_lastyoyaku->modify('-'.$dt_last_yoyaku_minutes.' minute');
    $DT_request_date_toclose_lastorder = new DateTime($dt_request_date_toclose);
    $DT_request_date_toclose_lastorder->modify('-'.$dt_last_order_minutes.' minute');
    //logger($DT_now->format('Y-m-d H:i:s'));//申込日時
    //logger($DT_request_date->format('Y-m-d H:i:s'));//予約日時
    //logger($DT_request_date_tostart->format('Y-m-d H:i:s'));//受付開始時間  
    //logger($DT_request_date_toclose->format('Y-m-d H:i:s'));//予約日時の閉店時間
    //logger($DT_request_date_toclose_lastyoyaku->format('Y-m-d H:i:s'));//最終予約時間（予約タイミングチェック）
    //logger($DT_request_date_toclose_lastorder->format('Y-m-d H:i:s'));//最終予約時間（ラストオーダーチェック）
  
  
    if($DT_now >= $DT_request_date) return ['err'=>1, 'message'=>'予約日時が過ぎています。'];
    if($DT_request_date_toclose_lastyoyaku > $DT_request_date_toclose_lastorder){
      $DT_request_date_toclose_master = $DT_request_date_toclose_lastorder;
      $message ='ラストオーダーの' . $dt_last_order_minutes . '分前まで予約ができます。';
    }else{
      $DT_request_date_toclose_master = $DT_request_date_toclose_lastyoyaku;
      $message = 'ご予約は' . $dt_last_yoyaku_minutes . '分前までにお願いします。';
    }
  
    //logger('');
    //logger($DT_now->format('Y-m-d H:i:s'));//申込日時
    //logger($DT_request_date->format('Y-m-d H:i:s'));//予約日時
    //logger($DT_request_date_tostart->format('Y-m-d H:i:s'));//受付開始時間  
    //logger($DT_request_date_toclose_master->format('Y-m-d H:i:s'));//受付終了時間 fix
  
    if( !($DT_request_date >= $DT_request_date_tostart && $DT_request_date <= $DT_request_date_toclose_lastorder) ){
      return ['err'=>1, 'message'=>'予約受付時間内を入力してください。'];
    }
    if($DT_now >= $DT_request_date_toclose_master){
      return ['err'=>1, 'message'=>$message];
    }
  
    return 1;

}




public static function checkDateStatus($status)
{

    $ans = ['err'=>0, 'message'=>''];
  
    switch ($status){
      case 0:
        $ans['err'] = 1;
        $ans['message'] = '現在、ご予約を承っておりません。';
        break; //非表示
      case 1:
        break; //受付中
      case 2:
        break; //残り中
      case 3:
        break; //残りわずか
      case 4:
        $ans['err'] = 1;
        $ans['message'] = 'キャンセル待ちです。';
        break; //キャンセル待ち
      case 5:
        $ans['err'] = 1;
        $ans['message'] = '予約受付は終了しました。';
        break; //受付終了
      case 6:
        $ans['err'] = 1;
        $ans['message'] = '満員です。';
        break; //満員
      case 7:
        $ans['err'] = 1;
        $ans['message'] = 'この予定は中止となりました。';
        break; //中止
      case 8:
        $ans['err'] = 1;
        $ans['message'] = 'この予定は延期となりました。';
        break; //延期
      case 9:
        $ans['err'] = 1;
        $ans['message'] = 'この予定は終了となりました。';
        break; //終了
      case 10:
        $ans['err'] = 1;
        $ans['message'] = '貸切です。';
        break; //終了
      case 30:
        $ans['err'] = 1;
        $ans['message'] = '込み合っています。もう一度お試しください。';
        break; //終了
      default:
        $ans['err'] = 1;
        $ans['message'] = '現在、ご予約を承っておりません。';
        break;
    }
  
    return $ans;

}










public static function getNewMenuSenMonTen($key)
{

  $tag = [
    1=>'寿司',
    2=>'そうめん',
    3=>'そば',
    4=>'うどん',
    5=>'うなぎ',
    6=>'焼き鳥',
    7=>'とんかつ',
    8=>'串揚げ',
    9=>'天ぷら',
    10=>'お好み焼き',
    11=>'もんじゃ焼',
    12=>'しゃぶしゃぶ',
    13=>'沖縄料理',
    14=>'タイ料理',
    15=>'フレンチ',
    16=>'イタリアン',
    17=>'スペイン料理',
    18=>'韓国料理',
    19=>'中華料理',
    20=>'ピザ',
    21=>'ハンバーグ',
    22=>'ハンバーガー',
    23=>'オーガニック',
    24=>'餃子',
    25=>'パスタ',
    26=>'ステーキ',
    27=>'ラーメン',
    28=>'カレー',
    29=>'焼肉',
    30=>'ホルモン',
    31=>'鍋',
    32=>'居酒屋',
    33=>'バイキング',
    34=>'カフェ',
    35=>'パン',
    36=>'スイーツ',
    37=>'バー',
   210=>'総合レストラン', //active そのまま利用
    38=>'動物園',//New Category Zoo (スクールのコピーで作成ほとんど一緒)
    39=>'遊園地',//New Category Zoo
    40=>'水族館',//New Category Zoo
    //41=>'ゴーカート',
      /*
      コース(ただのコース紹介)
      キャパ（カート)制限
      メニュー（一日券、午前券、午後券、一回券など自由に登録）
      >>利用時間なしタイプ
      */
    //42=>'ゴルフ',
      /*
      コース(ただのコース紹介)
      キャパ（カート)制限
      メニュー（一日券、午前券、午後券、一回券など自由に登録）
      >>利用時間なしタイプ
      */
    43=>'ＶＲアトラクション',//active (ただし capa modal のタイプをhiddenで固定登録)
    44=>'ダーツ',//active (ただし capa modal のタイプをhiddenで固定登録)
    45=>'卓球',//active (ただし capa modal のタイプをhiddenで固定登録)
    46=>'テニス',//active (ただし capa modal のタイプをhiddenで固定登録)
    47=>'ビリヤード',//active (ただし capa modal のタイプをhiddenで固定登録)
    48=>'ボルダリング',//active (ただし capa modal のタイプをhiddenで固定登録)
    49=>'ジム',//active (ただし capa modal のタイプをhiddenで固定登録)
    50=>'プール',//active (ただし capa modal のタイプをhiddenで固定登録)
    51=>'牧場',//active (ただし capa modal のタイプをhiddenで固定登録)
   220=>'総合レジャーランド', //active そのまま利用
   230=>'体験', //exprience そのまま利用
    55=>'音楽スクール', //school そのまま利用(ただし、スクールもdivinationと同じくcapa制限に変更)。そして、menu type を hidden で固定登録
    56=>'武道スクール', //school　同上
    57=>'ダンススクール', //school　同上
    58=>'スポーツスクール',//school　同上
    59=>'語学スクール',//school　同上
    60=>'日本文化スクール',//school　同上
    61=>'マリンスポーツスクール',//school　同上
    62=>'ＩＴシステムスクール',//school　同上
    63=>'芸術スクール',//school　同上
    64=>'趣味スクール',//school　同上
   240=>'総合スクール', //exprience そのまま利用
    //65=>'リラクゼーションサロン', //spasalon そのまま利用 capaとmenuのタイプは変更 if(sevrice==xx)で対応 マッサージと整体を結合。セラピー廃止
    //66=>'マッサージサロン',
    //67=>'整体・治療',
    //68=>'セラピー',
    //69=>'ブームスポットツアー',
   250=>'総合リラクゼーションサロン', //exprience そのまま利用
   260=>'ツアー', //tour 現状のものを利用 単純にmenu type world_heritage で検索が現実的かも
    //71=>'大自然リゾートツアー', //tour 同上
    //72=>'ビーチリゾートツアー',//tour 同上 
    //73=>'スキーリゾートツアー',//tour 同上 
    //74=>'温泉リゾートツアー',//tour 同上 
    //75=>'ご当地グルメツアー',//tour 同上 
    //76=>'芸術ツアー',//tour 同上 
    77=>'カット専門ヘアーサロン',//hairsalon 現状のものを利用 menu type world_heritage で検索が現実的かも
    78=>'カラー専門ヘアーサロン',//hairsalon 同上 
    79=>'美容専門サロン', //spasalon 同上 まつげ、ねいる、フェイススパ、ボディスパ、よもぎ蒸し
   280=>'総合ヘアーサロン',
    52=>'温泉', //stay そのまま利用
    54=>'岩盤浴', //stay そのまま利用
    81=>'ラブホテル', // create new category. staycapa. キャパシティに対して、休憩・ショート・一泊の料金を設定いろいろなメニューを定義できるようにする
   290=>'総合宿泊施設', //stay そのまま利用
    82=>'撮影スタジオ', // studio そのまま利用　ただし、capa_type は固定hidden
    83=>'フォトスタジオ', //studio 同上
    84=>'演奏スタジオ', //studio 同上
    85=>'収録スタジオ', //studio 同上
    86=>'ライブスタジオ', //studio 同上
    87=>'キッチンスタジオ', //studio 同上
    88=>'ホールスタジオ', //studio 同上
   300=>'総合スタジオ', //stay そのまま利用
    89=>'ホテル会議室', //kaigi　そのまま利用　ただし、capa_type は固定hidden
   310=>'総合会議室', //kaigi　そのまま利用　ただし、capa_type は固定hidden
    90=>'占い', //そのまま > 340
    91=>'求人' //そのまま  > 330
  ];

  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}



public static function getNewMenuSenMonTenSummary($key)
{

  $tag = [
    1=> 'food',
    2=> 'food',
    3=> 'food',
    4=> 'food',
    5=> 'food',
    6=> 'food',
    7=> 'food',
    8=> 'food',
    9=> 'food',
    10=>'food',
    11=>'food',
    12=>'food',
    13=>'food',
    14=>'food',
    15=>'food',
    16=>'food',
    17=>'food',
    18=>'food',
    19=>'food',
    20=>'food',
    21=>'food',
    22=>'food',
    23=>'food',
    24=>'food',
    25=>'food',
    26=>'food',
    27=>'food',
    28=>'food',
    29=>'food',
    30=>'food',
    31=>'food',
    32=>'food',
    33=>'food',
    34=>'food',
    35=>'food',
    36=>'food',
    37=>'food',
    38=>'active',
    39=>'active',
    40=>'active',
    41=>'active',
    42=>'active',
    43=>'active',
    44=>'active',
    45=>'active',
    46=>'active',
    47=>'active',
    48=>'active',
    49=>'active',
    50=>'active',
    51=>'active',
    52=>'active',
    53=>'active',
    54=>'active',
    55=>'lesson',
    56=>'lesson',
    57=>'lesson',
    58=>'lesson',
    59=>'lesson',
    60=>'lesson',
    61=>'lesson',
    62=>'lesson',
    63=>'lesson',
    64=>'lesson',
    65=>'spasalon',
    66=>'spasalon',
    67=>'spasalon',
    68=>'spasalon',
    69=>'tour',
    70=>'tour',
    71=>'tour',
    72=>'tour',
    73=>'tour',
    74=>'tour',
    75=>'tour',
    76=>'tour',
    77=>'hairsalon',
    78=>'hairsalon',
    79=>'hairsalon',
    80=>'hairsalon',
    81=>'stay',
    82=>'studio',
    83=>'studio',
    84=>'studio',
    85=>'studio',
    86=>'studio',
    87=>'studio',
    88=>'studio',
    89=>'kaigi',
    90=>'divination',
    91=>'recruit'
  ];

  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}








public static function getNewContentCapacity($key)
{

  $tag = [
    1=>'客席',
    2=>'客席',
    3=>'客席',
    4=>'客席',
    5=>'客席',
    6=>'客席',
    7=>'客席',
    8=>'客席',
    9=>'客席',
    10=>'客席',
    11=>'客席',
    12=>'客席',
    13=>'客席',
    14=>'客席',
    15=>'客席',
    16=>'客席',
    17=>'客席',
    18=>'客席',
    19=>'客席',
    20=>'客席',
    21=>'客席',
    22=>'客席',
    23=>'客席',
    24=>'客席',
    25=>'客席',
    26=>'客席',
    27=>'客席',
    28=>'客席',
    29=>'客席',
    30=>'客席',
    31=>'客席',
    32=>'客席',
    33=>'客席',
    34=>'客席',
    35=>'客席',
    36=>'客席',
    37=>'客席',
    38=>'動物コーナー',
    39=>'アトラクション',
    40=>'アクアコーナー',
    41=>'コース',
    42=>'ゴルフスペース／ゴルフコース、',
    43=>'ＶＲアトラクション',
    44=>'ダーツ台',
    45=>'卓球台',
    46=>'テニスコート',
    47=>'ビリヤード台',
    48=>'ボルダリングスペース',
    49=>'ジムコーナー',
    50=>'プール',
    51=>'牧場',
    52=>'入浴スペース',
    53=>'入浴スペース',
    54=>'入浴スペース',
    55=>'演奏スペース',
    56=>'武道スペース',
    57=>'ダンススペース',
    58=>'スポーツスペース',
    59=>'学びスペース',
    60=>'学びスペース',
    61=>'スポーツスペース',
    62=>'開発スペース',
    63=>'芸術スペース',
    64=>'学びスペース',
    65=>'施術スペース',
    66=>'施術スペース',
    67=>'施術スペース',
    68=>'カウンセリングスペース',
    69=>'主目的地',
    70=>'主目的地',
    71=>'主目的地',
    72=>'主目的地',
    73=>'主目的地',
    74=>'主目的地',
    75=>'主目的地',
    76=>'主目的地',
    77=>'カットスペース',
    78=>'カラースペース',
    79=>'施術スペース',
    80=>'施術スペース',
    81=>'ホテルルーム',
    82=>'撮影スタジオ',
    83=>'フォトスタジオ',
    84=>'演奏スタジオ',
    85=>'収録スタジオ',
    86=>'ライブスタジオ',
    87=>'キッチンスタジオ',
    88=>'ホールスタジオ',
    89=>'会議室',
    90=>'占いスペース',
    91=>'面接スペース'
  ];

  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}





public static function getNewMenuSenMonTenKey($key)
{

    
    $tag = [
      1=>'sushi',
      2=>'somen',
      3=>'soba',
      4=>'udon',
      5=>'unagi',
      6=>'yakitori',
      7=>'tonkatsu',
      8=>'kushiage',
      9=>'tenpura',
      10=>'okonomiyaki',
      11=>'monjya',
      12=>'shabushabu',
      13=>'okinawa',
      14=>'thailand',
      15=>'french',
      16=>'italian',
      17=>'spainfood',
      18=>'kolianfood',
      19=>'chukafood',
      20=>'piza',
      21=>'hanburg',
      22=>'hamburger',
      23=>'organic',
      24=>'gyoza',
      25=>'pasta',
      26=>'steaka',
      27=>'ramen',
      28=>'curry',
      29=>'yakiniku',
      30=>'horumon',
      31=>'nabe',
      32=>'izakaya',
      33=>'viking',
      34=>'cafe',
      35=>'pan',
      36=>'sweets',
      37=>'bar',
      38=>'zoo',
      39=>'land',
      40=>'sealand',
      41=>'gocart',
      42=>'golf',
      43=>'vr',
      44=>'darts',
      45=>'tabletennis',
      46=>'tennis',
      47=>'billiards',
      48=>'bouldering',
      49=>'gym',
      50=>'heatedpool',
      51=>'ranch',
      52=>'hotspring',
      53=>'sento',
      54=>'ganban',
      55=>'musicschool ',
      56=>'budoschool ',
      57=>'danceschool ',
      58=>'sportschool ',
      59=>'gogakuschool ',
      60=>'japanschool ',
      61=>'marineschool ',
      62=>'itschool',
      63=>'artschool',
      64=>'hobbyschool',
      65=>'relaxation',
      66=>'massage',
      67=>'seitai',
      68=>'therapy',
      69=>'boomtour',
      70=>'worldheritagetour',
      71=>'naturetour',
      72=>'beachtour',
      73=>'skytour',
      74=>'shospringtour',
      75=>'gourmettour',
      76=>'arttour',
      77=>'haircut',
      78=>'haircolor',
      79=>'nail',
      80=>'eyelash',
      81=>'lovehotel',
      82=>'pictuarstudio',
      83=>'photostudio',
      84=>'musicstudio',
      85=>'recordingstudio',
      86=>'livestudio',
      87=>'kitchenstudio',
      88=>'holestudio',
      89=>'kaigihotel',
      90=>'uranai',
      91=>'recruit'      
  ];
  


  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}



public static function getNewMenuSenMonTenReverce($key)
{

  $tag = [
    '寿司'=>1,
    'そうめん'=>2,
    'そば'=>3,
    'うどん'=>4,
    'うなぎ'=>5,
    '焼き鳥'=>6,
    'とんかつ'=>7,
    '串揚げ'=>8,
    '天ぷら'=>9,
    'お好み焼き'=>10,
    'もんじゃ焼'=>11,
    'しゃぶしゃぶ'=>12,
    '沖縄料理'=>13,
    'タイ料理'=>14,
    'フレンチ'=>15,
    'イタリアン'=>16,
    'スペイン料理'=>17,
    '韓国料理'=>18,
    '中華料理'=>19,
    'ピザ'=>20,
    'ハンバーグ'=>21,
    'ハンバーガー'=>22,
    'オーガニック'=>23,
    '餃子'=>24,
    'パスタ'=>25,
    'ステーキ'=>26,
    'ラーメン'=>27,
    'カレー'=>28,
    '焼肉'=>29,
    'ホルモン'=>30,
    '鍋'=>31,
    '居酒屋'=>32,
    'バイキング'=>33,
    'カフェ'=>34,
    'パン'=>35,
    'スイーツ'=>36,
    'バー'=>37,
    '動物園'=>38,
    '遊園地'=>39,
    '水族館'=>40,
    'ゴーカート'=>41,
    'ゴルフ'=>42,
    'ＶＲアトラクション'=>43,
    'ダーツ'=>44,
    '卓球'=>45,
    'テニス'=>46,
    'ビリヤード'=>47,
    'ボルダリング'=>48,
    'ジム'=>49,
    'プール'=>50,
    '牧場'=>51,
    '温泉'=>52,
    '銭湯'=>53,
    '岩盤浴'=>54,
    '音楽スクール'=>55,
    '武道スクール'=>56,
    'ダンススクール'=>57,
    'スポーツスクール'=>58,
    '語学スクール'=>59,
    '日本文化スクール'=>60,
    'マリンスポーツスクール'=>61,
    'ＩＴシステムスクール'=>62,
    '芸術スクール'=>63,
    '趣味スクール'=>64,
    'リラクゼーションサロン'=>65,
    'マッサージサロン'=>66,
    '整体・治療'=>67,
    'セラピー'=>68,
    'ブームスポットツアー'=>69,
    '世界遺産ツアー'=>70,
    '大自然リゾートツアー'=>71,
    'ビーチリゾートツアー'=>72,
    'スキーリゾートツアー'=>73,
    '温泉リゾートツアー'=>74,
    'ご当地グルメツアー'=>75,
    '芸術ツアー'=>76,
    'カット専門ヘアーサロン'=>77,
    'カラー専門ヘアーサロン'=>78,
    'ネイル専門サロン'=>79,
    'まつげ専門サロン'=>80,
    'ラブホテル'=>81,
    '撮影スタジオ'=>82,
    'フォトスタジオ'=>83,
    '演奏スタジオ'=>84,
    '収録スタジオ'=>85,
    'ライブスタジオ'=>86,
    'キッチンスタジオ'=>87,
    'ホールスタジオ'=>88,
    'ホテル会議室'=>89,
    '占い'=>90,
    '求人'=>91,
  ];

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}



public static function getNewMenuSenMonTenIcon($key, $size)
{

  $a1  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a2  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a3  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a4  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a5  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a6  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a7  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a8  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a9  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a10  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a11  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a12  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a13  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a14  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a15  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a16  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a17  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a18  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a19  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a20  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a21  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a22  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a23  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a24  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a25  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a26  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a27  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a28  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a29  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a30  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a31  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a32  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a33  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a34  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a35  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a36  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a37  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a38  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a39  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a40  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a41  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a42  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a43  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a44  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a45  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a46  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a47  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a48  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a49  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a50  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a51  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a52  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a53  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a54  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a55  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a56  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a57  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a58  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a59  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a60  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a61  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a62  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a63  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a64  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a65  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a66  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a67  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a68  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a69  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a70  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a71  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a72  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a73  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a74  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a75  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a76  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a77  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a78  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a79  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a80  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a81  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a82  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a83  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a84  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a85  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a86  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a87  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a88  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a89  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a90  = '<i class="icon icon-tag-outline ' . $size . ' text-red-A700" title="" alt=""></i>';
  $a91  = '<i class="icon icon-cards-playing-outline ' . $size . ' text-red-A700" title="占い" alt="占い"></i>';
  $tag = [
    1  => $a1,
    2  => $a2,
    3  => $a3,
    4  => $a4,
    5  => $a5,
    6  => $a6,
    7  => $a7,
    8  => $a8,
    9  => $a9,
    10 => $a10,
    11 => $a11,
    12 => $a12,
    13 => $a13,
    14 => $a14,
    15 => $a15,
    16 => $a16,
    17 => $a17,
    18 => $a18,
    19 => $a19,
    20 => $a20,
    21 => $a21,
    22 => $a22,
    23 => $a23,
    24 => $a24,
    25 => $a25,
    26 => $a26,
    27 => $a27,
    28 => $a28,
    29 => $a29,
    30 => $a30,
    31 => $a31,
    32 => $a32,
    33 => $a33,
    34 => $a34,
    35 => $a35,
    36 => $a36,
    37 => $a37,
    38 => $a38,
    39 => $a39,
    40 => $a40,
    41 => $a41,
    42 => $a42,
    43 => $a43,
    44 => $a44,
    45 => $a45,
    46 => $a46,
    47 => $a47,
    48 => $a48,
    49 => $a49,
    50 => $a50,
    51 => $a51,
    52 => $a52,
    53 => $a53,
    54 => $a54,
    55 => $a55,
    56 => $a56,
    57 => $a57,
    58 => $a58,
    59 => $a59,
    60 => $a60,
    61 => $a61,
    62 => $a62,
    63 => $a63,
    64 => $a64,
    65 => $a65,
    66 => $a66,
    67 => $a67,
    68 => $a68,
    69 => $a69,
    70 => $a70,
    71 => $a71,
    72 => $a72,
    73 => $a73,
    74 => $a74,
    75 => $a75,
    76 => $a76,
    77 => $a77,
    78 => $a78,
    79 => $a79,
    80 => $a80,
    81 => $a81,
    82 => $a82,
    83 => $a83,
    84 => $a84,
    85 => $a85,
    86 => $a86,
    87 => $a87,
    88 => $a88,
    89 => $a89,
    90 => $a90,
    91 => $a91
  ];

  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}







public static function getNewContentTag($service,$key)
{

  switch ($service) {
    //case フード
    case 'sushi': $tag = []; break;
    case 'somen': $tag = []; break;
    case 'soba': $tag = []; break;
    case 'udon': $tag = []; break;
    case 'unagi': $tag = []; break;
    case 'yakitori': $tag = []; break;
    case 'tonkatsu': $tag = []; break;
    case 'kushiage': $tag = []; break;
    case 'tenpura': $tag = []; break;
    case 'okonomiyaki': $tag = []; break;
    case 'monjya': $tag = []; break;
    case 'shabushabu': $tag = []; break;
    case 'okinawa': $tag = []; break;
    case 'thailand': $tag = []; break;
    case 'french': $tag = []; break;
    case 'italian': $tag = []; break;
    case 'spainfood': $tag = []; break;
    case 'kolianfood': $tag = []; break;
    case 'chukafood': $tag = []; break;
    case 'piza': $tag = []; break;
    case 'hanburg': $tag = []; break;
    case 'hamburger': $tag = []; break;
    case 'organic': $tag = []; break;
    case 'gyoza': $tag = []; break;
    case 'pasta': $tag = []; break;
    case 'steaka': $tag = []; break;
    case 'ramen': $tag = []; break;
    case 'curry': $tag = []; break;
    case 'yakiniku': $tag = []; break;
    case 'horumon': $tag = []; break;
    case 'nabe': $tag = []; break;
    case 'izakaya': $tag = []; break;
    case 'viking': $tag = []; break;
    case 'cafe': $tag = []; break;
    case 'pan': $tag = []; break;
    case 'sweets': $tag = []; break;
    case 'bar': $tag = []; break;
    //caseスポーツ・レジャー・アクティブ
    case 'zoo': $tag = []; break;
    case 'land': $tag = []; break;
    case 'sealand': $tag = []; break;
    case 'gocart': $tag = []; break;
    case 'golf': $tag = []; break;
    case 'vr': $tag = []; break;
    case 'darts': $tag = []; break;
    case 'tabletennis': $tag = []; break;
    case 'tennis': $tag = []; break;
    case 'billiards': $tag = []; break;
    case 'bouldering': $tag = []; break;
    case 'gym': $tag = []; break;
    case 'heatedpool': $tag = []; break;
    case 'ranch': $tag = []; break;
    case 'hotspring': $tag = []; break;
    case 'sento': $tag = []; break;
    case 'ganban': $tag = []; break;
    //caseスクール': $tag = []; break;
    //case 'musicschool ':
      $tag = [
        'piano'=>'ピアノ',
        'guitter'=>'ギター',
        'violin'=>'バイオリンスクール',
        'flute'=>'フルートスクール',
        'voice'=>'ボイストレーニングスクール',
        'cello'=>'チェロスクール',
        'taishokoto'=>'大正琴スクール',
        'composition'=>'作曲スクール',
        'marimba'=>'マリンバスクール',
      ]; break;
    case 'budoschool ':
      $tag = [
        'karate'=>'空手',
        //'77 '=>'カンフースクール',
        
        
      ]; break;
    case 'sportschool ': $tag = [
      //'67 '=>'テニススクール',
      //'68 '=>'ゴルフスクール',
      //'69 '=>'体操スクール',
      //'65 '=>'スイミングスクール',
      //'70 '=>'キックボクシングスクール',
      //'71 '=>'フットサルスクール',
      //'72 '=>'バトミントンスクール',
      //'73 '=>'野球スクール',
      //'74 '=>'バレーボールスクール',
      //'75 '=>'スキースクール',
      //'76 '=>'スノーボードスクール',
      //'78 '=>'アーチェリースクール',
      //    '79 '=>'レスリングスクール',
      //    '80 '=>'スケートスクール',
      //    '81 '=>'ソフトボールスクール',
      //    '82 '=>'ゲートボールスクール',
    ]; break;
    case 'danceschool ': $tag = [
      //'114'=>'ダンススクール',
      //    '115'=>'バレエスクール',
      //    '117'=>'社交ダンススクール',
    ]; break;
    case 'gogakuschool ': $tag = []; break;
    case 'japanschool ': 
      $tag = [
        //'95 '=>'書道スクール',
        //  '96 '=>'そろばんスクール',
        //  '97 '=>'武道スクール',
        //  '98 '=>'生花スクール',
        //  '99 '=>'茶道スクール',
        //'121'=>'日本舞踊スクール',
        //'113'=>'着付スクール',
        //'139'=>'舞踏スクール',
      ]; break;
    case 'marineschool ': 
      $tag = [
        //'100'=>'ボートクラブスクール',
        //  '101'=>'パラグライダースクール',
        //  '102'=>'ヨットスクール',
        //  '103'=>'ウェイクボードスクール',
        //  '104'=>'水上スキースクール',
        //  '105'=>'キャニオニングスクール',
        //  '106'=>'ライフセービングスクール',
        //  '107'=>'ボードセイリングスクール',
        //  '83 '=>'サーフィンスクール',
        //  '118'=>'ダイビングスクール',
      ]; break;
    case 'itschool': 
      $tag = [
        //'108'=>'iPhoneアプリスクール',
        //  '109'=>'Androidアプリスクール',
        //  '110'=>'PHP/Laravelスクール',
        //  '111'=>'Ruby/Ruby on railsスクール',
        //  '112'=>'Python/Djangoスクール',
      ]; break;
    case 'artschool': 
      $tag = [
        //'116'=>'フラワーデザインスクール',
        //  '119'=>'絵画スクール',
        //  '120'=>'陶芸スクール',
      ]; break;
    case 'hobbyschool': 
      $tag = [
        //'122'=>'料理スクール',
        //  '123'=>'手芸スクール',
        //  '124'=>'囲碁スクール',
        //  '125'=>'将棋スクール',
        //  '126'=>'菓子スクール',
        //  '127'=>'フラメンコスクール',
        //  '128'=>'マージャンスクール',
        //  '129'=>'話し方スクール',
        //  '130'=>'マナースクール',
        //  '131'=>'占いスクール',
        //  '132'=>'タップスクール',
        //  '133'=>'パンスクール',
        //  '134'=>'アクセサリースクール',
        //  '135'=>'工芸スクール',
        //  '136'=>'押し花スクール',
        //  '137'=>'ペン字スクール',
        //  '138'=>'そば打ちスクール',
        //  '140'=>'トールペインティングスクール',
        //  '141'=>'フィッシングスクール',
        //  '142'=>'エアラインスクール',
        //  '143'=>'七宝焼スクール',
        //  '144'=>'フォークスクール',
        //  '145'=>'ポーセリンペインティングスクール',
        //  '146'=>'バーテンダースクール',

      ]; break;
    //caseスパ・エステ・整体': $tag = []; break;
    case 'relaxation': $tag = []; break;
    case 'massage': $tag = []; break;
    case 'seitai': $tag = []; break;
    case 'therapy': $tag = []; break;
    //caseツアー': $tag = []; break;
    case 'boomtour': $tag = []; break;
    case 'worldheritagetour': $tag = []; break;
    case 'naturetour': $tag = []; break;
    case 'beachtour': $tag = []; break;
    case 'skytour': $tag = []; break;
    case 'shospringtour': $tag = []; break;
    case 'gourmettour': $tag = []; break;
    case 'arttour': $tag = []; break;
    //caseチケットツアー': $tag = []; break;
    //case美容・ヘアーサロン': $tag = []; break;
    case 'haircut': $tag = []; break;
    case 'haircolor': $tag = []; break;
    case 'nail': $tag = []; break;
    case 'eyelash': $tag = []; break;
    //case旅館・ホテル': $tag = []; break;
    case 'lovehotel': $tag = []; break;
    //caseスタジオ': $tag = []; break;
    case 'pictuarstudio': $tag = []; break;
    case 'photostudio': $tag = []; break;
    case 'musicstudio': $tag = []; break;
    case 'recordingstudio': $tag = []; break;
    case 'livestudio': $tag = []; break;
    case 'kitchenstudio': $tag = []; break;
    case 'holestudio': $tag = []; break;
    //case会議室': $tag = []; break;
    case 'kaigihotel': $tag = []; break;
    //case占い': $tag = []; break;
    case 'uranai': 
      $tag = [
        1=>'タロット占い',
        2=>'九星気学',
        3=>'四柱推命',
        4=>'姓名判断',
        5=>'手相占い',
        6=>'易占い',
        7=>'東洋占い',
        8=>'西洋占い',
        9=>'観相',
        10=>'風水',
        11=>'スピリチュアル'
      ]; break;
    case 'recruit': 
      $tag = [
        
      ]; break;
    default: $tag = [];
  }


  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

}




public static function getNewContentTagIcon($service, $key, $size)
{



  switch($service){
    case 1 : $tag = []; break;
    case 2 : $tag = []; break;
    case 3 : $tag = []; break;
    case 4 : $tag = []; break;
    case 5 : $tag = []; break;
    case 6 : $tag = []; break;
    case 7 : $tag = []; break;
    case 8 : $tag = []; break;
    case 9 : $tag = []; break;
    case 10: $tag = []; break;
    case 11: $tag = []; break;
    case 12: $tag = []; break;
    case 13: $tag = []; break;
    case 14: $tag = []; break;
    case 15: $tag = []; break;
    case 16: $tag = []; break;
    case 17: $tag = []; break;
    case 18: $tag = []; break;
    case 19: $tag = []; break;
    case 20: $tag = []; break;
    case 21: $tag = []; break;
    case 22: $tag = []; break;
    case 23: $tag = []; break;
    case 24: $tag = []; break;
    case 25: $tag = []; break;
    case 26: $tag = []; break;
    case 27: $tag = []; break;
    case 28: $tag = []; break;
    case 29: $tag = []; break;
    case 30: $tag = []; break;
    case 31: $tag = []; break;
    case 32: $tag = []; break;
    case 33: $tag = []; break;
    case 34: $tag = []; break;
    case 35: $tag = []; break;
    case 36: $tag = []; break;
    case 37: $tag = []; break;
    case 38: $tag = []; break;
    case 39: $tag = []; break;
    case 40: $tag = []; break;
    case 41: $tag = []; break;
    case 42: $tag = []; break;
    case 43: $tag = []; break;
    case 44: $tag = []; break;
    case 45: $tag = []; break;
    case 46: $tag = []; break;
    case 47: $tag = []; break;
    case 48: $tag = []; break;
    case 49: $tag = []; break;
    case 50: $tag = []; break;
    case 51: $tag = []; break;
    case 52: $tag = []; break;
    case 53: $tag = []; break;
    case 54: $tag = []; break;
    case 55: $tag = []; break;
    case 56: $tag = []; break;
    case 57: $tag = []; break;
    case 58: $tag = []; break;
    case 59: $tag = []; break;
    case 60: $tag = []; break;
    case 61: $tag = []; break;
    case 62: $tag = []; break;
    case 63: $tag = []; break;
    case 64: $tag = []; break;
    case 65: $tag = []; break;
    case 66: $tag = []; break;
    case 67: $tag = []; break;
    case 68: $tag = []; break;
    case 69: $tag = []; break;
    case 70: $tag = []; break;
    case 71: $tag = []; break;
    case 72: $tag = []; break;
    case 73: $tag = []; break;
    case 74: $tag = []; break;
    case 75: $tag = []; break;
    case 76: $tag = []; break;
    case 77: $tag = []; break;
    case 78: $tag = []; break;
    case 79: $tag = []; break;
    case 80: $tag = []; break;
    case 81: $tag = []; break;
    case 82: $tag = []; break;
    case 83: $tag = []; break;
    case 84: $tag = []; break;
    case 85: $tag = []; break;
    case 86: $tag = []; break;
    case 87: $tag = []; break;
    case 88: $tag = []; break;
    case 89: $tag = []; break;
    case 90:
          $a1 =  '<i class="icon icon-cards ' . $size . ' text-red-700" title="タロット占い" alt="タロット占い"></i>';
          $a2 =  '<i class="icon icon-crosshairs ' . $size . ' text-yellow-700" title="九星気学" alt="九星気学"></i>';
          $a3 =  '<i class="icon icon-crosshairs-gps ' . $size . ' text-green-700" title="四柱推命" alt="四柱推命"></i>';
          $a4 =  '<i class="icon icon-human-female ' . $size . ' text-orange-700" title="姓名判断" alt="姓名判断"></i>';
          $a5 =  '<i class="icon icon-hand-pointing-right ' . $size . ' text-amber-700" title="手相占い" alt="手相占い"></i>';
          $a6 =  '<i class="icon icon-candle ' . $size . ' text-cyan-700" title="易占い" alt="易占い"></i>';
          $a7 =  '<i class="icon icon-checkbox-multiple-blank-outline ' . $size . ' text-deep-purple-700" title="東洋占い" alt="東洋占い"></i>';
          $a8 =  '<i class="icon icon-checkbox-blank-circle-outline ' . $size . ' text-indigo-700" title="西洋占い" alt="西洋占い"></i>';
          $a9 =  '<i class="icon icon-cube ' . $size . ' text-light-green-700" title="観相" alt="観相"></i>';
          $a10 = '<i class="icon icon-cube-outline ' . $size . ' text-teal-700" title="風水" alt="風水"></i>';
          $a11 = '<i class="icon icon-weather-sunny ' . $size . ' text-red-700" title="スピリチュアル" alt="スピリチュアル"></i>';
          $tag = [
            1 => $a1,
            2 => $a2,
            3 => $a3,
            4 => $a4,
            5 => $a5,
            6 => $a6,
            7 => $a7,
            8 => $a8,
            9 => $a9,
            10 => $a10,
            11 => $a11,
          ];
      break;
    case 91: $tag = []; break;
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}


    


    public static function welcome()
    {
        return 'UtilYoyaku yyy';
    }




}
