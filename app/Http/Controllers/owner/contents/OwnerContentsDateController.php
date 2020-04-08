<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Messages;
use App\models\Messages_notread;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_date_menu;
use App\models\Content_cancel_calendar;
use App\models\Content_menu_recruit;

use App\models\company;
use App\models\Company_calendar;
use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;
use App\models\Owners_users;
use App\models\Owner_pay;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use Mail;
use UtilYoyaku;
use Utilowner;
use DateTime;
use HolidayDateTime;


class OwnerContentsDateController extends Controller
{

public function __construct()
{

}





public function postOnOff(Request $request, $id)
{

  $content = Contents::find($id);

  $content_date_user_id = (int)$request->get('content_date_user_id');
  if(!$content_date_user = Content_date_users::find($content_date_user_id)){
    return ['err'=>1, 'message'=>'ご予約者が見つかりません。'];
  }

  $content_date_user->onOff = ($content_date_user->onOff === 0) ? 1 : 0;
  if($content_date_user->onOff === 0){
    $content_date_user->end = date("Y-m-d H:i:s");
  }
  $content_date_user->save();


  return $content_date_user->onOff;


}







public function postMessage(Request $request, $id)
{

  //validation
  $user_id = (int)$request->get('user_id');
  if(!$to_user = User::find($user_id)){
    return ['err'=>1, 'message'=>'送信先が見つかりませんでした。'];
  }
  if( !$request->get('message') ) return ['err'=>1, 'message'=> 'メッセージを入力してください。']; 
  if( mb_strlen($request->get('message')) < 10) return ['err'=>1, 'message'=> 'メッセージが短すぎます。'];
  if( mb_strlen($request->get('message')) > 2000) return ['err'=>1, 'message'=> 'メッセージは2000文字以内で入力ください。']; 

  $message = new Messages;
  $message->user_id = Utilowner::getOwnerId();
  $message->to_user_id = $to_user->id;
  $message->message = $request->get('message');
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();

  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>Utilowner::getOwnerId(),
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  $auth_user = User::find(Utilowner::getOwnerId());
  $data = array(
    'to_user' => $to_user,
    'auth_user' => $auth_user,
    'words' => $message
  );
  Mail::send('emails.account.message.send', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($to_user->email, $to_user->name);
    $m->bcc('admin@coordiy.com', '[Coordiy]');
    $m->subject('[Coordiy]メッセージが届いています。');
  });

  return ['err'=>0, 'message'=>'メッセージを送信しました。'];

}



public function postYoyakuCancel(Request $request, $id)
{

  $content = Contents::find($id);

  $content_date_user_id = (int)$request->get('content_date_user_id');
  if(!$content_date_user = Content_date_users::find($content_date_user_id)){
    return ['err'=>1, 'message'=>'ご予約者が見つかりません。'];
  }
  if( !$request->get('message') ) return ['err'=>1, 'message'=> 'メッセージを入力してください。']; 
  if( mb_strlen($request->get('message')) < 10) return ['err'=>1, 'message'=> 'メッセージが短すぎます。'];
  if( mb_strlen($request->get('message')) > 2000) return ['err'=>1, 'message'=> 'メッセージは2000文字以内で入力ください。']; 

  if($content_date_user->goin===9) return ['err'=>1, 'message'=>'すでにキャンセル済みです。'];
  if($content_date_user->goin===2) return ['err'=>3, 'message'=>'支払い済みのご予約者様は<br />オーナー様からキャンセルできません。<br />ご予約者様ご自身でキャンセルいただくよう<br />ご依頼をお願いいたします。'];

  $DT_now = new DateTime(date('Y-m-d H:i:s'));
  $DT_request_date = new DateTime($content_date_user->start);
  if($DT_now >= $DT_request_date) return ['err'=>1, 'message'=>'過去のご予約はキャンセルできません。'];

  $content_date_user->goin = 9;
  $content_date_user->save();

  $to_user = User::find($content_date_user->user_id);
  $message = new Messages;
  $message->user_id = Utilowner::getOwnerId();
  $message->to_user_id = $to_user->id;
  $message->message = $request->get('message');
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();

  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>Utilowner::getOwnerId(),
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  $auth_user = User::find(Utilowner::getOwnerId());
  $data = array(
    'to_user' => $to_user,
    'auth_user' => $auth_user,
    'content' => $content,
    'words' => $message
  );
  Mail::send('emails.owner.yoyakuCancel', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($to_user->email, $to_user->name);
    $m->bcc('admin@coordiy.com', '[Coordiy予約]');
    $m->subject('[Coordiy予約]オーナー様によるご予約キャンセル');
  });

  return ['err'=>0, 'message'=>'ご予約をキャンセルしました。'];

}











