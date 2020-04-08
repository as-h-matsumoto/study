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

class AccountFoodController extends Controller {


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
  if($request->has('selectMenuFormprivate')) $content_date_user->private = 1;
  if($request->has('selectMenuFormsheet')) $content_date_user->sheet = 1;
  if($request->has('selectMenuFormallUse')) $content_date_user->allUse = 1;
  if(!(int)$request->get('selectMenuFormperson')) return ['err'=>1, 'message'=>'ご利用人数を入力してください。'];
  if( $content_date_user->allUse ){
    if((int)$request->get('selectMenuFormperson')<$content->allUseNumber) return ['err'=>1, 'message'=>'貸切は' . $content->allUseNumber . '名様以上です。'];
  }
  $content_date_user->join_user_number = (int)$request->get('selectMenuFormperson');
  if(!$request->get('selectMenuFormstart')) return ['err'=>1, 'message'=>'ご利用日時を入力してください。'];
  $content_date_user->start = $request->get('selectMenuFormstart');
  
  
  if( mb_strlen($request->get('selectMenuForminfo')) > 1000) return ['err'=>1, 'message'=> 'ご質問などは1000文字以内で入力ください。']; 
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



  //check use menus all use service
  $useMenus = Utilowner::checkAndGetUseMenus($request, $content, $content_date_user);
  if($useMenus['err']) return $useMenus;
  $content_date_user->menus_desc = json_encode(Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $useMenus['menu_ids'], null));
  $content_date_user->menu_ids = json_encode($useMenus['menu_ids']);
  $content_date_user->menus_summary = json_encode($useMenus['menus_summary']);
  $price_sum = $useMenus['price_sum'];
  $content_date_user->end = ($useMenus['content_date_user_end']) ? $useMenus['content_date_user_end'] : $content_date->end;
  

  //check use capa only service===1
  //--------------
  $useCapacities = $this->checkAndGetUseCapacities($content, $content_date, $content_date_user);
  if($useCapacities['err']) return $useCapacities;
  if($useCapacities['type']===2) $content_date_user->allUse = 1;
  $use_capa = array_count_values($useCapacities['use_capa']);
  $capacity_ids = [];
  foreach($use_capa as $key=>$val){
    $capacity_ids[] = $key;
  }
  $capacities_desc = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null);
  $content_date_user->capacities_desc = json_encode($capacities_desc);
  $content_date_user->capacity_ids = json_encode($capacity_ids);
  $capa_price_sum = 0;
  $capacities_summary = [];
  foreach($capacities_desc as $capa){
    $capa_price_sum = $capa_price_sum + $capa->price*$use_capa[$capa->id];
    $capacities_summary[$capa->id] = ['id'=>$capa->id, 'type'=>$capa->type, 'number'=>$use_capa[$capa->id], 'person'=>$capa->person, 'price'=>$capa->price];
  }
  $price_sum = $price_sum + $capa_price_sum;
  $content_date_user->capacities_summary  = json_encode($capacities_summary);
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

  //--^----------
  //check same capa only for service 1
  //--------------
  $result = $this->checkAndGetUseCapacities($content, $content_date, $content_date_user);
  if($result['err']){
    $content_date->status = $status;
    $content_date->save();
    return $result;
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
    return ['err'=>1, 'message'=>'同一の席が埋まってしまいました。'];
  }


  // check card all service use
  //$payment = $content_date->payment;
  //if($content->user_id === Utilowner::getOwnerId()) $payment = 2;

  //if($payment===1){
  //  return ['err'=>1, 'message'=>'エラーが起きました。ネット決済判定ミス'];
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
  //  $content_date_user->payjp_charge_id = $paing['payjp_charge_id'];
  //}


  //change status
  //$content_date_user->goin = ($payment===1) ? 2 : 1;
  $content_date_user->goin = 1;
  $content_date_user->yoyaku_id = 'coordiy_' . $content_date_user->id . '_' . uniqid();
  $content_date_user->save();


  if( $content_date_user->allUse ){
    //logger('貸切');
    $content_date->status = 10;
    $content_date->save();
  }else{
    UtilYoyaku::chengeStatus($content, $content_date);
  }

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


