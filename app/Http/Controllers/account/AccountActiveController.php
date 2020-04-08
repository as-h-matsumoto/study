<?php namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;

use App\User;
use App\models\Place;
use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;

use Auth;
use DB;
use Redirect;
use Util;
use UtilYoyaku;
use Utilowner;
use DateTime;

use Illuminate\Http\Request;

class AccountActiveController extends Controller {


public function __construct()
{
}







public function postYoyakuComfirm(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  $content_date_id = (int)$request->get('modalSelectMenuId');
  if(!$content_date = Content_date::find($content_date_id)) return ['err'=>1, 'message'=>'現在、ご予約を承っておりません。'];
  $result = UtilYoyaku::checkDateStatus($content_date->status);
  if($result['err']) return $result;

  $content_date_user = new Content_date_users;
  $content_date_user->content_id = $content_id;
  $content_date_user->user_id = Utilowner::getOwnerId();
  $owners_user = UtilYoyaku::postOwnersUsers($content, $request);
  if($owners_user['err']) return $owners_user;
  $content_date_user->owners_user_id = $owners_user->id;
  $content_date_user->content_date_id = $content_date->id;
  $content_date_user->goin = 0;

  if(!(int)$request->get('selectMenuFormperson')) return ['err'=>1, 'message'=>'ご利用人数を入力してください。'];
  if((int)$request->get('selectMenuFormperson')>65000) return ['err'=>1, 'message'=>'ご利用人数は65000名以下でお申込ください。'];
  $content_date_user->join_user_number = (int)$request->get('selectMenuFormperson');

  if(!$request->get('selectMenuFormuse_time')) return ['err'=>1, 'message'=>'ご利用時間を入力してください。'];
  $content_date_user->use_time = (int)$request->get('selectMenuFormuse_time');
  if(!$request->get('selectMenuFormstart')) return ['err'=>1, 'message'=>'ご利用日時を入力してください。'];
  $content_date_user->start = $request->get('selectMenuFormstart');

  if( mb_strlen( $request->get('selectMenuForminfo') ) > 2000) return ['err'=>1, 'message'=>'メッセージは2000文字以内でご登録ください。'];
  $content_date_user->message = $request->get('selectMenuForminfo');
  $content_date_user->percent = $content_date->percent;


  //time check public ok (last_order=everything use) and use 3 days ok
  //---------------
  $result = UtilYoyaku::checkDateYoyaku(
      $content_date_user->start,
      $content->last_time_yoyaku,
      $content_date->start,
      $content_date->end,
      $content->last_time_order);
  if($result['err']) return $result;
  //----------------


  //service 2,10,11 only
  //----------------
  $createUseTimeDescAll = $this->createUseTimeDescAll($content, $content_date, $content_date_user);
  //logger($createUseTimeDescAll);
  $content_date_user->end = $createUseTimeDescAll['content_date_user_end'];
  $content_date_user->use_time_desc = json_encode($createUseTimeDescAll['use_time_desc']);

  $useCapacities = Utilowner::checkAndGetUseCapacities($request, $content, $content_date_user);
  if($useCapacities['err']) return $useCapacities;
  $content_date_user->capacities_desc = json_encode(Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $useCapacities['capacity_ids'], null));
  $content_date_user->capacity_ids  = json_encode($useCapacities['capacity_ids']);
  $content_date_user->capacities_summary = json_encode($useCapacities['capacities_summary']);
  $price_sum = $useCapacities['price_sum'];
  //active2 type8 only logic
  if($useCapacities['type8']>=1){
    $DT_use_start = new DateTime($content_date->start);
    $DT_use_end = new DateTime($content_date->end);
    $diff = $DT_use_start->diff($DT_use_end);
    $use_time_today = 0;
    $use_time_today += $diff->d * 24 * 60; // 日の差分
    $use_time_today += $diff->h * 60; // 時の差分
    $use_time_today += $diff->i; // 分の差分
    $content_date_user->use_time = $use_time_today;
    $use_start_end = [];
    $use_start_end[] = ['use_start'=>$content_date->start, 'use_end'=>$content_date->end];
    $use_time_desc = [
      'total_use_time'=>$content_date_user->use_time,
      1=>[ 'use_time'=>$content_date_user->use_time, 'use_start_end'=>$use_start_end ],
      2=>[],
      3=>[]
    ];
    $content_date_user->end = $content_date->end;
    $content_date_user->use_time_desc = json_encode($use_time_desc);
  }