function getMenus($content, $request)
{

  $menu_ids = [];
  $menus_summary = [];

  if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91 ) ){
    $menus_all = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
    $id_menus = [];
    foreach($menus_all as $val){
      $id_menus[$val->id] = $val;
    }
    foreach($request->all() as $key=>$val){
      $val = (int)$val;
      if(strpos($key,'publicMenuNumber') !== false) continue;
      if(strpos($key,'publicMenuPerson') !== false) continue;
      if(strpos($key,'publicMenuPrice') !== false) continue;
      if(strpos($key,'publicMenuSimultaneously') !== false) continue;
      if(strpos($key,'publicMenu') !== false){
        if($content->service===62 or $content->service===69 or $content->service===101){
          //if( !($request->get('publicMenuPrice' . $val) >= 1) ) return ['err'=>1, 'message'=>$id_menus[$val]->name . 'の料金を確認ください。'];
        }

        if($content->service===65 or $content->service===77 or $content->service===90){
          if( !($request->get('publicMenuSimultaneously' . $val) >= 1) ) return ['err'=>1, 'message'=>$id_menus[$val]->name . 'の同時施術人数を確認ください。'];
        }

        if( ($content->service===15 and $id_menus[$val]->type===2) or $content->service===62 or $content->service===69){
          if( !($request->get('publicMenuPerson' . $val) >= 1) ) return ['err'=>1, 'message'=>$id_menus[$val]->name . 'の最低申込人数を確認ください。'];
        }

        if(
            $content->service===15 ||
            $content->service===62 ||
            $content->service===69 ||
            $content->service===101 ||
            $content->service===81
        ){
          if( !($request->get('publicMenuNumber' . $val) >= 1) )
          {
            switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'food': $Nname += '提供'; break;
                case 'lesson': $Nname += '枠'; break;
                case 'tour': $Nname += '枠'; break;
                case 'ticket': $Nname += '枚'; break;
                case 'stay': $Nname += '提供'; break;
            }
            return ['err'=>1, 'message'=>$id_menus[$val]->name . 'の' . $Nname . '数を確認ください。'];
          }
        }
        
        $number = ($request->get('publicMenuNumber' . $val)) ? (int)$request->get('publicMenuNumber' . $val) : $id_menus[$val]->number;
        $person = ($request->get('publicMenuPerson' . $val)) ? (int)$request->get('publicMenuPerson' . $val) : $id_menus[$val]->person;
        $price = ($request->get('publicMenuPrice' . $val)) ? (int)$request->get('publicMenuPrice' . $val) : $id_menus[$val]->price;
        $simultaneously = ($request->get('publicMenuSimultaneously' . $val)) ? (int)$request->get('publicMenuSimultaneously' . $val) : $id_menus[$val]->simultaneously;

        $menu_ids[] = $val;
        $menus_summary[$val] = ['id'=>$val,'type'=>$id_menus[$val]->type,'number'=>$number, 'person'=>$person, 'price'=>$price, 'simultaneously'=>$simultaneously];
      }
    }
    if(empty($menu_ids)){
      if( $content->service===62 or $content->service===69 or $content->service===101 ){
        $message = '１つメニューを選んでください。';
      }else{
        $message = '１つ以上メニューを選んでください。';
      }
      return ['err'=>1, 'message'=>$message];
    }
  }

  return ['err'=>0, 'menu_ids'=>$menu_ids, 'menus_summary'=>$menus_summary];

}

function getLunchs($content, $request)
{

  $lunch_ids = [];
  $lunchs_summary = [];

  $FirstContentDateFormMenuTypeSelect = false;
  if($content->service===15) $FirstContentDateFormMenuTypeSelect = (int)$request->get('FirstContentDateFormMenuTypeSelect');
  if($FirstContentDateFormMenuTypeSelect===2){
    $menus_all = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
    $id_menus = [];
    foreach($menus_all as $val){
      $id_menus[$val->id] = $val;
    }
    //logger($request->all());
    foreach($request->all() as $key=>$val){
      $val = (int)$val;
      if(strpos($key,'lunchMenuNumber') !== false) continue;
      if(strpos($key,'lunchMenuPerson') !== false) continue;
      if(strpos($key,'lunchMenu') !== false){
        $number = (int)$request->get('lunchMenuNumber' . $val);
        $person = (int)$request->get('lunchMenuPerson' . $val);
        if( !($number >= 1) ) return ['err'=>1, 'message'=>$id_menus[$val]->name . 'の数を確認ください。'];
        $person = ($person >= 1) ? $person : $id_menus[$val]->person;
        $lunch_ids[] = $val;
        $lunchs_summary[$val] = ['id'=>$val,'type'=>$id_menus[$val]->type,'number'=>$number, 'person'=>$person, 'price'=>$id_menus[$val]->price];
      }
    }
    if( empty($lunch_ids) ) return ['err'=>1, 'message'=>'１つ以上ランチメニューを選んでください。'];
  }

  return ['err'=>0, 'lunch_ids'=>$lunch_ids, 'lunchs_summary'=>$lunchs_summary];

}





