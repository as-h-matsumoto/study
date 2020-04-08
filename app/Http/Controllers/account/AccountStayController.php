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

class AccountStayController extends Controller {


public function __construct()
{
}








public function postYoyakuComfirm(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  /*
  selectMenuForperson ： ご利用人数
  selectMenuFormstart : ご予約日時
  menu + menu.id
  menu + menu.id + number
  modalSelectMenuId : date_id
  selectMenuForminfo : 連絡事項
  */
  //logger($request->all());

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

  if($request->has('selectMenuFormnonesmoking')) $content_date_user->nonesmoking = 1;
  if(!(int)$request->get('selectMenuFormperson')) return ['err'=>1, 'message'=>'ご利用人数を入力してください。'];
  $content_date_user->join_user_number = (int)$request->get('selectMenuFormperson');
  $content_date_user->start = $content_date->start;
  $content_date_user->end = $content_date->end;
  
  if( mb_strlen($request->get('selectMenuForminfo')) > 2000) return ['err'=>1, 'message'=> 'ご質問などは2000文字以内で入力ください。']; 
  $content_date_user->message = $request->get('selectMenuForminfo');
  $content_date_user->percent = $content_date->percent;

  //--------------
  $useCapacities = Utilowner::checkAndGetUseCapacities($request, $content, $content_date_user);
  if($useCapacities['err']) return $useCapacities;
  $content_date_user->capacities_desc = json_encode(Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $useCapacities['capacity_ids'], null));
  $content_date_user->capacity_ids  = json_encode($useCapacities['capacity_ids']);
  $content_date_user->capacities_summary = json_encode($useCapacities['capacities_summary']);
  $content_date_user->join_user_all_data = json_encode($useCapacities['join_user_all_data']);
  $capa_price_sum = $useCapacities['price_sum'];

  $mustMenu = false;
  foreach($useCapacities['capacities_summary'] as $capacity_summary){
    //logger($capacity_summary);
    if($capacity_summary['type']===1){
      //logger('type yes');
      //logger('price: ' . $capacity_summary['price']);
      if($capacity_summary['price']<=0) $mustMenu = true;
    }
  }

  $useMenus = Utilowner::checkAndGetUseMenus($request, $content, $content_date_user);
  if($useMenus['err']) return $useMenus;
  $content_date_user->menus_desc = json_encode(Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $useMenus['menu_ids'], null));
  $content_date_user->menu_ids = json_encode($useMenus['menu_ids']);
  $content_date_user->menus_summary = json_encode($useMenus['menus_summary']);
  $price_sum = $useMenus['price_sum'];
  $content_date_user->end = ($useMenus['content_date_user_end']) ? $useMenus['content_date_user_end'] : $content_date->end;
  if($mustMenu){
    //logger('must yes');
    if(!$useMenus['menus_summary']) return ['err'=>3,'message'=>'その宿泊ルームをご利用の際は、<br />ディナーメニューを1つ選択してください。'];
    $diner_no = true;
    foreach($useMenus['menus_summary'] as $menus_summary){
      if($menus_summary['type']===1){
        $diner_no = false;
      }
    }
    if($diner_no) return ['err'=>3,'message'=>'その宿泊ルームをご利用の際は、<br />ディナーメニューも最低1つ選択してください。'];
  }else{
    //logger('must no');
  }

  $price_sum = $price_sum + $capa_price_sum;
  $content_date_user->price_sum = $price_sum;
  $content_date_user->payment_sum = $price_sum*1.08;
  if($content_date_user->payment_sum>9999999) return ['err'=>3, 'message'=>'ネット決済は50~9,999,999円まで対応しています。<br />店舗様に直接お問合せください。'];
  //if($content_date_user->payment_sum<50) $content_date_user->payment_sum = 50;
  $content_date_user->save();
  $content_date_user = Content_date_users::find($content_date_user->id);
  
  $paypal_link = UtilYoyaku::paypal($content, $content_date_user);

  $ans = ['content_date_user'=>$content_date_user, 'owners_user'=>$owners_user, 'payment'=>$content_date->payment, 'paypal_link'=>$paypal_link];

  return $ans;

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

  //check used over to menus
  $useMenus = Utilowner::checkUsedMenus($content, $content_date_user);
  if($useMenus['err']){
    $content_date->status = $status;
    $content_date->save();
    return $useMenus;
  }

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

  ////change status
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