  $content_date_user->menus_desc = json_encode([]);
  $content_date_user->menu_ids = json_encode([]);
  $content_date_user->menus_summary = json_encode([]);


  
  $content_date_user->price_sum = $price_sum;
  $content_date_user->payment_sum = $content_date_user->price_sum*1.08;
  if($content_date_user->payment_sum>9999999) return ['err'=>3, 'message'=>'ネット決済は50~9,999,999円まで対応しています。<br />店舗様に直接お問合せください。'];
  //if($content_date_user->payment_sum<50) $content_date_user->payment_sum = 50;
  $content_date_user->save();
  $content_date_user = Content_date_users::find($content_date_user->id);
  
  $paypal_link = UtilYoyaku::paypal($content, $content_date_user);

  $ans = ['content_date_user'=>$content_date_user, 'owners_user'=>$owners_user, 'payment'=>$content_date->payment, 'discount'=>Utilowner::getDiscount($content, $content_date_user->use_time), 'paypal_link'=>$paypal_link];

  return $ans;

}



//service 2,10,11 only
//----------------
function createUseTimeDesc($content_id, $start, $day){
  $date_start_day   = date('Y-m-d 00:00:00', strtotime( '+' . $day . ' day ' . $start));
  $date_end_day     = date('Y-m-d 23:59:59', strtotime( '+' . $day . ' day ' . $start));
  $date_end_last    = date('Y-m-d 23:59:59', strtotime( '+' . $day+1 . ' day ' . $start));
  $content_dates = Content_date::select('id','start','end')
    ->where('content_id',$content_id)
    ->where('start','>=',$date_start_day)
    ->where('start','<',$date_end_day)
    ->where('end','<=',$date_end_last)
    ->orderBy('start','asc')
    ->take(10)
    ->get();
  //logger($content_dates);
  $use_time_1day = 0;
  $day1_end = null;
  $use_start_end = [];
  foreach($content_dates as $content_date){
    $day1_end = $content_date->end;
    $DT_use_start = new DateTime($content_date->start);
    $DT_use_end = new DateTime($content_date->end);
    $diff = $DT_use_start->diff($DT_use_end);
    $use_time_1day += $diff->d * 24 * 60; // 日の差分
    $use_time_1day += $diff->h * 60; // 時の差分
    $use_time_1day += $diff->i; // 分の差分
    $use_start_end[] = ['use_start'=>$content_date->start, 'use_end'=>$content_date->end];
  }
  return ['desc'=>[ 'use_time'=>$use_time_1day, 'use_start_end'=>$use_start_end ], 'end'=>$day1_end];
}
//service 2,10,11 only
//----------------
function createUseTimeDescAll($content, $content_date, $content_date_user){
  if($content_date_user->use_time===2 or $content_date_user->use_time===3){
    //today logic
    $DT_use_start = new DateTime($content_date_user->start);
    $DT_use_end = new DateTime($content_date->end);
    $diff = $DT_use_start->diff($DT_use_end);
    $use_time_today = 0;
    $use_time_today += $diff->d * 24 * 60; // 日の差分
    $use_time_today += $diff->h * 60; // 時の差分
    $use_time_today += $diff->i; // 分の差分
    $use_start_end = [];
    $use_start_end[] = ['use_start'=>$content_date_user->start, 'use_end'=>$content_date->end];
    $date_start_today = $content_date->end;
    $date_end_today   = date('Y-m-d 23:59:59', strtotime($content_date_user->start));
    $date_end_last   = date('Y-m-d 23:59:59', strtotime(' +1 day ' . $content_date_user->start));
    if(
      $content_dates = Content_date::select('id','start','end')
      ->where('content_id',$content->id)
      ->where('start','>=',$date_start_today)
      ->where('start','<',$date_end_today)
      ->where('end','<=',$date_end_last)
      ->orderBy('start','asc')
      ->take(10)
      ->get()
    ){
      foreach($content_dates as $date_val){
        $DT_use_start = new DateTime($date_val->start);
        $DT_use_end = new DateTime($date_val->end);
        $diff = $DT_use_start->diff($DT_use_end);
        $use_time_today += $diff->d * 24 * 60; // 日の差分
        $use_time_today += $diff->h * 60; // 時の差分
        $use_time_today += $diff->i; // 分の差分
        $use_start_end[] = ['use_start'=>$date_val->start, 'use_end'=>$date_val->end];
      }
    }
    $use_time_desc = [
      1=>[ 'use_time'=>$use_time_today, 'use_start_end'=>$use_start_end ],
      2=>[],
      3=>[]
    ];
  }
  switch ($content_date_user->use_time){
    case 2:
      //1day logic
      $createUseTimeDesc = $this->createUseTimeDesc($content->id, $content_date_user->start, 1);
      $use_time_desc[2] = $createUseTimeDesc['desc'];
      $content_date_user_end = $createUseTimeDesc['end'];
      $use_time_desc['total_use_time'] = $use_time_desc[1]['use_time'] + $use_time_desc[2]['use_time'];
      break;
    case 3:
      //1day logic
      $createUseTimeDesc = $this->createUseTimeDesc($content->id, $content_date_user->start, 1);
      $use_time_desc[2] = $createUseTimeDesc['desc'];
      //2day logic
      $createUseTimeDesc = $this->createUseTimeDesc($content->id, $content_date_user->start, 2);
      $use_time_desc[3] = $createUseTimeDesc['desc'];
      $content_date_user_end = $createUseTimeDesc['end'];
      $use_time_desc['total_use_time'] = $use_time_desc[1]['use_time'] + $use_time_desc[2]['use_time'] + $use_time_desc[3]['use_time'];
      break;
    default:
      $DT_use_end = new DateTime($content_date_user->start);
      $DT_use_end->modify('+'.$content_date_user->use_time.' minute');
      $use_start_end[] = ['use_start'=>$content_date_user->start, 'use_end'=>$DT_use_end->format('Y-m-d H:i:s')];
      $use_time_desc = [
        'total_use_time'=>$content_date_user->use_time,
        1=>[ 'use_time'=>$content_date_user->use_time, 'use_start_end'=>$use_start_end ],
        2=>[],
        3=>[]
      ];
      $content_date_user_end = $DT_use_end->format('Y-m-d H:i:s');
      break;
  }

  return ['use_time_desc'=>$use_time_desc, 'content_date_user_end'=>$content_date_user_end];

}