function getCapacities($content, $request)
{

  $capacity_ids = [];
  $capacities_summary = [];

  if( 
    $content->service===15 or
    $content->service===39 or
    $content->service===65 or
    $content->service===77 or
    $content->service===90 or
    $content->service===81 or
    $content->service===85 or
    $content->service===89 or
    $content->service===91 ){
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
    $id_capacities = [];
    foreach($capacities as $val){
      $id_capacities[$val->id] = $val;
    }
    foreach($request->all() as $key=>$val){
      $val = (int)$val;
      if(strpos($key,'publicCapacityNumber') !== false) continue;
      if(strpos($key,'publicCapacityPerson') !== false) continue;
      if(strpos($key,'publicCapacity') !== false){

        if( !( ($content->service===39 and $id_capacities[$val]->type>=5) or ($content->service===81 and $id_capacities[$val]->type===2) ) )
        {
          if( !$request->get('publicCapacityNumber' . $val) >=1 ) return ['err'=>1, 'message'=>$id_capacities[$val]->name . 'の数を確認ください。'];
        }
        if(
          ($content->service===39 and $id_capacities[$val]->type!==8 and $id_capacities[$val]->type>=5) 
          )
        {
          if( !$request->get('publicCapacityPerson' . $val) >=1 ) return ['err'=>1, 'message'=>$id_capacities[$val]->name . 'の収容人数を確認ください。'];
        }

        $number = ($request->get('publicCapacityNumber' . $val)) ? (int)$request->get('publicCapacityNumber' . $val) : $id_capacities[$val]->number;
        $person = ($request->has('publicCapacityPerson' . $val)) ? (int)$request->get('publicCapacityPerson' . $val) : $id_capacities[$val]->person;

        if(!$number) $number = 1;
        if(!$person) $person = 1;

        if( (int)$request->get('publicCapacityNumber' . $val) > $id_capacities[$val]->number ){
          if($id_capacities[$val]->name){
            $name = $id_capacities[$val]->name;
          }elseif($id_capacities[$val]->type){
            $name = Util::getCapacityType($content->service, $id_capacities[$val]->type);
          }else{
            $name = UtilYoyaku::getNewContentCapacity($content->service);
          }
          $message = $name . 'の数は、登録数より多くできません。<br />' . UtilYoyaku::getNewContentCapacity($content->service) . '設定で変更してください。';
          return ['err'=>3, 'message'=>$message];
        }

        $capacity_ids[] = $val;
        $capacities_summary[$val] = ['id'=>$val,'type'=>$id_capacities[$val]->type,'number'=>(int)$number, 'person'=>(int)$person, 'price'=>$id_capacities[$val]->price];

      }
    }

    if( !$capacity_ids ) return ['err'=>1, 'message'=>'１つ以上'.UtilYoyaku::getNewContentCapacity($content->service).'を選んでください。'];

  }

  return ['err'=>0, 'capacity_ids'=>$capacity_ids, 'capacities_summary'=>$capacities_summary];

}









// service all
public function postOneDateDelete(Request $request, $id)
{

  //logger($request->all());
  $content = Contents::select('id','service')->find($id);
  if(!$content_date = Content_date::find((int)$request->get('content_date_id'))) return ['err'=>1, 'message'=>'予約受付がみつかりません。'];
  
  $active_user = Content_date_users::select('id')->whereIn('goin',[1,2])->where('Content_date_id',$content_date->id)->first();
  if($active_user) return ['err'=>1, 'message'=>'ご予約者がいますので削除できません。'];
  $content_date_id = $content_date->id;
  $content_date_create_number = $content_date->content_date_create_number;
  $content_date->delete();

  $count = Content_date::select('id')->where('content_id',$content->id)->where('content_date_create_number',$content_date_create_number)->count();
  if($count>=1){
    return ['err'=>0, 'action'=>1, 'content_date_create_number'=>$content_date_create_number];
  }else{
    return ['err'=>0, 'action'=>0];
  }

}


// service all
public function postOneRelationDateDelete(Request $request, $id)
{

  //logger($request->all());
  $content = Contents::select('id','service')->find($id);
  if( !$content_dates = Content_date::select('id')
    ->where('content_id',$id)
    ->where('content_date_create_number',(int)$request->get('deleteModalEventFormcontent_date_create_number') )
    ->get()
  ) return ['err'=>1, 'message'=>'予約受付がみつかりません。'];

  //logger($content_dates);
  $active_user_exists = false;
  foreach($content_dates as $content_date_id){
    $active_user = Content_date_users::select('id')
      ->whereIn('goin',[1,2])
      ->where('Content_date_id',$content_date_id->id)
      ->first();
    if($active_user) {
      $active_user_exists = true;
      continue;
    }
    //logger('content_date_id->id: ' . $content_date_id->id);
    $content_date = Content_date::find($content_date_id->id);
    $content_date->delete();  
  }

  if($active_user_exists){
    return ['err'=>0, 'action'=>1];
  }else{
    return ['err'=>0, 'action'=>0];
  }
  
}









