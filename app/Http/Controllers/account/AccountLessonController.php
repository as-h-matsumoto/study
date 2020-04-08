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

class AccountLessonController extends Controller {


public function __construct()
{
}







// lesson4, tour6, ticket7で利用
public function postYoyakuComfirm(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  $content_date_id = (int)$request->get('modalSelectMenuId');
  if(!$content_date = Content_date::find($content_date_id)) return ['err'=>1, 'message'=>'現在、ご予約を承っておりません。'];
  $result = UtilYoyaku::checkDateStatus($content_date->status);
  if($result['err']) return $result;
  $content_date_user = new Content_date_users;
  if($content->service===62 or $content->service===69){
    if(!(int)$request->get('selectMenuFormperson')) return ['err'=>1, 'message'=>'ご利用人数を入力してください。'];
    $content_date_user->join_user_number = (int)$request->get('selectMenuFormperson');
  }else{
    $content_date_user->join_user_number = 1;
  }
  
  $content_date_user->start = $content_date->start;
  $content_date_user->end = $content_date->end;
  $content_date_user->content_id = $content_id;
  $content_date_user->user_id = Utilowner::getOwnerId();
  $owners_user = UtilYoyaku::postOwnersUsers($content, $request);
  if($owners_user['err']) return $owners_user;
  $content_date_user->owners_user_id = $owners_user->id;
  if( mb_strlen($request->get('selectMenuForminfo')) > 2000) return ['err'=>1, 'message'=> 'ご質問などは2000文字以内で入力ください。']; 
  $content_date_user->message = $request->get('selectMenuForminfo');
  $content_date_user->goin = 0;
  $content_date_user->content_date_id = $content_date->id;
  $content_date_user->percent = $content_date->percent;

  $content_date_user->description = $content_date->description; //変更される可能性があるので保存
  $content_date_user->ticket_type = $content_date->ticket_type; //将来の機能
  
  $content_date_user->capacities_desc = json_encode([]);
  $content_date_user->capacity_ids = json_encode([]);
  $content_date_user->capacities_summary = json_encode([]);



  if( false and $content->service===69){ // tour の C/O後の機能
    $content_date_user->join_user_all_data = [];
  }
  if( $content->service===69){ // tour の 出発エリア
    $content_date_user->from_tour = $content_date->from_tour;
  }

  //check use menus all use service
  $useMenus = Utilowner::checkAndGetUseMenus($request, $content, $content_date_user);
  if($useMenus['err']) return $useMenus;
  $content_date_user->menus_desc = json_encode(Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $useMenus['menu_ids'], null));
  $content_date_user->menu_ids = json_encode($useMenus['menu_ids']);
  $content_date_user->menus_summary = json_encode($useMenus['menus_summary']);
  $price_sum = $useMenus['price_sum'];
  
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

  //check used over to menus
  $useMenus = Utilowner::checkUsedMenus($content, $content_date_user);
  if($useMenus['err']){
    $content_date->status = $status;
    $content_date->save();
    return $useMenus;
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