public function postYoyakuComfirmDone(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  //check over
  $content_date_user_id = (int)$request->get('content_date_users_id');
  if(!$content_date_user = Content_date_users::find($content_date_user_id)) return ['err'=>1, 'message'=>'再度ご予約下さい。'];
  $content_date = Content_date::find($content_date_user->content_date_id);

  //check status
  $result = UtilYoyaku::checkDateStatus($content_date->status);
  if($result['err']) return $result;
  $status = $content_date->status;
  $content_date->status = 30;
  $content_date->save();

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
    return $result;
  }
  //----------------

  //--------------
  //--------------
  $useCapacities = Utilowner::checkUsedCapacities($content, $content_date_user);
  if($useCapacities['err']){
    $content_date->status = $status;
    $content_date->save();
    return $useCapacities;
  }

  // check card all service use
  //$payment = $content_date->payment;
  //if($content->user_id === Utilowner::getOwnerId()) $payment = 2;

  //if($payment===1){
  //  $paing = UtilYoyaku::paing($request, $content, $content_date, $content_date_user);
  //  if($paing['err']){
  //    $content_date->status = $status;
  //    $content_date->save();
  //    if($paing['redirect']){
  //      return back()->with('warning', $paing['message']);
  //    }else{
  //      return $paing;
  //    }
  //  } 
  //  $content_date_user->payment_charge_id = $paing['payment_charge_id'];
  //}

  //change status
  //$content_date_user->goin = ($payment===1) ? 2 : 1;
  $content_date_user->goin = 1;
  $content_date_user->yoyaku_id = 'coordiy_' . $content_date_user->id . '_' . uniqid();
  $content_date_user->save();

  UtilYoyaku::chengeStatus($content, $content_date);

  $user = User::find(Utilowner::getOwnerId());
  UtilYoyaku::yoyakuDoneMail($content, $content_date_user, $user);
  UtilYoyaku::yoyakuDoneMessage($content, $content_date_user);
  UtilYoyaku::postOwnersUsersUsedContent($content, $content_date_user);

  if($content->user_id===Utilowner::getOwnerId()){
    return 'owners_yoyaku';
  }elseif($request->has('payjp-token')){
    return redirect('/account/yoyaku/history/' . $content_date_user->id . '/show')->with('success', '予約しました。予約内容をご確認ください。');
  }else{
    return $content_date_user->id;
  }


}






























}