// service 1,2,4,6,7,10,11,13対応
public function postOneDate(Request $request, $id)
{

  //logger($request->all());
  $content = Contents::select('id','service','user_id')->find($id);
  if(!$content_date = Content_date::find((int)$request->get('content_date_id'))) return ['err'=>1, 'message'=>'予約受付がみつかりません。'];
  
  $active_user = Content_date_users::select('id')->whereIn('goin',[1,2])->where('Content_date_id',$content_date->id)->first();
  if($request->get('status')){
    $status = (int)$request->get('status');
    if( !($status===5 or $status===7 or $status===8) ){
      return ['err'=>1, 'message'=>'受付終了、中止、延期のみです。'];
    }
    $content_date->status = $status;
  }

  $content_date->percent =  ($request->get('percent')) ? (int)$request->get('percent') : null;
  if($request->get('payment')) $content_date->payment = $request->get('payment');

  if(!$request->get('startDate') or !$request->get('startTime')) return ['err'=>1, 'message'=>'開始日時を登録してください。'];
  $start = $request->get('startDate') . ' ' . $request->get('startTime');
  
  if(!$request->get('endDate') or !$request->get('endTime')) return ['err'=>1, 'message'=>'終了日時を登録してください。'];
  $end = $request->get('endDate') . ' ' . $request->get('endTime');

  $today = date("Y-m-d");
  $threeMonthAgo = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(strtotime($today) > strtotime($start) or strtotime($threeMonthAgo) < strtotime($start)){
    return ['err'=>1, 'message'=>'本日以降、翌々月末までの間で開催してください。'];
  }
  if(strtotime($today) > strtotime($end) or strtotime($threeMonthAgo) < strtotime($end)){
    return ['err'=>1, 'message'=>'本日以降、翌々月末までの間で開催してください。'];
  }

  if( !($content->service===62 or $content->service===69 or $content->service===101) ){
    $ans = Utilowner::checkStartEnd($start, $end, $id, $content_date);
    if($ans['err']) return $ans;
  }
  if($active_user){
    //logger('content_date->start: ' . $content_date->start . '  start: ' . $start);
    //logger('content_date->end' . $content_date->end . '  end: ' . $end);
    if($content_date->start !== $start or $content_date->end !== $end)
    {
      return ['err'=>1, 'message'=>'ご予約者がいますので開始終了は変更できません。'];
    }
  }
  $content_date->start = $start;
  $content_date->end   = $end;

  $content_date->description = ($request->has('createEventFormdescription')) ? $request->get('createEventFormdescription') : '';
  if( mb_strlen($content_date->description) > 1000) return ['err'=>1, 'message'=> '詳細は1000文字以内で入力ください。'];
  if($content->service===69 and $active_user){
    $from_tour = (int)$request->get('createEventFormfrom_tour');
    $to_tour = (int)$request->get('createEventFormto_tour');
    if($content_date->to_tour !== $to_tour){
      return ['err'=>1, 'message'=>'ご予約者様がいますので目的地エリアは変更できません。'];
    }
    if($content_date->from_tour !== $from_tour){
      return ['err'=>1, 'message'=>'ご予約者様がいますので出発地エリアは変更できません。'];
    }
  }
  $content_date->to_tour = ($request->get('createEventFormto_tour')) ? (int)$request->get('createEventFormto_tour') : 0;
  $content_date->from_tour = ($request->get('createEventFormfrom_tour')) ? (int)$request->get('createEventFormfrom_tour') : 0;

  //menu
  $menus = $this->getMenus($content, $request);
  if($menus['err']) return $menus;
  if( $content->service===62 or $content->service===69 or $content->service===101 ){
    $old_menu_ids = json_decode($content_date->menu_ids, true);
    if($old_menu_ids[0] !== $menus['menu_ids'][0]){
      if($active_user){
        return ['err'=>1, 'message'=>'ご予約者がいますのでメニューは変更できません。'];
      }
      $menu = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menus['menu_ids'][0]);
      $DT_end = new DateTime($start);
      if($menu->time<=29){
        $DT_end->modify( '+' . $menu->time . ' day');
      }else{
        $DT_end->modify( '+' . $menu->time . ' minute');
      }
      $content_date->end = $DT_end->format('Y-m-d H:i:s');
    }
  }
  $menu_ids = json_encode($menus['menu_ids']);
  $menus_summary = json_encode($menus['menus_summary']);

  //lunch
  $lunchs = $this->getLunchs($content, $request);
  if($lunchs['err']) return $lunchs;
  $lunch_ids = json_encode($lunchs['lunch_ids']);
  $lunchs_summary = json_encode($lunchs['lunchs_summary']);
  
  //capacity
  $capacities = $this->getCapacities($content, $request);
  if($capacities['err']) return $capacities;
  $capacity_ids = json_encode($capacities['capacity_ids']);
  $capacities_summary = json_encode($capacities['capacities_summary']);



  $content_date->menu_ids = $menu_ids;
  $content_date->menus_summary = $menus_summary;
  $content_date->lunch_ids = $lunch_ids;
  $content_date->lunchs_summary = $lunchs_summary;
  $content_date->capacity_ids = $capacity_ids;
  $content_date->capacities_summary = $capacities_summary;

  //登録から3ヶ月間は予約受付のみとなります。
  //$owner_pay_status = null;
  //if($owner_pay = Owner_pay::where('user_id',$content->user_id)->first()){
  //  if($owner_pay->status===1){
  //    $owner_pay_status = true;
  //  }
  //}
  //$owner_pay_status = true;
  //if(!$owner_pay_status and $content_date->payment===1) $content_date->payment = 2;

  $content_date->save();
  return 1;

}
















