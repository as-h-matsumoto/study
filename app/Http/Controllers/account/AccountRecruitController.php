<?php namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;

use App\User;
use App\models\User_recruit;

use App\models\Place;
use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_menu_recruit;

use Auth;
use DB;
use Redirect;
use Util;
use UtilYoyaku;
use Utilowner;
use DateTime;

use Illuminate\Http\Request;

class AccountRecruitController extends Controller {


public function __construct()
{
  // recruit13で利用
}






public function postEntry(Request $request, $content_id)
{

  if($content_date_user = Content_date_users::where('content_id',$content_id)->where('user_id',Auth::user()->id)->where('recruit_status_id','>=',8)->first()){
    return back()->with('info', '現在進行中です。結果をお待ちください。');
  }

  if(!$user_recruit = User_recruit::where('user_id',Auth::user()->id)->first()){
    return redirect('/account/profile/recruit/edit')->with('info', '先に、求人プロフィールを登録してください');
  }
  $user_recruit->experience = $request->get('experience');
  $user_recruit->description = $request->get('description');

  $content_date_user = new Content_date_users;
  $content_date_user->content_id = $content_id;
  $content_date_user->content_date_id = 0;
  $content_date_user->user_id = Auth::user()->id;
  $content_date_user->recruit_status_id = 0;
  $content_date_user->recruit_entry_job = $request->get('job');
  $content_date_user->recruit_saiyo_type = $request->get('saiyoType');
  $content_date_user->user_recruit = json_encode($user_recruit);
  $content_date_user->start = date('Y-m-d 00:00:00');
  $content_date_user->end = date('Y-m-d 23:00:00');;
  $content_date_user->join_user_number = 1;
  $content_date_user->menu_ids = json_encode([]);
  $content_date_user->menus_summary = json_encode([]);
  $content_date_user->menus_desc = json_encode([]);
  $content_date_user->capacity_ids = json_encode([]);
  $content_date_user->capacities_summary = json_encode([]);
  $content_date_user->capacities_desc = json_encode([]);
  $content_date_user->price_sum = 0;
  $content_date_user->payment_sum = 0;
  $content_date_user->cancel_price = 0;
  $content_date_user->goin = 1;
  $content_date_user->save();

  $content_date_user->yoyaku_id = 'coordiy_' . $content_date_user->id . '_' . uniqid();
  $content_date_user->save();

  $user = Auth::user();
  $content = Contents::find($content_date_user->content_id);
  UtilYoyaku::recruitDoneMail($content, $content_date_user, $user);
  UtilYoyaku::recruitDoneMessage($content, $content_date_user);

  return redirect('/account/yoyaku/history/'.$content_date_user->id.'/show')->with('success', 'エントリーを行いました。ご返答をお待ちください。');

}














public function postYoyakuComfirm(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  $content_date_id = (int)$request->get('modalSelectMenuId');
  if(!$content_date = Content_date::find($content_date_id)) return ['err'=>1, 'message'=>'現在、ご予約を承っておりません。'];
  $result = UtilYoyaku::checkDateStatus($content_date->status);
  if($result['err']) return $result;

  if(!$content_date_user = Content_date_users::where('content_id',$content->id)->where('user_id',Utilowner::getOwnerId())->first()){
    return ['err'=>1, 'message'=>'エントリーがみつかりません。'];
  }

  if(!$request->get('selectMenuFormstart')) return ['err'=>1, 'message'=>'ご利用日時を入力してください。'];
  $content_date_user->start = $request->get('selectMenuFormstart');

  $content_menu_recruit = Content_menu_recruit::select('time')->where('content_id',$content->id)->first();
  $DT_end = new DateTime($content_date_user->start);
  $DT_end->modify( '+' . $content_menu_recruit->time . ' minute');
  $content_date_user->end = $DT_end->format('Y-m-d H:i:s');

  $content_date_user->content_date_id = $content_date->id;

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

  $useCapacities = $this->checkAndGetUseCapacities($content, $content_date, $content_date_user);
  if($useCapacities['err']) return $useCapacities;
  $capacity_ids = [$useCapacities['use_capa']];
  $content_date_user->capacities_desc = json_encode(Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null));
  $content_date_user->capacity_ids = json_encode($capacity_ids);
  $capacities_summary = [];
  foreach(Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null) as $capa){
    $capacities_summary[$capa->id] = ['id'=>$capa->id, 'type'=>$capa->type, 'number'=>1, 'person'=>1, 'price'=>0];
  }
  $content_date_user->capacities_summary  = json_encode($capacities_summary);

  $content_date_user->save();
  $content_date_user = Content_date_users::find($content_date_user->id);
  
  $ans = ['content_date_user'=>$content_date_user, 'payment'=>$content_date->payment];

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

  //change status
  $content_date_user->save();

  UtilYoyaku::chengeStatus($content, $content_date);
  $user = User::find(Utilowner::getOwnerId());
  UtilYoyaku::yoyakuDoneRecruitMail($content, $content_date_user, $user);

  return $content_date_user->id;

}















function checkAndGetUseCapacities($content, $content_date, $content_date_user){

  $no = true;
  $use_capa = [];
  $capa_active_users = [];
  
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
      //$capacity_summary['number']は１以外ありえないが今はコードの複製がメリットあるため変更なし。
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
  $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

  foreach($capacities as $capa_id=>$capacity){
    if(!isset($capa_active_users[$capa_id]) or $capa_active_users[$capa_id] < $capacity->number){
        //logger('find aki !!!');
        $no = false;
        $use_capa = (int)$capacity['id'];
        break;
    }
  }

  //logger('use_capa:');
  //logger($use_capa);
  if($no){
    $ans['err'] = 1;
    $ans['message'] = 'ご指定の時間では空きがございませんでした。';
    return $ans;
  }else{
    return ['err'=>0, 'use_capa'=>$use_capa];
  }

}









}