// only service 4,6,7,13
public function createEvent(Request $request, $id)
{

  //logger($request->all());
  $content = Contents::find($id);
  $content->content_date_create_number += 1;

  if( !($request->get('startDate') && $request->get('startTime')) ) return ['err'=>1, 'message'=>'開始日、開始時間を登録してください。'];
  $start = $request->get('startDate') . ' ' . $request->get('startTime');
  $today = date("Y-m-d");
  $threeMonthAgo = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(strtotime($today) > strtotime($start) or strtotime($threeMonthAgo) < strtotime($start)){
    return ['err'=>1, 'message'=>'本日以降、翌々月末までの間で開催してください。'];
  }

  if($content->service===91){
    if( !($request->get('endDate') && $request->get('endTime')) ) return ['err'=>1, 'message'=>'終了日、終了時間を登録してください。'];
    $end = $request->get('endDate') . ' ' . $request->get('endTime');
    if(strtotime($today) > strtotime($end) or strtotime($threeMonthAgo) < strtotime($end)){
      return ['err'=>1, 'message'=>'本日以降、翌々月末までの間で開催してください。'];
    }
  }

  if( $content->service===91 ){
    $payment = 2;
  }else{
    if(!$request->has('createEventFormpayment')) return ['err'=>1, 'message'=>'支払い設定を選んでください。'];
    $payment = (int)$request->get('createEventFormpayment');
    if(!$request->has('anderstand')) return ['err'=>1, 'message'=>'同意事項をご確認ください。'];
  }

  //登録から3ヶ月間は予約受付のみとなります。
  //$owner_pay_status = null;
  //if($owner_pay = Owner_pay::where('user_id',$content->user_id)->first()){
  //  if($owner_pay->status===1){
  //    $owner_pay_status = true;
  //  }
  //}
  //$owner_pay_status = true;
  //if(!$owner_pay_status and $payment===1) $payment = 2;

  if(!$request->get('createEventFormdescription')) return ['err'=>1, 'message'=>'詳細を入力してください。'];
  $description = $request->get('createEventFormdescription');
  if( mb_strlen($description) > 2000) return ['err'=>1, 'message'=> '詳細は2000文字以内で入力ください。']; 
  $to_tour = ($request->has('createEventFormto_tour')) ? (int)$request->get('createEventFormto_tour') : 0;
  $from_tour = ($request->has('createEventFormfrom_tour')) ? (int)$request->get('createEventFormfrom_tour') : 0;

  //menu
  $menus = $this->getMenus($content, $request);
  if($menus['err']) return $menus;
  $menu_ids = json_encode($menus['menu_ids']);
  $menus_summary = json_encode($menus['menus_summary']);

  //メニューの時間からエンド時間を決定
  if( $content->service===91 ){
  }else{
    $menu = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menus['menu_ids'][0]);
    $DT_end = new DateTime($start);
    if($menu->time<=29){
      $DT_end->modify( '+' . $menu->time . ' day');
    }else{
      $DT_end->modify( '+' . $menu->time . ' minute');
    }
    $end = $DT_end->format('Y-m-d H:i:s');
  }

  //lunch
  $lunchs = $this->getLunchs($content, $request);
  if($lunchs['err']) return $lunchs;
  $lunch_ids = json_encode($lunchs['lunch_ids']);
  $lunchs_summary = json_encode($lunchs['lunchs_summary']);
  
  //capacity
  $capacities = $this->getCapacities($content, $request);
  if($capacities['err']) return $capacities;
  $capacity_ids = json_encode($capacities['capacity_ids']);
  $capacities_summary = json_encode($capacities['capacities_summary']);

  $regularly = (int)$request->get('createEventFormregularly');

  $month3 = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))); 
  $datetimetoday = new DateTime($start);
  $datetimelastmonth = new DateTime($month3);
  $interval = $datetimetoday->diff($datetimelastmonth);
  $max = (int)$interval->format('%a');
  $week = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];

  if($regularly===1){ //一度だけ
    $this->createEventToDate($content->id, $content->content_date_create_number, $start, $end, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary, $description, $to_tour, $from_tour);
  }elseif($regularly===2){ //毎週
    for($x = 0; $x < $max; $x+=7){
      if($x===0){
        $start_plus = $start;
        $end_plus = $end;
      }else{
        $start_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $start));
        $end_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $end));
      }
      $this->createEventToDate($content->id, $content->content_date_create_number, $start_plus, $end_plus, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary, $description, $to_tour, $from_tour);
    }
  }elseif($regularly===3){ //平日
    for($x = 0; $x <= $max; $x++){
      if($x===0){
        $days = date("Y-m-d", strtotime($start));
        $start_plus = $start;
        $end_plus = $end;
      }else{
        $days = date("Y-m-d", strtotime($x . ' day ' . $start));
        $start_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $start));
        $end_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $end));
      }
      if(
        strtotime($days) === strtotime(date("Y") . "/12/30") or
        strtotime($days) === strtotime(date("Y") . "/12/31") or
        strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/1") or
        strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/2") or
        strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/3")
      ){
        //$weekname = 'New_Year_Holiday';
        continue;
      }elseif(HolidayDateTime::isHoliday(date("Y", strtotime($days)), date("m", strtotime($days)), date("d", strtotime($days)))){
        //$weekname = 'public_holiday';
        continue;
      }else{
        $datetime = new DateTime($days);
        if( (int)$datetime->format('w')>=1 and (int)$datetime->format('w')<=5 ){
          $this->createEventToDate($content->id, $content->content_date_create_number, $start_plus, $end_plus, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary, $description, $to_tour, $from_tour);
        }
      }
    }
  }elseif($regularly===4){ //毎日
    for($x = 0; $x < $max; $x++){
      if($x===0){
        $start_plus = $start;
        $end_plus = $end;
      }else{
        $start_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $start));
        $end_plus = date("Y-m-d H:i:s", strtotime($x . ' day ' . $end));
      }
      $this->createEventToDate($content->id, $content->content_date_create_number, $start_plus, $end_plus, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary, $description, $to_tour, $from_tour);
    }
  }

  $content->calendar_flug = 0;
  $content->save();

  if(!$exist = DB::table('contents_check')->where('content_id',$id)->first()){
    DB::table('contents_check')->insert(['content_id'=>$id]);
  }
  
  return 1;

}

function createEventToDate( $content_id, $content_date_create_number, $start, $end, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary, $description, $to_tour, $from_tour)
{
  $content_date = New Content_date;
  $content_date->content_id = $content_id;
  $content_date->content_date_create_number = $content_date_create_number;
  $content_date->status = 1;
  $content_date->start = $start;
  $content_date->end = $end;
  $content_date->payment = $payment;
  $content_date->description = $description;
  $content_date->to_tour = $to_tour;
  $content_date->from_tour = $from_tour;
  $content_date->menu_ids = $menu_ids;
  $content_date->menus_summary = $menus_summary;
  $content_date->lunch_ids = $lunch_ids;
  $content_date->lunchs_summary = $lunchs_summary;
  $content_date->capacity_ids = $capacity_ids;
  $content_date->capacities_summary = $capacities_summary;
  $content_date->save();
}





public function postFirstDate(Request $request, $id)
{

  $content = Contents::find($id);
  $content->content_date_create_number += 1;

  if(!$request->get('FirstContentDateFormstart')) return ['err'=>1, 'message'=>'予約受付け開始日時を登録してください。'];
  $today = date("Y-m-d");
  $twoMonthAgo = date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
  $target_day = $request->get('FirstContentDateFormstart');
  if(strtotime($today) > strtotime($target_day) or strtotime($twoMonthAgo) < strtotime($target_day)){
    return ['err'=>1, 'message'=>'本日以降、且つ、翌月中から選んでください。'];
  }
  if(!$request->has('FirstContentDateFormpayment')) return ['err'=>1, 'message'=>'支払い設定を選んでください。'];
  $payment = (int)$request->get('FirstContentDateFormpayment');
  //登録から3ヶ月間は予約受付のみとなります。
  //$owner_pay_status = null;
  //if($owner_pay = Owner_pay::where('user_id',$content->user_id)->first()){
  //  if($owner_pay->status===1){
  //    $owner_pay_status = true;
  //  }
  //}
  //if(!$owner_pay_status and $payment===1) $payment = 2;
  if(!$request->has('anderstand')) return ['err'=>1, 'message'=>'同意事項をご確認ください。'];

  //menu
  $menus = $this->getMenus($content, $request);
  if($menus['err']) return $menus;
  $menu_ids = json_encode($menus['menu_ids']);
  $menus_summary = json_encode($menus['menus_summary']);

  //lunch
  $lunchs = $this->getLunchs($content, $request);
  if($lunchs['err']) return $lunchs;
  $lunch_ids = json_encode($lunchs['lunch_ids']);
  $lunchs_summary = json_encode($lunchs['lunchs_summary']);
  
  //capacity
  $capacities = $this->getCapacities($content, $request);
  if($capacities['err']) return $capacities;
  $capacity_ids = json_encode($capacities['capacity_ids']);
  $capacities_summary = json_encode($capacities['capacities_summary']);


  //
  //createContentCalendar
  //
  $ans = Utilowner::createContentCalendar($id, $request);
  if($ans['err']) return $ans;
  $content_calendar = $ans['content_calendar'];

  //
  // insert content_date logic
  //
  $day = $request->get('FirstContentDateFormstart');
  //今月末日取得
  //$month1 = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
  //翌翌月末日取得
  $month3 = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y'))); 

  $datetimetoday = new DateTime($day);
  $datetimelastmonth = new DateTime($month3);
  $interval = $datetimetoday->diff($datetimelastmonth);
  $max = (int)$interval->format('%a');
  $week = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];

  //other day Other than first
  for($x = 0; $x < $max; $x++){
    if($x===0){ $days = $day; }else{ $days = date( "Y-m-d", strtotime($x . ' day ' . $day)); }
    if(
      strtotime($days) === strtotime(date("Y") . "/12/30") or
      strtotime($days) === strtotime(date("Y") . "/12/31") or
      strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/1") or
      strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/2") or
      strtotime($days) === strtotime(date("Y", strtotime('1 year')) . "/1/3")
    ){
      $weekname = 'New_Year_Holiday';
    }elseif(HolidayDateTime::isHoliday(date("Y", strtotime($days)), date("m", strtotime($days)), date("d", strtotime($days)))){
      $weekname = 'public_holiday';
    }else{
      $datetime = new DateTime($days);
      $weekname = $week[(int)$datetime->format('w')];
    }
    //logger($days . ' ' . $weekname);
    $this->addOneDayCalendarLogic($content_calendar, $content->content_date_create_number, $days, $weekname, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary);
  }
  $content->calendar_flug = 0;
  $content->save();

  if(!$exist = DB::table('contents_check')->where('content_id',$id)->first()){
    DB::table('contents_check')->insert(['content_id'=>$id]);
  }

  // return login
  return 1;

}

//
// main function of insert content_date
//
function addOneDayCalendarLogic($content_calendar, $content_date_create_number, $day, $weekname, $payment, $menu_ids, $menus_summary, $lunch_ids, $lunchs_summary, $capacity_ids, $capacities_summary){

  $colum_off = $weekname . '_off';
  $colum_start = $weekname . '_start';
  $colum_end = $weekname . '_end';
  $colum_start_junbi = $weekname . '_start_junbi';
  $colum_end_junbi = $weekname . '_end_junbi';
  $colum_end_nextday = $weekname . '_end_nextday';

  //logger($content_calendar);
  if(!$content_calendar->open_24){

    //
    // one day logic
    //
    if(!$content_calendar->$colum_off){
      $content_date = new Content_date;
      $content_date->content_id = $content_calendar->content_id;
      $content_date->status = 1;
      $content_date->start = $day . ' ' . $content_calendar->$colum_start;
      //junbi in
      if($content_calendar->$colum_start_junbi){
        $content_date->end = $day . ' ' . $content_calendar->$colum_start_junbi;
        $content_date->content_date_create_number = $content_date_create_number;
        $content_date->payment = $payment;
        $content_date->menu_ids = $menu_ids;
        $content_date->menus_summary = $menus_summary;
        $content_date->lunch_ids = $lunch_ids;
        $content_date->lunchs_summary = $lunchs_summary;
        $content_date->capacity_ids = $capacity_ids;
        $content_date->capacities_summary = $capacities_summary;
        $content_date->save();


        
        // afternoon logic
        $content_date = new Content_date;
        $content_date->content_id = $content_calendar->content_id;
        $content_date->status = 1;
        $content_date->start = $day . ' ' . $content_calendar->$colum_end_junbi;
        if($content_calendar->$colum_end_nextday){
          $content_date->end = date('Y-m-d', strtotime('1 day ' . $day)) . ' ' . $content_calendar->$colum_end;
        }else{
          $content_date->end = $day . ' ' . $content_calendar->$colum_end;
        }
        $content_date->content_date_create_number = $content_date_create_number;
        $content_date->payment = $payment;
        $content_date->menu_ids = $menu_ids;
        $content_date->menus_summary = $menus_summary;
        $content_date->lunch_ids = $lunch_ids;
        $content_date->lunchs_summary = $lunchs_summary;
        $content_date->capacity_ids = $capacity_ids;
        $content_date->capacities_summary = $capacities_summary;
        $content_date->save();
      //junbi out
      }else{
        if($content_calendar->$colum_end_nextday){
          $content_date->end = date('Y-m-d', strtotime('1 day ' . $day)) . ' ' . $content_calendar->$colum_end;
        }else{
          $content_date->end = $day . ' ' . $content_calendar->$colum_end;
        }
        $content_date->content_date_create_number = $content_date_create_number;
        $content_date->payment = $payment;
        $content_date->menu_ids = $menu_ids;
        $content_date->menus_summary = $menus_summary;
        $content_date->lunch_ids = $lunch_ids;
        $content_date->lunchs_summary = $lunchs_summary;
        $content_date->capacity_ids = $capacity_ids;
        $content_date->capacities_summary = $capacities_summary;
        $content_date->save();
      }
    }
    
  }else{

    if(!$content_calendar->$colum_off){
      $content_date = new Content_date;
      $content_date->content_id = $content_calendar->content_id;
      $content_date->status = 1;
      $content_date->start = $day . ' 00:00:00';
      $content_date->end = $day . ' 23:59:59';
      $content_date->content_date_create_number = $content_date_create_number;
      $content_date->payment = $payment;
      $content_date->menu_ids = $menu_ids;
      $content_date->menus_summary = $menus_summary;
      $content_date->lunch_ids = $lunch_ids;
      $content_date->lunchs_summary = $lunchs_summary;
      $content_date->capacity_ids = $capacity_ids;
      $content_date->capacities_summary = $capacities_summary;
      $content_date->save();
    }

  }

}









public function postResizeDate(Request $request, $id)
{
  
  if(!$content_date = Content_date::find((int)$request->get('content_date_id'))) return ['err'=>1, 'message'=>'予約受付状況がみつかりません。'];
  if(!$request->get('start') or !$request->get('end')) return ['err'=>1, 'message'=>'開始・終了を登録してください。'];

  $start = str_replace('T',' ',$request->get('start'));
  $end = str_replace('T',' ',$request->get('end'));
  if( !($content->service===62 or $content->service===69 or $content->service===101) ){
    $ans = Utilowner::checkStartEnd($start, $end, $id, $content_date);
    if($ans['err']) return $ans;
  }
  $content_date->start = $start;
  $content_date->end   = $end;

  $content_date->save();
  return 'ok';

}







public function getDateYoyakuExists(Request $request, $id)
{

  $content = Contents::select('service')->find($id);
  // axios
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date_users = Content_date_users::select('id')
      ->where('content_id',$id)
      ->whereIn('goin',[1,2])
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->first()
  ){
    return ['err'=>0, 'message'=>''];
  }

  $message = ($content->service===91) ? 'また、求人エントリーはございません。' : 'まだ、予約はございません。' ;

  return ['err'=>1, 'message'=>$message];

}




public function getDateYoyaku(Request $request, $id)
{

  $content = Contents::select('service','user_id')->find($id);

  // axios
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date_users = Content_date_users::where('content_id',$id)
      ->whereIn('goin',[1,2,9])
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(1000)->get()
  ){
    foreach($content_date_users as $key=>$content_date_user){
      $user = User::find($content_date_user->user_id);
      $owners_user = Owners_users::find($content_date_user->owners_user_id);
      $user_name = $owners_user->name;
      if(!$user_name) $user_name = $user->name;

      if($content_date_user->user_id === $content->user_id){
        $content_date_users[$key]['title'] = '[代理][未払]' . $user_name . '様';
        $content_date_users[$key]['color'] = '#EF5350';
      }elseif($content_date_user->goin===1){
        $content_date_users[$key]['title'] = '[未払]' . $user_name . '様';
        $content_date_users[$key]['color'] = '#EF5350';
      }elseif($content_date_user->goin===2){
        $content_date_users[$key]['title'] = '[支払済]' . $user_name . '様';
        $content_date_users[$key]['color'] = '#4CAF50';
      }elseif($content_date_user->goin===9){
        $content_date_users[$key]['title'] = '[キャンセル]' . $user_name . '様';
        $content_date_users[$key]['color'] = '#9E9E9E';
      }
      if($content_date_user->onOff===1){
        $content_date_users[$key]['title'] = '[受付済]' . $user_name . '様';
        $content_date_users[$key]['color'] = '#42A5F5';
      }
      $content_date_users[$key]['user'] = $user;
      $content_date_users[$key]['owners_user'] = $owners_user;

    }
    //logger($content_date_users);
    return $content_date_users;
  }

  return [];

}




public function getDateEdit(Request $request, $id)
{

  // axios
  $content = Contents::select('service')->find($id);
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date = Content_date::where('content_id',$id)
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(1000)->get()
  ){
    foreach($content_date as $key=>$val){
      if($val->status>=1 and $val->status<=3 ){
        if($content_date_user = Content_date_users::select('id')->where('goin',[1,2])->where('content_date_id',$val->id)->first()){
          $content_date[$key]['title'] .= '<予約有>';
        }
        if($content->service===62 or $content->service===69 or $content->service===101){
          $menu_ids = json_decode($val->menu_ids,true);
          $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_ids[0]);
          $content_date[$key]['title'] .= $menu->name;
        }
        $content_date[$key]['title'] .= Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
        if($val->percent and $val->percent<100){
          $content_date[$key]['title'] = $content_date[$key]['title'] . '[割引]';
          $content_date[$key]['color'] = '#FF5722';
        }
      }else{
        $content_date[$key]['title'] = Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
      }
    }
  }else{
    $content_date = new Content_date;
  }
  return $content_date;

}



public function getEdit(Request $request, $id)
{

  $content = Contents::find($id);
  if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit'){
    if(!$content_cancel_calendar = Content_cancel_calendar::select('id')->where('content_id',$id)->first()){
      $to = '/owner/contents/' . $id . '/cancel/edit';
      return redirect($to)->with('warning', '先に「キャンセル料」を登録してください。');
    }
  }else{
    if(!$content_menu = Content_menu_recruit::select('id')->where('content_id',$id)->first()){
      $to = '/owner/contents/' . $id . '/menu/edit';
      return redirect($to)->with('warning', '先に「面接内容」を登録してください。');
    }
  }

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first();

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if($tmp = Content_date::select('start')->where('content_id',$id)
    ->where('start', '>=', date('Y-m-d H:i:s'))
    ->where('start', '<=', $last_day)
    ->orderBy('start', 'desc')
    ->first()
  ){
    $content_date_last_start = date("Y-m-d", strtotime($tmp->start));
  }else{
    $content_date_last_start = date("Y-m-d");
  }

  //登録から3ヶ月間は予約受付のみとなります。
  //$owner_pay_status = null;
  //if($owner_pay = Owner_pay::where('user_id',$content->user_id)->first()){
  //  if($owner_pay->status===1){
  //    $owner_pay_status = true;
  //  }
  //}
  $owner_pay_status = true;
  return View('owner.contents.date.dateEdit', compact('content','company','company_calendar','content_date_last_start','last_day','owner_pay_status'));

}






public function getYoyaku(Request $request, $id)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if($tmp = Content_date::select('start')
    ->where('content_id',$id)
    ->where('start', '>=', date('Y-m-d H:i:s'))
    ->where('start', '<=', $last_day)
    ->orderBy('start', 'desc')
    ->first()
  ){
    $content_date_last_start = date("Y-m-d", strtotime($tmp->start));
  }else{
    $to='/owner/contents/' . $id . '/date/edit';
    return redirect($to)->with('warning', '先に「予約受付スケジュール」を登録してください。');
  }

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first();
  $content = Contents::find($id);
  
  return View('owner.contents.date.dateYoyaku', compact('content','company','company_calendar','content_date_last_start','last_day'));

}





public function getAdduser(Request $request, $id)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if($tmp = Content_date::select('start')
    ->where('content_id',$id)
    ->where('start', '>=', date('Y-m-d H:i:s'))
    ->where('start', '<=', $last_day)
    ->orderBy('start', 'desc')
    ->first()
  ){
    $content_date_last_start = date("Y-m-d", strtotime($tmp->start));
  }else{
    $to='/owner/contents/' . $id . '/date/edit';
    return redirect($to)->with('warning', '先に「予約受付スケジュール」を登録してください。');
  }

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first();
  $content = Contents::find($id);
  
  return View('owner.contents.date.dateAdduser', compact('content','company','company_calendar','content_date_last_start','last_day'));

}


public function getAdduserSearch(Request $request, $id)
{

  $searchTel = $request->get('searchTel');

  if(!$owners_users = Owners_users::where('tell', 'like', '%'.$searchTel.'%')
    ->where('owner_id', Utilowner::getOwnerId())
    ->take(100)
    ->get()
  ){
    $owners_users = [];
  }
  
  return $owners_users;

}



public function getOwnersUser(Request $request, $id)
{

  $user_id = (int)$request->get('user_id');

  if(!$owners_user = Owners_users::find($user_id)){
    return ['err'=>1,'message'=>'見つかりませんでした。'];
  }
  
  return $owners_user;

}







}