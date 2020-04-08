<?php
namespace App\Libs;

use App\models\Contents;
use App\models\Content_tags;
use App\models\Content_date;
use App\models\Content_discount;

use App\models\Content_date_users;
use App\models\Content_menu_food;
use App\models\Content_menu_experience;
use App\models\Content_menu_lesson;
use App\models\Content_menu_spasalon;
use App\models\Content_menu_tour;
use App\models\Content_menu_ticket;
use App\models\Content_menu_hairsalon;
use App\models\Content_menu_stay;
use App\models\Content_menu_divination;

use App\models\company;
use App\models\Company_calendar;

use Auth;
use DateTime;
use Util;

use DB;
use Redirect;

class Utilowner
{






public static function getOwnerId(){
  if(Auth::user()->owner_super_id >=1){
    return Auth::user()->owner_super_id;
  }else{
    return Auth::user()->id;
  }
}



/* master */
/*
switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
  case 1:  $summary='menus_summary'; $dnop='number'; $unop=($cd_summary[$val['id']]['type']===1)?'number':'person'; break;
  case 2:  $summary='capacities_summary'; $dnop=($cd_summary[$val['id']]['type']<=4)?'number':'person'; $unop=$dnop; break;
  case 4:  $summary='menus_summary'; $dnop='number'; $unop='person'; break;
  case 5:  $summary='menus_summary'; $dnop='simultaneously'; $unop='person'; break;
  case 6:  $summary='menus_summary'; $dnop='number'; $unop='person'; break;
  case 7:  $summary='menus_summary'; $dnop='number'; $unop='number'; break;
  case 8:  $summary='menus_summary'; $dnop='simultaneously'; $unop='person'; break;
  case 9:  $summary='menus_summary'; $dnop='number'; $unop='person'; break;
  case 10: $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
  case 11: $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
}
*/







public static function checkAndGetUseCapacities($request, $content, $content_date_user)
{

  // check select capacity
  //logger($request->all());
  $capacities_summary = [];
  $capacity_ids = [];
  $join_user_all_data = [];

  if($content->service===81){
    $person = (int)$request->get('selectMenuFormperson');
    if($person > $content->room_person_max) return ['err'=>3, 'message'=> $content->room_person_max+1 . '名以上のお部屋はございませんでした。<br />' . $content->room_person_max . '名以下でご予約を分けてください。'];
    if($person > 20) return ['err'=>3, 'message'=> '一度のご予約は20名様までとなります。<br />' . '人数を分けてご予約ください。'];
    $nonesmoking = ($request->has('selectMenuFormnonesmoking')) ? 1 : 0;
  
    $oton = 0;
    $kids = 0;
    $yoji = 0;
    $baby = 0;
    
    for ($i = 1; $i <= $person; $i++){
      if(!$request->get('selectMenuFormPersonDescName'.$i)) return ['err'=>1, 'message'=> 'お名前を入力してください。'];
      $pname = $request->get('selectMenuFormPersonDescName'.$i);
      if( is_null($request->get('selectMenuFormPersonDescOld'.$i)) ) return ['err'=>1, 'message'=> '年齢を入力してください。'];
      $pold = (int)$request->get('selectMenuFormPersonDescOld'.$i);
      //logger('pold: ' . $pold);
      if( !($pold>=0 and $pold<=200) ) return ['err'=>1, 'message'=> '年齢が正しくありません。'];
      if ($pold<1){ $baby=1;
      }elseif($pold<6){ $yoji=1;
      }elseif($pold<10){ $kids=1;
      }else{ $oton=1; }
      $join_user_all_data[] = ['name'=>$pname, 'old'=>$pold];
    }
  }
  
  foreach($request->all() as $key=>$val){
    if(strpos($key,'capacityId') !== false){
      $val = (int)$val;
      $capacity_ids[] = $val;
      if($content->service===81){
        $number = 1;
      }else{
        $number = (int)$request->get('capacityNumber'.$val);
      }
      $capacities_summary[$val] = ['id'=>$val, 'number'=>$number, 'person'=>$content_date_user->join_user_number];
    }
  }
  //logger('capacity_ids:');
  //logger($capacity_ids);
  //logger('capacities_summary:');
  //logger($capacities_summary);

  if($content->service===39 or $content->service===85 or $content->service===89){
    if(!$capacities_summary){
      return ['err'=>1, 'message'=> 'メニューを最低ひとつ選んでください。'];
    }
  }

  //get end empty
  $content_date_user_end = null;


  ///////
  //get desc to menus or capacities;
  $content_date = Content_date::find($content_date_user->content_date_id);
  $selectMenus = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null);
  $use_time_desc = json_decode($content_date_user->use_time_desc, true); //2,10,11 only
  $discount = Utilowner::getDiscount($content, $content_date_user->use_time); //2,10,11 only
  $cd_summary = json_decode($content_date->capacities_summary,true);

  $ans_time = 0;
  $stayroom = 0;
  $stayroom_price = 0;
  $use_only_public = 0;
  $use_only_public_no = 0;

  //type8 is active2 only
  $type8 = 0;
  $type8Ather = false;
  foreach($selectMenus as $key=>$val){
    if(isset($cd_summary[$val->id])){
      $cd_summary[$val->id]['time']        = $val->time;
      $cd_summary[$val->id]['least_time']  = $val->least_time;
      $cd_summary[$val->id]['name']        = $val->name;
      $cd_summary[$val->id]['type']        = $val->type;
      $cd_summary[$val->id]['price_stay']  = $val->price_stay;
      
      //active2 only
      if($content->service===39){
        if($val->type===8){
          $type8++;
        }else{
          $type8Ather = true;
        }
      }

      //stay9 only
      if($content->service===81) $cd_summary[$val->id]['person'] = $val->person;
      if($content->service===81){
        if($val->type===1){
          $stayroom++;
          $stayroom_price = $val->price;
        }elseif($val->type===2){
          if($val->use_only_public===1){
            $use_only_public = 1;
          }else{
            $use_only_public_no = 1;
          }
        }
      }
    }
  }
  //logger('cd_summary:');
  //logger($cd_summary);

  //active2 only
  //logger('type8: ' . $type8);
  if($type8Ather){
    //logger('type8Ather true');
  }else{
    //logger('type8Ather false');
  }
  if($content->service===39){
    if($type8>=2) return ['err'=>1, 'message'=> 'すべて利用タイプのメニューはひとつだけ選択できます。'];
    if($type8>=1 and $type8Ather) return ['err'=>1, 'message'=> 'すべて利用タイプのメニューと他のメニューは一緒にご利用できません。'];
  }

  //stay9 only
  if($content->service===81){
    if($stayroom>=2) return ['err'=>1, 'message'=> '宿泊ルームをひとつだけ選択してください。'];
    if($stayroom===0 and $use_only_public===0){
      return ['err'=>1, 'message'=> '利用する宿泊ルーム、もしくは、施設を選択してください。'];
    }
  }

  ///////
  //check element type 開放
  if(
    $content->service===39 or  //active
    $content->service===85 or //studio
    $content->service===89    //kaigi
  ){
    $content_date_users_array = [];
    //logger('content_date_user->start: ' . $content_date_user->start);
    //logger('content_date_user->end: ' . $content_date_user->end);
    $DT_start = new DateTime($content_date_user->start);
    $DT_end = new DateTime($content_date_user->end);
    $DT_startPlus = new DateTime($content_date_user->start);
    $DT_endPlus = new DateTime($content_date_user->start);
    $DT_endPlus->modify('30 minute');
    while(true){
      //logger('startPlus:  ' . $DT_startPlus->format('Y-m-d H:i:s'));
      //logger('endPlus:  ' . $DT_endPlus->format('Y-m-d H:i:s'));
      if($DT_endPlus>$DT_end){
        break;
      }else{
        $content_date_users_array[] = Content_date_users::where('content_id',$content->id)
          ->whereIn('goin',[1,2])
          ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('start', '<=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->take(10000)
          ->get();
      }
      $DT_startPlus->modify('30 minute');
      $DT_endPlus->modify('30 minute');
    }
  }else{ //stay9
    // content_date単位で確認
    $content_date_users = Content_date_users::where('content_date_id', $content_date_user->content_date_id)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get();
  }
  //logger($content_date_users_array);


  
  $price_sum = 0;
  foreach($capacities_summary as $key=>$val){

    $capacities_summary[$key]['type'] = $cd_summary[$val['id']]['type'];
    
    //最低利用者数 menu and stay9
    //person_select この人数のお部屋であることを確認するだけ。残数チェックは跡でやるはず。
    if(
      $content->service===81 and $cd_summary[$val['id']]['type']===1
    ){
      $minitusTmp = 9999999;
      $errMessage = 'そのご利用者数ではその宿泊ルームをご利用できません。';
      //logger('$cd_summary[$val[id]][person]: ' . $cd_summary[$val['id']]['person']);
      //logger('val[person]: ' . $val['person']);
      //logger('$val[id]: ' . $val['id']);
      switch($val['person']){
        case 1:  if( !($cd_summary[$val['id']]['person'] === 1 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 2:  if( !($cd_summary[$val['id']]['person'] === 2 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 3:  if( !($cd_summary[$val['id']]['person'] === 4 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 4:  if( !($cd_summary[$val['id']]['person'] === 4 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 5:  if( !($cd_summary[$val['id']]['person'] === 6 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 6:  if( !($cd_summary[$val['id']]['person'] === 6 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 7:  if( !($cd_summary[$val['id']]['person'] === 8 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 8:  if( !($cd_summary[$val['id']]['person'] === 8 ) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 9:  if( !($cd_summary[$val['id']]['person'] === 10) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 10: if( !($cd_summary[$val['id']]['person'] === 10) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 11: if( !($cd_summary[$val['id']]['person'] === 12) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 12: if( !($cd_summary[$val['id']]['person'] === 12) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 13: if( !($cd_summary[$val['id']]['person'] === 14) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 14: if( !($cd_summary[$val['id']]['person'] === 14) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 15: if( !($cd_summary[$val['id']]['person'] === 16) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 16: if( !($cd_summary[$val['id']]['person'] === 16) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 17: if( !($cd_summary[$val['id']]['person'] === 18) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 18: if( !($cd_summary[$val['id']]['person'] === 18) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 19: if( !($cd_summary[$val['id']]['person'] === 20) ) return ['err'=>1, 'message'=>$errMessage]; break;
        case 20: if( !($cd_summary[$val['id']]['person'] === 20) ) return ['err'=>1, 'message'=>$errMessage]; break;
      }
    }


    //最低利用時間 least_time
    if($content->service===39 or $content->service===85 or $content->service===89){
      if($cd_summary[$val['id']]['least_time']>=1){
        $least_time = $cd_summary[$val['id']]['least_time']*60;
        //logger('content_date_user->use_time: ' . $content_date_user->use_time);
        $use_time = ($content_date_user->use_time<=3) ? $content_date_user->use_time*24*60 : $content_date_user->use_time;
        if($use_time < $least_time){
          //logger('in least_time');
          $ans['err'] = 1;
          $ans['message'] = $cd_summary[$val['id']]['name'] . 'は' . $least_time . '分からご利用いただけます。';
          return $ans;
        }
      }
    }

    //
    //price 確定
    //
    if( $content->service===81 and $cd_summary[$val['id']]['type']===2 and $stayroom>=1 ){
      if($content_date_user->percent){
        $place = $cd_summary[$val['id']]['price_stay'] * ($content_date_user->percent/100);
      }else{
        $place = $cd_summary[$val['id']]['price_stay'];
      }
      $capacities_summary[$key]['price'] = (int)$place;
    }else{
      if($content_date_user->percent){
        $place = $cd_summary[$val['id']]['price'] * ($content_date_user->percent/100);
      }else{
        $place = $cd_summary[$val['id']]['price'];
      }
      $capacities_summary[$key]['price'] = (int)$place;
    }

    
    
    
    
    //
    //check sum of number or person
    //
    switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
      case 'active':  $summary='capacities_summary'; $dnop=($cd_summary[$val['id']]['type']<=4)?'number':'person'; $unop=$dnop; break;
      case 'stay':  $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
      case 'studio': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
      case 'kaigi': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
    }
    //use number
    if($unop==='number'){
      if(!$val['number']) return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'の数を入力ください。'];
      if($val['number']>1000) return ['err'=>1, 'message'=>'1000以上注文できません。'];
    }
    //price_sum
    if($content->service===39 and $cd_summary[$val['id']]['type']===8){
      if($discount>=1){
        $price_sum += $place * $val[$unop] * ($discount/100);
      }else{
        $price_sum += $place * $val[$unop];
      }
    }elseif($content->service===39 or $content->service===85 or $content->service===89){
      $price_minitsu = $place / $cd_summary[$val['id']]['time'];
      $price_use = $price_minitsu * $val[$unop] * $use_time_desc['total_use_time'];
      if($discount>=1){
        $price_sum += floor($price_use * ($discount/100));
      }else{
        $price_sum += floor($price_use);
      }
    }else{
      $price_sum += $place * $val[$unop];
    }
    

    //上限以上の申込チェック
    if( ($content->service===39 and $cd_summary[$val['id']]['type']!==8) or $content->service===85 or $content->service===89){
      if($val[$unop] > $cd_summary[$val['id']][$dnop]) return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は[' . $cd_summary[$val['id']][$dnop] . ']が上限です。'];
    }
    //利用数を確認し、空きがあるか確認。

    //Check利用数Over
    //experience3, stay9はメニューでは残数制限なし。
    $total_use = 0;
    if( //開放タイプ active2, studio10, kaigi11
      ($content->service===39 and $cd_summary[$val['id']]['type']!==8) or 
      $content->service===85 or
      $content->service===89
    ){
      foreach($content_date_users_array as $active_users){
        $total_use = 0;
        foreach($active_users as $active_user){
          $active_user_summary = json_decode($active_user->$summary, true);
          foreach($active_user_summary as $use_capacity){
            if($use_capacity['id'] === $val['id']){
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'active':  $summary='capacities_summary'; $dnop=($use_capacity['type']<=4)?'number':'person'; $unop=$dnop; break;
                case 'studio': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
                case 'kaigi': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
              }
              $total_use += $use_capacity[$unop];
            }
          }
        }

        switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
          case 'active':  $summary='capacities_summary'; $dnop=($cd_summary[$val['id']]['type']<=4)?'number':'person'; $unop=$dnop; break;
          case 'studio': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
          case 'kaigi': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
        }
        $total_use_plus = $total_use + $val[$unop];
        //logger('id:' . $val['id'] . ' - name: ' . $cd_summary[$val['id']]['name']);
        //logger('total_use: ' . $total_use);
        //logger('total_use_plus: ' . $total_use_plus);
        //logger('total_aki: ' . $cd_summary[$val['id']][$dnop]);
        if($total_use_plus > $cd_summary[$val['id']][$dnop]){
          return Utilowner::findNoUseTime($content, $content_date_user, $capacities_summary, $cd_summary, $unop, $dnop, $val);
          //$zan = $cd_summary[$val['id']][$dnop] - $total_use;
          //return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は[残り:' . $zan . ']です。'];
        }
      }
    }elseif( //stay9  消耗タイプ
      $content->service===81
    ){
      $total_use = 0;
      foreach($content_date_users as $active_user){
        //get total_use
        $active_user_summary = json_decode($active_user->capacities_summary, true);
        foreach($active_user_summary as $use_capacity){
          if($use_capacity['id'] === $val['id']){
            $total_use++;
          }
        }
      }
      $total_use_plus = $total_use + 1;
      //logger('id:' . $val['id'] . ' - name: ' . $cd_summary[$val['id']]['name']);
      //logger('total_use: ' . $total_use);
      //logger('total_use_plus: ' . $total_use_plus);
      //logger('total_aki: ' . $cd_summary[$val['id']]['number']);
      if($total_use_plus > $cd_summary[$val['id']]['number']){
        $zan = $cd_summary[$val['id']]['number'] - $total_use;
        return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は残り:' . $zan . 'です。'];
      }
    }

  }

  return ['err'=>0, 'capacity_ids'=>$capacity_ids, 'capacities_summary'=>$capacities_summary, 'price_sum'=>$price_sum, 'content_date_user_end'=>$content_date_user_end, 'join_user_all_data'=>$join_user_all_data, 'type8'=>$type8];

}







public static function checkUsedCapacities($content, $content_date_user)
{
  
  ///////
  //check element type 開放されるか、消耗されるか
  if( //active2, spasalon5, hairsalon8, studio10, kaigi11
    $content->service===39 or
    $content->service===85 or
    $content->service===89
  ){ // 開放タイプ 2,5,8,10,11
    $content_date_users_array = [];
    $DT_start = new DateTime($content_date_user->start);
    $DT_end = new DateTime($content_date_user->end);
    $DT_startPlus = new DateTime($content_date_user->start);
    $DT_endPlus = new DateTime($content_date_user->start);
    $DT_endPlus->modify('30 minute');
    while(true){
      //logger('startPlus:  ' . $DT_startPlus->format('Y-m-d H:i:s'));
      //logger('endPlus:  ' . $DT_endPlus->format('Y-m-d H:i:s'));
      if($DT_endPlus>$DT_end){
        break;
      }else{
        $content_date_users_array[] = Content_date_users::where('content_id',$content->id)
          ->whereIn('goin',[1,2])
          ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('start', '<=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->take(10000)
          ->get();
      }
      $DT_startPlus->modify('30 minute');
      $DT_endPlus->modify('30 minute');
    }
  }else{
    $content_date_users = Content_date_users::where('content_date_id', $content_date_user->content_date_id)
    ->whereIn('goin', [1,2])
    ->take(100000)
    ->get();
  }

  ///////
  //check menus or capacities
  //logger('$content_date_user->content_date_id: ' . $content_date_user->content_date_id);
  $content_date = Content_date::find($content_date_user->content_date_id);
  //logger('content_date');
  //logger($content_date);
  $selectMenus = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, json_decode($content_date_user->capacity_ids,true), null);
  $use_time_desc = json_decode($content_date_user->use_time_desc, true);
  $discount = Utilowner::getDiscount($content, $content_date_user->use_time);
  $cd_summary = json_decode($content_date->capacities_summary,true);
  foreach($selectMenus as $key=>$val){
    if(isset($cd_summary[$val->id])){
      $cd_summary[$val->id]['time']           = $val->time;
      $cd_summary[$val->id]['least_time']     = $val->least_time;
      $cd_summary[$val->id]['name']           = $val->name;
      $cd_summary[$val->id]['type']           = $val->type;
    }
  }
  
  
  
  
  /* master */
  switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
    case 'active':  $summary='capacities_summary'; $dnop=($cd_summary[$val['id']]['type']<=4)?'number':'person'; $unop=$dnop; break;
    case 'stay':  $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
    case 'studio': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
    case 'kaigi': $summary='capacities_summary'; $dnop='number'; $unop='number'; break;
  }

  foreach(json_decode($content_date_user->capacities_summary, true) as $key=>$val){

    //Check利用数Over
    $total_use = 0;
    if( //開放タイプ active2, studio10, kaigi11
      ($content->service===39 and $cd_summary[$val['id']]['type']!==8) or 
      $content->service===85 or
      $content->service===89
    ){
      foreach($content_date_users_array as $active_users){
        $total_use = 0;
        foreach($active_users as $active_user){
          $active_user_summary = json_decode($active_user->capacities_summary, true);
          foreach($active_user_summary as $use_capacity){
            if($use_capacity['id'] === $val['id']){
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'active':  $dnop=($use_capacity['type']<=4)?'number':'person'; $unop=$dnop; break;
                case 'studio': $dnop='number'; $unop='number'; break;
                case 'kaigi': $dnop='number'; $unop='number'; break;
              }
              $total_use += $use_capacity[$unop];
            }
          }
        }



        switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
          case 'active':  $dnop=($cd_summary[$val['id']]['type']<=4)?'number':'person'; $unop=$dnop; break;
          case 'studio': $dnop='number'; $unop='number'; break;
          case 'kaigi': $dnop='number'; $unop='number'; break;
        }
        $total_use_plus = $total_use + $val[$unop];
        if($total_use_plus > $cd_summary[$val['id']][$dnop]){
          $zan = $cd_summary[$val['id']][$dnop] - $total_use;
          return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は[残り:' . $zan . ']になってしまいました。'];
        }
      }
    }elseif( //stay9  消耗タイプ
      $content->service===81
    ){
      $total_use = 0;
      foreach($content_date_users as $active_user){
        //get total_use
        $active_user_summary = json_decode($active_user->capacities_summary, true);
        foreach($active_user_summary as $use_capacity){
          if($use_capacity['id'] === $val['id']){
            $total_use++;
          }
        }
      }
      $total_use_plus = $total_use + 1;
      if($total_use_plus > $cd_summary[$val['id']]['number']){
        $zan = $cd_summary[$val['id']]['number'] - $total_use;
        return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は残り:' . $zan . 'になってしまいました。'];
      }
    }

  }

  return ['err'=>0, 'message'=>''];

}















public static function checkAndGetUseMenus($request, $content, $content_date_user)
{

  // check select menu
  $menus_summary = [];
  $menu_ids = [];
  if($content->service===62 or $content->service===69 or $content->service===101){
    if($content->service===101){
      if(!$request->get('selectMenuFormnumber')) ['err'=>1, 'message'=>'枚数を入力してください。'];
    } 
    $number = ($request->get('selectMenuFormnumber')) ? (int)$request->get('selectMenuFormnumber') : 1;
    $content_date_tmp = Content_date::find($content_date_user->content_date_id);
    $content_date_tmp_menu_ids = json_decode($content_date_tmp->menu_ids, true);
    $menu_id = $content_date_tmp_menu_ids[0];
    $menu_ids[] = $menu_id;
    $menus_summary[$menu_id] = ['id'=>$menu_id, 'number'=>$number, 'person'=>$content_date_user->join_user_number];
  }else{
    foreach($request->all() as $key=>$val){
      if(strpos($key,'menuId') !== false){
        $val = (int)$val;
        $menu_ids[] = $val;
        if($content->service===81){
          $number = 1;
        }else{
          $number = (int)$request->get('menuNumber'.$val);
        }
        $menus_summary[$val] = ['id'=>$val, 'number'=>$number, 'person'=>$content_date_user->join_user_number];
      }
    }
  }
  //logger('menus_summary:');
  //logger($menus_summary);

  if( 
    $content->service===15 or
    $content->service===62 or
    $content->service===65 or
    $content->service===77 or
    $content->service===69 or
    $content->service===101 or
    $content->service===81 or
    $content->service===90)
  {
    if(!$menus_summary)
    {
      return ['err'=>1, 'message'=> 'メニューを最低ひとつ選んでください。'];
    }
  }

  //get end empty
  $content_date_user_end = null;

  ///////
  //get desc to menus or capacities;
  $content_date = Content_date::find($content_date_user->content_date_id);
  $selectMenus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $menu_ids, null);
  $cd_summary = json_decode($content_date->menus_summary,true);
  if($content->service===15){
    $lunch = json_decode($content_date->lunchs_summary,true);
    if($lunch){
      $DT_start = new DateTime($content_date_user->start);
      $lunchStart = new DateTime($DT_start->format('Y-m-d') . ' 10:00:00');
      $lunchEnd = new DateTime($DT_start->format('Y-m-d') . ' 15:00:00');
      if($DT_start >= $lunchStart and $DT_start < $lunchEnd){
        $cd_summary = $lunch;
      }
    }
  }
  
  $morning = 0;
  $lunch = 0;
  $diner = 0;
  $ans_time = 0;
  foreach($selectMenus as $key=>$val){
    if(isset($cd_summary[$val->id])){
      //get end  service 5,8 only
      if($content->service===65 or $content->service===77 or $content->service===90){
        $ans_time += $val->time;
      }
      $cd_summary[$val->id]['time']           = $val->time;
      $cd_summary[$val->id]['least_time']     = $val->least_time;
      $cd_summary[$val->id]['name']           = $val->name;
      $cd_summary[$val->id]['type']           = $val->type;
      $cd_summary[$val->id]['simultaneously'] = $val->simultaneously;
      if($val->type===1) $diner++;
      if($val->type===2) $lunch++;
      if($val->type===3) $morning++;
    }
  }
  // stay9 only
  if($content->service===81){
    //logger('diner: ' . $diner);
    //logger('lunch: ' . $lunch);
    //logger('morning: ' . $morning);
    if($diner>=2)   return ['err'=>1, 'message'=>'ディナーメニューをひとつだけ選択してください。'];
    if($lunch>=2)   return ['err'=>1, 'message'=>'ランチメニューをひとつだけ選択してください。'];
    if($morning>=2) return ['err'=>1, 'message'=>'朝食メニューをひとつだけ選択してください。'];
  }

  // service 5,8 only
  if($content->service===65 or $content->service===77 or $content->service===90){
    $DT_end = new DateTime($content_date_user->start);
    $DT_end->modify( '+' . $ans_time . ' minute');
    $content_date_user_end = $DT_end->format('Y-m-d H:i:s');
    $content_date_user->end = $DT_end->format('Y-m-d H:i:s');
  }
  //logger('cd_summary:');
  //logger($cd_summary);



  ///////
  //check element type 開放
  if(
    $content->service===65 or  //spasalon
    $content->service===77 or //hairsalon
    $content->service===90 //divination
  ){
    $content_date_users_array = [];
    //logger('content_date_user->start: ' . $content_date_user->start);
    //logger('content_date_user->end: ' . $content_date_user->end);
    $DT_start = new DateTime($content_date_user->start);
    $DT_end = new DateTime($content_date_user->end);
    $DT_startPlus = new DateTime($content_date_user->start);
    $DT_endPlus = new DateTime($content_date_user->start);
    $DT_endPlus->modify('30 minute');
    while(true){
      //logger('startPlus:  ' . $DT_startPlus->format('Y-m-d H:i:s'));
      //logger('endPlus:  ' . $DT_endPlus->format('Y-m-d H:i:s'));
      if($DT_endPlus>$DT_end){
        break;
      }else{
        $content_date_users_array[] = Content_date_users::where('content_id',$content->id)
          ->whereIn('goin',[1,2])
          ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('start', '<=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->take(10000)
          ->get();
      }
      $DT_startPlus->modify('30 minute');
      $DT_endPlus->modify('30 minute');
    }
  }else{
    // content_date単位で確認
    $content_date_users = Content_date_users::where('content_date_id', $content_date_user->content_date_id)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get();
  }
  //logger($content_date_users_array);


  
  $price_sum = 0;
  foreach($menus_summary as $key=>$val){

    $menus_summary[$key]['type'] = $cd_summary[$val['id']]['type'];
    
    //最低利用者数 menu and service 1,4,6,9
    if(
      $content->service===15 or //foot
      $content->service===62 or //lesson
      $content->service===69    //tour
    ){
      $minitusTmp = 9999999;
      if($cd_summary[$val['id']]['person'] >= 2){
        if($content_date_user->join_user_number < $cd_summary[$val['id']]['person'] ){
          //logger('in person');
          $ans['err'] = 1;
          $ans['message'] = $cd_summary[$val['id']]['name']  . 'は<br />' . $cd_summary[$val['id']]['person']  . '名様からご利用いただけます。';
          return $ans;
        }
      }
    }

    //利用時間特定 menu and food only
    if(
      $content->service===15 //food
    ){
      if($cd_summary[$val['id']]['time']){
        //logger('in time');
        $minitusDiff = $cd_summary[$val['id']]['time'];
        if($minitusTmp > $minitusDiff){
          $minitusTmp = $minitusDiff;
          $DT_time = new DateTime($content_date_user->start);
          $DT_time->modify('+'.$minitusTmp.' minute');
          $content_date_user_end = $DT_time->format('Y-m-d H:i:s');
        }
      }
    }

    //最低利用時間 least_time
    if($content->service===39 or $content->service===85 or $content->service===89){
      if($cd_summary[$val['id']]['least_time']>=1){
        $least_time = $cd_summary[$val['id']]['least_time']*60;
        //logger('content_date_user->use_time: ' . $content_date_user->use_time);
        $use_time = ($content_date_user->use_time<=3) ? $content_date_user->use_time*24*60 : $content_date_user->use_time;
        if($use_time < $least_time){
          //logger('in least_time');
          $ans['err'] = 1;
          $ans['message'] = $cd_summary[$val['id']]['name'] . 'は' . $least_time . '分からご利用いただけます。';
          return $ans;
        }
      }
    }

    //
    //price 確定
    //
    if($content_date_user->percent){
      $place = $cd_summary[$val['id']]['price'] * ($content_date_user->percent/100);
    }else{
      $place = $cd_summary[$val['id']]['price'];
    }
    $menus_summary[$key]['price'] = (int)$place;

    //
    //check sum of number or person
    //
    switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
      case 'food':  $dnop='number'; $unop=($cd_summary[$val['id']]['type']===1)?'number':'person'; break;
      case 'lesson':  $dnop='number'; $unop='person'; break;
      case 'spasalon':  $dnop='simultaneously'; $unop='person'; break;
      case 'tour':  $dnop='number'; $unop='person'; break;
      case 'ticket':  $dnop='number'; $unop='number'; break;
      case 'hairsalon':  $dnop='simultaneously'; $unop='person'; break;
      case 'stay':  $dnop='number'; $unop='person'; break;
      case 'divination':  $dnop='simultaneously'; $unop='person'; break;
    }
    
    
    
    
    
    
    
    
    //use number
    if($unop==='number'){
      if(!$val['number']) return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'の数を入力ください。'];
      if($val['number']>1000) return ['err'=>1, 'message'=>'1000以上注文できません。'];
    }
    //price_sum
    //logger('place: ' . $place);
    //logger('val[$unop]: ' . $val[$unop]);
    $price_sum += $place * $val[$unop];

    //上限以上の申込チェック
    if(!$content->service===81){
      if($val[$unop] > $cd_summary[$val['id']][$dnop]) return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は[' . $cd_summary[$val['id']][$dnop] . ']が上限です。'];
    }

    //Check利用数Over
    //experience3残数制限なし。
    $total_use = 0;
    if( //開放タイプ active2, spasalon5, hairsalon8, studio10, kaigi11
      $content->service===65 or        
      $content->service===77 or
      $content->service===90
    ){
      //logger('content->service: ' . $content->service);
      if($content->service===65){
        $count = ceil($ans_time/30);
      }
      foreach($content_date_users_array as $active_users){
        if($content->service===65){
          if($count<=0) break;
          $count--;
          //logger('count: ' . $count);
        }
        $total_use = 0;
        foreach($active_users as $active_user){
          $active_user_summary = json_decode($active_user->menus_summary, true);
          foreach($active_user_summary as $use_menu){
            if($use_menu['id'] === $val['id']){
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'spasalon': $dnop='simultaneously'; $unop='person'; break;
                case 'hairsalon': $dnop='simultaneously'; $unop='person'; break;
                case 'divination': $dnop='simultaneously'; $unop='person'; break;
              }
              $total_use += $use_menu[$unop];
            }
          }
        }

        switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
          case 'spasalon': $dnop='simultaneously'; $unop='person'; break;
          case 'hairsalon': $dnop='simultaneously'; $unop='person'; break;
          case 'divination': $dnop='simultaneously'; $unop='person'; break;
        }
        $total_use_plus = $total_use + $val[$unop];
        //logger('id:' . $val['id'] . ' - name: ' . $cd_summary[$val['id']]['name']);
        //logger('total_use: ' . $total_use);
        //logger('total_use_plus: ' . $total_use_plus);
        //logger('total_aki: ' . $cd_summary[$val['id']][$dnop]);
        if($total_use_plus > $cd_summary[$val['id']][$dnop]){
          return Utilowner::findNoUseTime($content, $content_date_user, $menus_summary, $cd_summary, $unop, $dnop, $val);
          //$zan = $cd_summary[$val['id']][$dnop] - $total_use;
          //return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は[残り:' . $zan . ']です。'];
        }
      }
    }elseif( //消耗タイプ food1, lesson4, tour6, ticket7, stay9
      $content->service===15 or
      $content->service===62 or
      $content->service===69 or
      $content->service===101 or
      $content->service===81
    ){
      $total_use = 0;
      foreach($content_date_users as $active_user){
        //get total_use
        $active_user_summary = json_decode($active_user->menus_summary, true);
        foreach($active_user_summary as $use_menu){
          if($use_menu['id'] === $val['id']){
            switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
              case 'food': $dnop='number'; $unop=($use_menu['type']===1)?'number':'person'; break;
              case 'lesson': $dnop='number'; $unop='person'; break;
              case 'tour': $dnop='number'; $unop='person'; break;
              case 'ticket': $dnop='number'; $unop='number'; break;
              case 'stay': $dnop='number'; $unop='person'; break;
            }
            $total_use += $use_menu[$unop];
          }
        }
      }
      
      
      switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
        case 'food': $dnop='number'; $unop=($cd_summary[$val['id']]['type']===1)?'number':'person'; break;
        case 'lesson': $dnop='number'; $unop='person'; break;
        case 'tour': $dnop='number'; $unop='person'; break;
        case 'ticket': $dnop='number'; $unop='number'; break;
        case 'stay': $dnop='number'; $unop='person'; break;
      }
      $total_use_plus = $total_use + $val[$unop];
      //logger('id:' . $val['id'] . ' - name: ' . $cd_summary[$val['id']]['name']);
      //logger('total_use: ' . $total_use);
      //logger('total_use_plus: ' . $total_use_plus);
      //logger('total_aki: ' . $cd_summary[$val['id']][$dnop]);
      if($total_use_plus > $cd_summary[$val['id']][$dnop]){
        $zan = $cd_summary[$val['id']][$dnop] - $total_use;
        return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は残り:' . $zan . 'です。'];
      }
    }
    // ------------------------

  }

  //logger('price_sum: ' . $price_sum);

  return ['err'=>0, 'menu_ids'=>$menu_ids, 'menus_summary'=>$menus_summary, 'price_sum'=>$price_sum, 'content_date_user_end'=>$content_date_user_end];

}









public static function checkUsedMenus($content, $content_date_user)
{

  ///////
  //check element type 開放されるか、消耗されるか
  if( //開放タイプ , spasalon5, hairsalon8
    $content->service===65 or        
    $content->service===77 or
    $content->service===90
  ){
    $content_date_users_array = [];
    $DT_start = new DateTime($content_date_user->start);
    $DT_end = new DateTime($content_date_user->end);
    $DT_startPlus = new DateTime($content_date_user->start);
    $DT_endPlus = new DateTime($content_date_user->start);
    $DT_endPlus->modify('30 minute');
    while(true){
      //logger('startPlus:  ' . $DT_startPlus->format('Y-m-d H:i:s'));
      //logger('endPlus:  ' . $DT_endPlus->format('Y-m-d H:i:s'));
      if($DT_endPlus>$DT_end){
        break;
      }else{
        $content_date_users_array[] = Content_date_users::where('content_id',$content->id)
          ->whereIn('goin',[1,2])
          ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('start', '<=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
          ->where('end', '>=', $DT_endPlus->format('Y-m-d H:i:s'))
          ->take(10000)
          ->get();
      }
      $DT_startPlus->modify('30 minute');
      $DT_endPlus->modify('30 minute');
    }
  }else{
    $content_date_users = Content_date_users::where('content_date_id', $content_date_user->content_date_id)
    ->whereIn('goin', [1,2])
    ->take(100000)
    ->get();
  }

  ///////
  //check menus or capacities
  $content_date = Content_date::find($content_date_user->content_date_id);
  $selectMenus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, json_decode($content_date_user->menu_ids,true), null);
  $cd_summary = json_decode($content_date->menus_summary,true);
  if($content->service===15){
    $lunch = json_decode($content_date->lunchs_summary,true);
    if($lunch){
      $DT_start = new DateTime($content_date_user->start);
      $lunchStart = new DateTime($DT_start->format('Y-m-d') . ' 10:00:00');
      $lunchEnd = new DateTime($DT_start->format('Y-m-d') . ' 15:00:00');
      if($DT_start >= $lunchStart and $DT_start < $lunchEnd){
        $cd_summary = $lunch;
      }
    }
  }
  foreach($selectMenus as $key=>$val){
    if(isset($cd_summary[$val->id])){
      $cd_summary[$val->id]['time']           = $val->time;
      $cd_summary[$val->id]['least_time']     = $val->least_time;
      $cd_summary[$val->id]['name']           = $val->name;
      $cd_summary[$val->id]['type']           = $val->type;
      $cd_summary[$val->id]['simultaneously'] = $val->simultaneously;
    }
  }

  foreach(json_decode($content_date_user->menus_summary, true) as $key=>$val){

    $total_use = 0;
    if( //開放タイプ active2, spasalon5, hairsalon8, studio10, kaigi11
      $content->service===65 or        
      $content->service===77 or
      $content->service===90
    ){
      if($content->service===65){
        $count = ceil($cd_summary[$val['id']]['simultaneously']/30);
      }
      foreach($content_date_users_array as $active_users){
        if($content->service===65){
          if($count<=0) break;
          $count--;
        }
        $total_use = 0;
        foreach($active_users as $active_user){
          $active_user_summary = json_decode($active_user->menus_summary, true);
          foreach($active_user_summary as $use_menu){
            if($use_menu['id'] === $val['id']){
              switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
                case 'spasalon': $dnop='simultaneously'; $unop='person'; break;
                case 'hairsalon': $dnop='simultaneously'; $unop='person'; break;
                case 'divination': $dnop='simultaneously'; $unop='person'; break;
              }
              $total_use += $use_menu[$unop];
            }
          }
        }



        switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
          case 'spasalon': $dnop='simultaneously'; $unop='person'; break;
          case 'hairsalon': $dnop='simultaneously'; $unop='person'; break;
          case 'divination': $dnop='simultaneously'; $unop='person'; break;
        }
        $total_use_plus = $total_use + $val[$unop];
        if($total_use_plus > $cd_summary[$val['id']][$dnop]){
          return ['err'=>3, 'message'=>$cd_summary[$val['id']]['name'] . 'は、<br />埋まってしまいました。'];
        }
      }
    }elseif( //消耗タイプ food1, lesson4, tour6, ticket7
      $content->service===15 or
      $content->service===62 or
      $content->service===69 or
      $content->service===101 or
      $content->service===81
    ){
      $total_use = 0;
      foreach($content_date_users as $active_user){
        //get total_use
        $active_user_summary = json_decode($active_user->menus_summary, true);
        foreach($active_user_summary as $use_menu){
          if($use_menu['id'] === $val['id']){
            switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
              case 'food': $dnop='number'; $unop=($use_menu['type']===1)?'number':'person'; break;
              case 'lesson': $dnop='number'; $unop='person'; break;
              case 'tour': $dnop='number'; $unop='person'; break;
              case 'ticket': $dnop='number'; $unop='number'; break;
              case 'stay': $dnop='number'; $unop='person'; break;
            }
            $total_use += $use_menu[$unop];
          }
        }
      }


      switch(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
        case 'food': $dnop='number'; $unop=($cd_summary[$val['id']]['type']===1)?'number':'person'; break;
        case 'lesson': $dnop='number'; $unop='person'; break;
        case 'tour': $dnop='number'; $unop='person'; break;
        case 'ticket': $dnop='number'; $unop='number'; break;
        case 'stay': $dnop='number'; $unop='person'; break;
      }
      $total_use_plus = $total_use + $val[$unop];
      if($total_use_plus > $cd_summary[$val['id']][$dnop]){
        $zan = $cd_summary[$val['id']][$dnop] - $total_use;
        return ['err'=>3, 'message'=>$cd_summary[$val['id']]['name'] . 'は、<br />残り:' . $zan . 'になってしまいました。'];
      }
    }

  }

  return ['err'=>0, 'message'=>''];

}


// 上限エラーのため空きを探す
public static function findNoUseTime($content, $content_date_user, $menus_summary, $cd_summary, $unop, $dnop, $val)
{

  // リクエスト日によって最適な空き日を検索するため、リクエスト日を確認
  // 確認期間はリクエスト日前後一週間とする。
  // リクエスト日が本日であれば、本日から一週間
  // リクエスト日が3日後であれば、3日後の3日前から3日後から一週間
  // また、リクエスト日から近い日順に検索し、3候補見つかればリターン。
  // 3候補以下であれば、見つかった分をリターン。検索期間を探したが見つからない旨をリターン。

  // メッセージ枠作成
  $message = 'その時間では空きがありませんでした。<br />';
  $message .= $cd_summary[$val['id']]['name'] . ' ';
  $message .= $val[$unop];
  if($content->service===39){
    $message .= Util::getServiceTypeGobi($content->service, $cd_summary[$val['id']]['type'], 'capacity');
  }elseif($content->service===85 or $content->service===89){
    $message .= '室';
  }elseif($content->service===65 or $content->service===77 or $content->service===90){
    $message .= '名';
  }

  // 利用時間確認
  $request_time = 0;
  if($content->service===39 or $content->service===85 or $content->service===89){
    $request_time = $content_date_user->use_time;
    if($request_time===3){
      $message .= ' 3日間であれば、<br />';
    }elseif($request_time===2){
      $message .= ' 2日間であれば、<br />';
    }else{
      $message .= ' ' . $request_time . '分であれば、<br />';
    }
  }
  //logger('request_time: ' . $request_time);

  //前後一週間取得
  $request_day_value = Utilowner::getRequestDayValue();

  $request_day = new DateTime($content_date_user->start);
  $request_day_plus = new DateTime($content_date_user->start);
  $now_day = new DateTime();
  for($i = 0; $i <= 20; $i++){
    $no_find_user = true;
    //logger('request_day_value: ' . $request_day_value[$i]);
    if($request_day_value[$i]){
      $request_day_plus = clone $request_day;
      $request_day_plus->modify($request_day_value[$i] . ' day');
    }
    //logger('request_day_plus: ' . $request_day_plus->format('Y-m-d H:i:s'));
    if($request_time===3){
      $search_day_start = new DateTime(date('Y-m-d 00:00:00', strtotime( '-1 day ' . $request_day_plus->format('Y-m-d H:i:s'))));
      $search_day_end   = new DateTime(date('Y-m-d 23:59:59', strtotime( '+1 day ' . $request_day_plus->format('Y-m-d H:i:s'))));
    }elseif($request_time===2){
      $search_day_start = new DateTime(date('Y-m-d 00:00:00', strtotime( $request_day_plus->format('Y-m-d H:i:s'))));
      $search_day_end   = new DateTime(date('Y-m-d 23:59:59', strtotime( '+1 day ' . $request_day_plus->format('Y-m-d H:i:s'))));
    }else{
      $search_day_start = new DateTime(date('Y-m-d 00:00:00', strtotime( $request_day_plus->format('Y-m-d H:i:s'))));
      $search_day_end   = new DateTime(date('Y-m-d 23:59:59', strtotime( $request_day_plus->format('Y-m-d H:i:s'))));
    }
    if($search_day_end <= $now_day) continue;
    $diff = $request_day->diff($search_day_start);
    //logger('request_day_plus: ' . $request_day_plus->format('Y-m-d H:i:s'));
    //logger('search_day_start: ' . $search_day_start->format('Y-m-d H:i:s'));
    //logger('search_day_end: ' . $search_day_end->format('Y-m-d H:i:s'));
    //logger('diff_days: ' . $diff->days);
    if($diff->days>7) return ['err'=>3, 'message'=>$message . $request_day->format('m月d日') . '<br />の前後1週間では空きはありませんでした。'];
    $content_date_active_check = Content_date::select('start','end')
      ->where('content_id',$content->id)
      ->where('start', '>=', $search_day_start->format('Y-m-d H:i:s'))
      ->where('start', '<', $search_day_end->format('Y-m-d H:i:s'))
      ->where('end',   '<=', date('Y-m-d H:i:s', strtotime( '+1 day ' . $search_day_end->format('Y-m-d H:i:s'))))
      ->take(10)
      ->get();
    if( empty($content_date_active_check) ) continue;
    foreach($content_date_active_check as $active_date){
      $active_date_search_day_start = new DateTime(date('Y-m-d H:i:s', strtotime($active_date->start)));
      $active_date_search_day_end = new DateTime(date('Y-m-d H:i:s', strtotime($active_date->end)));
      //logger('active_date_search_day_start: ' . $active_date_search_day_start->format('Y-m-d H:i:s'));
      //logger('active_date_search_day_end: ' . $active_date_search_day_end->format('Y-m-d H:i:s'));

      $search_day_plus_start = new DateTime($active_date_search_day_start->format('Y-m-d H:i:s'));
      $search_day_plus_end = new DateTime($active_date_search_day_start->format('Y-m-d H:i:s'));
      $search_day_plus_end->modify('30 minute');
      // use_time > 3
      $use_time_count = ($request_time>29) ? $content_date_user->use_time/30 : $content_date_user->use_time*24*60/30;
      if(!$use_time_count) $use_time_count=3*24*60/30;
      while(true){
        $use_time_count--;
        //logger('search_day_plus_start:  ' . $search_day_plus_start->format('Y-m-d H:i:s'));
        //logger('search_day_plus_end:    ' . $search_day_plus_end->format('Y-m-d H:i:s'));
        if($search_day_plus_end>$active_date_search_day_end){
          //logger('break :: search_day_plus_end>active_date_search_day_end');
          break;
        }else{
          $count = Content_date_users::where('content_id',$content->id)
            ->whereIn('goin',[1,2])
            ->where('start', '<=', $search_day_plus_start->format('Y-m-d H:i:s'))
            ->where('start', '<=', $search_day_plus_end->format('Y-m-d H:i:s'))
            ->where('end', '>=', $search_day_plus_start->format('Y-m-d H:i:s'))
            ->where('end', '>=', $search_day_plus_end->format('Y-m-d H:i:s'))
            ->count();
          //logger('Content_date_users_count: ' . $count);
          if( $count===0 ){
            $search_day_plus_start->modify('30 minute');
            $search_day_plus_end->modify('30 minute');
            continue;
          }
          if( $count > 1000 ) return ['err'=>1, 'message'=>$message . 'また、' . $request_day->format('m月d日') . 'の前後の申込が多いため<br />その他の空きも確認できませんでした。'];
          $content_date_users = Content_date_users::where('content_id',$content->id)
            ->whereIn('goin',[1,2])
            ->where('start', '<=', $search_day_plus_start->format('Y-m-d H:i:s'))
            ->where('start', '<=', $search_day_plus_end->format('Y-m-d H:i:s'))
            ->where('end', '>=', $search_day_plus_start->format('Y-m-d H:i:s'))
            ->where('end', '>=', $search_day_plus_end->format('Y-m-d H:i:s'))
            ->take(1000)
            ->get();
          $total_used = 0;
          foreach($content_date_users as $active_user){
            $active_user_summary = json_decode($active_user->capacities_summary, true);
            //logger('content_date_user_menu_summary');
            //logger($content_date_user_menu_summary);
            foreach($active_user_summary as $menu_summary){
              if($menu_summary['id'] === $val['id']) $total_used += $menu_summary[$unop];
            }
          }
          $total_used += $val[$unop];
          //logger('total_used: ' . $total_used);
          if($total_used > $cd_summary[$val['id']][$dnop]){ //この30分で利用有 break!
            $no_find_user = null;
            //logger($search_day_plus_start->format('Y-m-d H:i:s') . ' - ' . $search_day_plus_end->format('Y-m-d H:i:s') . ' で利用有');
            break;
          }
        }
        //logger('use_time_count: ' . $use_time_count);
        if($use_time_count===0) break;
        $search_day_plus_start->modify('30 minute');
        $search_day_plus_end->modify('30 minute');
      }

      if($request_time>3 and $no_find_user) {
        //logger('request_time < 3 and find aki');
        //logger('end: ' . $search_day_plus_end->format('Y-m-d H:i:s'));
        $search_day_plus_start = clone $search_day_plus_end;
        $search_day_plus_start->modify('-' . $request_time . ' minute');
        return ['err'=>3, 'message'=>$message . $search_day_plus_start->format('m月d日 H:i') . ' ~ ' . $search_day_plus_end->format('H:i') . '<br />上記であれば空きがありました。'];
      }

    }

    if($no_find_user) {
      //logger('request_time <= 3 and find aki');
      //logger('end: ' . $search_day_plus_end->format('Y-m-d H:i:s'));
      return ['err'=>3, 'message'=>$message . date('m月d日 H:i', strtotime($content_date_active_check[0]->start)) . ' ~ ' . $search_day_plus_end->format('m月d日 H:i') . '<br />であれば空きがありました。'];
    }else{
      //logger('no find aki');
    }

  }

  return ['err'=>1, 'message'=>$cd_summary[$val['id']]['name'] . 'は上限です。'];

}












public static function getRequestDayValue()
{

  return [
    0=>null,
    1=>'+1',
    2=>'-1',
    3=>'+2',
    4=>'-2',
    5=>'+3',
    6=>'-3',
    7=>'+4',
    8=>'-4',
    9=>'+5',
    10=>'-5',
    11=>'+6',
    12=>'-6',
    13=>'+7',
    14=>'-7',
    15=>'+8',
    16=>'-8',
    17=>'+9',
    18=>'-9',
    19=>'+10',
    20=>'-10'
  ];

}








public static function getPublicCalendarCalamList()
{

    $ans = [];
    $ans[] = 'description';
    $ans[] = 'non_off';
    $ans[] = 'open_24';
    $ans[] = 'mon_off';
    $ans[] = 'mon_start';
    $ans[] = 'mon_end';
    $ans[] = 'mon_end_nextday';
    $ans[] = 'tue_off';
    $ans[] = 'tue_start';
    $ans[] = 'tue_end';
    $ans[] = 'tue_end_nextday';
    $ans[] = 'wed_off';
    $ans[] = 'wed_start';
    $ans[] = 'wed_end';
    $ans[] = 'wed_end_nextday';
    $ans[] = 'thu_off';
    $ans[] = 'thu_start';
    $ans[] = 'thu_end';
    $ans[] = 'thu_end_nextday';
    $ans[] = 'fri_off';
    $ans[] = 'fri_start';
    $ans[] = 'fri_end';
    $ans[] = 'fri_end_nextday';
    $ans[] = 'sat_off';
    $ans[] = 'sat_start';
    $ans[] = 'sat_end';
    $ans[] = 'sat_end_nextday';
    $ans[] = 'sun_off';
    $ans[] = 'sun_start';
    $ans[] = 'sun_end';
    $ans[] = 'sun_end_nextday';
    $ans[] = 'public_holiday_off';
    $ans[] = 'public_holiday_start';
    $ans[] = 'public_holiday_end';
    $ans[] = 'public_holiday_end_nextday';
    $ans[] = 'New_Year_Holiday_off';
    $ans[] = 'New_Year_Holiday_start';
    $ans[] = 'New_Year_Holiday_end';
    $ans[] = 'New_Year_Holiday_end_nextday';
    $ans[] = 'New_Year_Holiday_start_junbi';
    $ans[] = 'public_holiday_start_junbi';
    $ans[] = 'sun_start_junbi';
    $ans[] = 'sat_start_junbi';
    $ans[] = 'fri_start_junbi';
    $ans[] = 'thu_start_junbi';
    $ans[] = 'wed_start_junbi';
    $ans[] = 'tue_start_junbi';
    $ans[] = 'mon_start_junbi';
    $ans[] = 'New_Year_Holiday_end_junbi';
    $ans[] = 'public_holiday_end_junbi';
    $ans[] = 'sun_end_junbi';
    $ans[] = 'sat_end_junbi';
    $ans[] = 'fri_end_junbi';
    $ans[] = 'thu_end_junbi';
    $ans[] = 'wed_end_junbi';
    $ans[] = 'tue_end_junbi';
    $ans[] = 'mon_end_junbi';
    return $ans;

}




    
public static function createContentCalendar($content_id, $request)
{

  $content = Contents::select('service')->find($content_id);
  //
  // calendar logic
  //
  $company = company::select('id')->where('user_id',Auth::user()->id)->first();
  $company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first();
  if(!$content_calendar = Company_calendar::where('company_id',$company->id)->where('content_id',$content_id)->first()){
    $content_calendar = new Company_calendar;
    $content_calendar->company_id = $company->id;
    $content_calendar->content_id = $content_id;
  }

  if($request->has('FirstContentDateFormcalendar')){

    $publicCalendarCalamList = Utilowner::getPublicCalendarCalamList();
    foreach($publicCalendarCalamList as $val){
      if( $content->service===81 and strpos($val,'_junbi') !== false ) continue;
      //logger($val);
      $content_calendar->$val = $company_calendar->$val;
    }
    $content_calendar->save();
    
  }else{

    $ans = Utilowner::checkPublicClalendar($request);
    if($ans['err']) return $ans;

    $content_calendar->non_off = ($request->has('non-off')) ? 1 : 0;
    $content_calendar->open_24 = ($request->has('open-24')) ? 1 : 0;

    $content_calendar->mon_end = $request->get('mon-end');
    $content_calendar->tue_end = $request->get('tue-end');
    $content_calendar->wed_end = $request->get('wed-end');
    $content_calendar->thu_end = $request->get('thu-end');
    $content_calendar->fri_end = $request->get('fri-end');
    $content_calendar->sat_end = $request->get('sat-end');
    $content_calendar->sun_end = $request->get('sun-end');
    $content_calendar->public_holiday_end = $request->get('public-holiday-end');
    $content_calendar->New_Year_Holiday_end = $request->get('New-Year-Holiday-end');
  
    $content_calendar->mon_start = $request->get('mon-start');
    $content_calendar->tue_start = $request->get('tue-start');
    $content_calendar->wed_start = $request->get('wed-start');
    $content_calendar->thu_start = $request->get('thu-start');
    $content_calendar->fri_start = $request->get('fri-start');
    $content_calendar->sat_start = $request->get('sat-start');
    $content_calendar->sun_start = $request->get('sun-start');
    $content_calendar->public_holiday_start = $request->get('public-holiday-start');
    $content_calendar->New_Year_Holiday_start = $request->get('New-Year-Holiday-start');
  
    if( !($content->service===81) ){
      $content_calendar->mon_end_junbi = $request->get('mon-end-junbi');
      $content_calendar->tue_end_junbi = $request->get('tue-end-junbi');
      $content_calendar->wed_end_junbi = $request->get('wed-end-junbi');
      $content_calendar->thu_end_junbi = $request->get('thu-end-junbi');
      $content_calendar->fri_end_junbi = $request->get('fri-end-junbi');
      $content_calendar->sat_end_junbi = $request->get('sat-end-junbi');
      $content_calendar->sun_end_junbi = $request->get('sun-end-junbi');
      $content_calendar->public_holiday_end_junbi = $request->get('public-holiday-end-junbi');
      $content_calendar->New_Year_Holiday_end_junbi = $request->get('New-Year-Holiday-end-junbi');

      $content_calendar->mon_start_junbi = $request->get('mon-start-junbi');
      $content_calendar->tue_start_junbi = $request->get('tue-start-junbi');
      $content_calendar->wed_start_junbi = $request->get('wed-start-junbi');
      $content_calendar->thu_start_junbi = $request->get('thu-start-junbi');
      $content_calendar->fri_start_junbi = $request->get('fri-start-junbi');
      $content_calendar->sat_start_junbi = $request->get('sat-start-junbi');
      $content_calendar->sun_start_junbi = $request->get('sun-start-junbi');
      $content_calendar->public_holiday_start_junbi = $request->get('public-holiday-start-junbi');
      $content_calendar->New_Year_Holiday_start_junbi = $request->get('New-Year-Holiday-start-junbi');
    }
    
    $content_calendar->non_off = ($request->has('non-off')) ? 1 : 0;
    $content_calendar->mon_off = ($request->has('mon-off')) ? 1 : 0;
    $content_calendar->tue_off = ($request->has('tue-off')) ? 1 : 0;
    $content_calendar->wed_off = ($request->has('wed-off')) ? 1 : 0;
    $content_calendar->thu_off = ($request->has('thu-off')) ? 1 : 0;
    $content_calendar->fri_off = ($request->has('fri-off')) ? 1 : 0;
    $content_calendar->sat_off = ($request->has('sat-off')) ? 1 : 0;
    $content_calendar->sun_off = ($request->has('sun-off')) ? 1 : 0;
    $content_calendar->public_holiday_off = ($request->has('public-holiday-off')) ? 1 : 0;
    $content_calendar->New_Year_Holiday_off = ($request->has('New-Year-Holiday-off')) ? 1 : 0;
  
    $content_calendar->mon_end_nextday = ($request->has('mon-end-nextday')) ? 1 : 0;
    $content_calendar->tue_end_nextday = ($request->has('tue-end-nextday')) ? 1 : 0;
    $content_calendar->wed_end_nextday = ($request->has('wed-end-nextday')) ? 1 : 0;
    $content_calendar->thu_end_nextday = ($request->has('thu-end-nextday')) ? 1 : 0;
    $content_calendar->fri_end_nextday = ($request->has('fri-end-nextday')) ? 1 : 0;
    $content_calendar->sat_end_nextday = ($request->has('sat-end-nextday')) ? 1 : 0;
    $content_calendar->sun_end_nextday = ($request->has('sun-end-nextday')) ? 1 : 0;
    $content_calendar->public_holiday_end_nextday = ($request->has('public-holiday-end-nextday')) ? 1 : 0;
    $content_calendar->New_Year_Holiday_end_nextday = ($request->has('New-Year-Holiday-end-nextday')) ? 1 : 0;
  
    $content_calendar->save();

  }

  return ['err'=>0, 'content_calendar'=>$content_calendar];

}







public static function checkPublicClalendar($request)
{
  
    $ans = ['err'=>null, 'message'=>''];
    $return_flag = false;
  
    if( !$request->has('open-24') ) {

        if( !$request->has('mon-off') ){ if( !($request->get('mon-start') and $request->get('mon-end')) ){ $return_flag = true; } }
        if( !$request->has('tue-off') ){ if( !($request->get('tue-start') and $request->get('tue-end')) ){ $return_flag = true; } }
        if( !$request->has('wed-off') ){ if( !($request->get('wed-start') and $request->get('wed-end')) ){ $return_flag = true; } }
        if( !$request->has('thu-off') ){ if( !($request->get('thu-start') and $request->get('thu-end')) ){ $return_flag = true; } }
        if( !$request->has('fri-off') ){ if( !($request->get('fri-start') and $request->get('fri-end')) ){ $return_flag = true; } }
        if( !$request->has('sat-off') ){ if( !($request->get('sat-start') and $request->get('sat-end')) ){ $return_flag = true; } }
        if( !$request->has('sun-off') ){ if( !($request->get('sun-start') and $request->get('sun-end')) ){ $return_flag = true; } }
        if( !$request->has('public-holiday-off') ){ if( !($request->get('public-holiday-start') and $request->get('public-holiday-end')) ){ $return_flag = true; } }
        if( !$request->has('New-Year-Holiday-off') ){ if( !($request->get('New-Year-Holiday-start') and $request->get('New-Year-Holiday-end')) ){ $return_flag = true; } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '営業日は営業時間をすべて登録してください。';
          return $ans;
        }
    
        if( !$request->has('mon-off') ){ if( !$request->has('mon-end-nextday') and !($request->get('mon-start') < $request->get('mon-end')) ){ $return_flag = true; } }
        if( !$request->has('tue-off') ){ if( !$request->has('tue-end-nextday') and !($request->get('tue-start') < $request->get('tue-end')) ){ $return_flag = true; } }
        if( !$request->has('wed-off') ){ if( !$request->has('wed-end-nextday') and !($request->get('wed-start') < $request->get('wed-end')) ){ $return_flag = true; } }
        if( !$request->has('thu-off') ){ if( !$request->has('thu-end-nextday') and !($request->get('thu-start') < $request->get('thu-end')) ){ $return_flag = true; } }
        if( !$request->has('fri-off') ){ if( !$request->has('fri-end-nextday') and !($request->get('fri-start') < $request->get('fri-end')) ){ $return_flag = true; } }
        if( !$request->has('sat-off') ){ if( !$request->has('sat-end-nextday') and !($request->get('sat-start') < $request->get('sat-end')) ){ $return_flag = true; } }
        if( !$request->has('sun-off') ){ if( !$request->has('sun-end-nextday') and !($request->get('sun-start') < $request->get('sun-end')) ){ $return_flag = true; } }
        if( !$request->has('public-holiday-off') ){ if( !$request->has('public-holiday-end-nextday') and !($request->get('public-holiday-start') < $request->get('public-holiday-end')) ){ $return_flag = true; } }
        if( !$request->has('New-Year-Holiday-off') ){ if( !$request->has('New-Year-Holiday-end-nextday') and !($request->get('New-Year-Holiday-start') < $request->get('New-Year-Holiday-end')) ){ $return_flag = true; } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '営業開始時間は営業終了時間より早い時間を登録してください。';
          return $ans;
        }
    
        if( !$request->has('mon-off') ){ if( $request->get('mon-start-junbi') or $request->get('mon-end-junbi') ){ if( !($request->get('mon-start-junbi') and $request->get('mon-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('tue-off') ){ if( $request->get('tue-start-junbi') or $request->get('tue-end-junbi') ){ if( !($request->get('tue-start-junbi') and $request->get('tue-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('wed-off') ){ if( $request->get('wed-start-junbi') or $request->get('wed-end-junbi') ){ if( !($request->get('wed-start-junbi') and $request->get('wed-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('thu-off') ){ if( $request->get('thu-start-junbi') or $request->get('thu-end-junbi') ){ if( !($request->get('thu-start-junbi') and $request->get('thu-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('fri-off') ){ if( $request->get('fri-start-junbi') or $request->get('fri-end-junbi') ){ if( !($request->get('fri-start-junbi') and $request->get('fri-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sat-off') ){ if( $request->get('sat-start-junbi') or $request->get('sat-end-junbi') ){ if( !($request->get('sat-start-junbi') and $request->get('sat-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sun-off') ){ if( $request->get('sun-start-junbi') or $request->get('sun-end-junbi') ){ if( !($request->get('sun-start-junbi') and $request->get('sun-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('public-holiday-off') ){ if( $request->get('public-holiday-start-junbi') or $request->get('public-holiday-end-junbi') ){ if( !($request->get('public-holiday-start-junbi') and $request->get('public-holiday-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('New-Year-Holiday-off') ){ if( $request->get('New-Year-Holiday-start-junbi') or $request->get('New-Year-Holiday-end-junbi') ){ if( !($request->get('New-Year-Holiday-start-junbi') and $request->get('New-Year-Holiday-end-junbi')) ){ $return_flag = true; } } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '準備時間は開始、終了両方登録してください。';
          return $ans;
        }
    
        if( !$request->has('mon-off') ){ if( $request->get('mon-start-junbi') or $request->get('mon-end-junbi') ){ if( !($request->get('mon-start-junbi') < $request->get('mon-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('tue-off') ){ if( $request->get('tue-start-junbi') or $request->get('tue-end-junbi') ){ if( !($request->get('tue-start-junbi') < $request->get('tue-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('wed-off') ){ if( $request->get('wed-start-junbi') or $request->get('wed-end-junbi') ){ if( !($request->get('wed-start-junbi') < $request->get('wed-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('thu-off') ){ if( $request->get('thu-start-junbi') or $request->get('thu-end-junbi') ){ if( !($request->get('thu-start-junbi') < $request->get('thu-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('fri-off') ){ if( $request->get('fri-start-junbi') or $request->get('fri-end-junbi') ){ if( !($request->get('fri-start-junbi') < $request->get('fri-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sat-off') ){ if( $request->get('sat-start-junbi') or $request->get('sat-end-junbi') ){ if( !($request->get('sat-start-junbi') < $request->get('sat-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sun-off') ){ if( $request->get('sun-start-junbi') or $request->get('sun-end-junbi') ){ if( !($request->get('sun-start-junbi') < $request->get('sun-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('public-holiday-off') ){ if( $request->get('public-holiday-start-junbi') or $request->get('public-holiday-end-junbi') ){ if( !($request->get('public-holiday-start-junbi') < $request->get('public-holiday-end-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('New-Year-Holiday-off') ){ if( $request->get('New-Year-Holiday-start-junbi') or $request->get('New-Year-Holiday-end-junbi') ){ if( !($request->get('New-Year-Holiday-start-junbi') < $request->get('New-Year-Holiday-end-junbi')) ){ $return_flag = true; } } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '準備開始時間は、準備終了時間より早い時間を登録してください。';
          return $ans;
        }
    
        if( !$request->has('mon-off') ){ if( $request->get('mon-start-junbi') or $request->get('mon-end-junbi') ){ if( !($request->get('mon-start') < $request->get('mon-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('tue-off') ){ if( $request->get('tue-start-junbi') or $request->get('tue-end-junbi') ){ if( !($request->get('tue-start') < $request->get('tue-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('wed-off') ){ if( $request->get('wed-start-junbi') or $request->get('wed-end-junbi') ){ if( !($request->get('wed-start') < $request->get('wed-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('thu-off') ){ if( $request->get('thu-start-junbi') or $request->get('thu-end-junbi') ){ if( !($request->get('thu-start') < $request->get('thu-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('fri-off') ){ if( $request->get('fri-start-junbi') or $request->get('fri-end-junbi') ){ if( !($request->get('fri-start') < $request->get('fri-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sat-off') ){ if( $request->get('sat-start-junbi') or $request->get('sat-end-junbi') ){ if( !($request->get('sat-start') < $request->get('sat-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('sun-off') ){ if( $request->get('sun-start-junbi') or $request->get('sun-end-junbi') ){ if( !($request->get('sun-start') < $request->get('sun-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('public-holiday-off') ){ if( $request->get('public-holiday-start-junbi') or $request->get('public-holiday-end-junbi') ){ if( !($request->get('public-holiday-start') < $request->get('public-holiday-start-junbi')) ){ $return_flag = true; } } }
        if( !$request->has('New-Year-Holiday-off') ){ if( $request->get('New-Year-Holiday-start-junbi') or $request->get('New-Year-Holiday-end-junbi') ){ if( !($request->get('New-Year-Holiday-start') < $request->get('New-Year-Holiday-start-junbi')) ){ $return_flag = true; } } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '開始時間は、準備開始時間より早い時間を登録してください。';
          return $ans;
        }
    
        if( !$request->has('mon-off') ){ if( $request->get('mon-start-junbi') or $request->get('mon-end-junbi') ){ if( !$request->has('mon-end-nextday') and !($request->get('mon-end-junbi') < $request->get('mon-end')) ){ $return_flag = true; } } }
        if( !$request->has('tue-off') ){ if( $request->get('tue-start-junbi') or $request->get('tue-end-junbi') ){ if( !$request->has('tue-end-nextday') and !($request->get('tue-end-junbi') < $request->get('tue-end')) ){ $return_flag = true; } } }
        if( !$request->has('wed-off') ){ if( $request->get('wed-start-junbi') or $request->get('wed-end-junbi') ){ if( !$request->has('wed-end-nextday') and !($request->get('wed-end-junbi') < $request->get('wed-end')) ){ $return_flag = true; } } }
        if( !$request->has('thu-off') ){ if( $request->get('thu-start-junbi') or $request->get('thu-end-junbi') ){ if( !$request->has('thu-end-nextday') and !($request->get('thu-end-junbi') < $request->get('thu-end')) ){ $return_flag = true; } } }
        if( !$request->has('fri-off') ){ if( $request->get('fri-start-junbi') or $request->get('fri-end-junbi') ){ if( !$request->has('fri-end-nextday') and !($request->get('fri-end-junbi') < $request->get('fri-end')) ){ $return_flag = true; } } }
        if( !$request->has('sat-off') ){ if( $request->get('sat-start-junbi') or $request->get('sat-end-junbi') ){ if( !$request->has('sat-end-nextday') and !($request->get('sat-end-junbi') < $request->get('sat-end')) ){ $return_flag = true; } } }
        if( !$request->has('sun-off') ){ if( $request->get('sun-start-junbi') or $request->get('sun-end-junbi') ){ if( !$request->has('sun-end-nextday') and !($request->get('sun-end-junbi') < $request->get('sun-end')) ){ $return_flag = true; } } }
        if( !$request->has('public-holiday-off') ){ if( $request->get('public-holiday-start-junbi') or $request->get('public-holiday-end-junbi') ){ if( !$request->has('public-holiday-end-nextday') and !($request->get('public-holiday-end-junbi') < $request->get('public-holiday-end')) ){ $return_flag = true; } } }
        if( !$request->has('New-Year-Holiday-off') ){ if( $request->get('New-Year-Holiday-start-junbi') or $request->get('New-Year-Holiday-end-junbi') ){ if( !$request->has('New-Year-Holiday-end-nextday') and !($request->get('New-Year-Holiday-end-junbi') < $request->get('New-Year-Holiday-end')) ){ $return_flag = true; } } }
        if($return_flag){
          $ans['err'] = 1;
          $ans['message'] = '準備終了時間は、終了時間より早い時間を登録してください。';
          return $ans;
        }

    }

    return $ans;

}





public static function checkUsedCapacity($capacity)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date_users = Content_date_users::select('start','end','capacities_summary')
      ->where('content_id',$capacity->content_id)
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get()
  ){
    foreach($content_date_users as $content_date_user){
      $capacities_summary = json_decode($content_date_user->capacities_summary,true);
      foreach($capacities_summary as $capa_id=>$capacity_summary){
        if( (int)$capa_id === $capacity->id ) return true;
      }
    }
  }
  return false;


}



public static function deleteCapacityToDate($content_id, $capacity_id)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::where('content_id',$content_id)
      ->select('id')
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_dates as $content_date){
      $content_date = Content_date::find($content_date->id);
      $capacity_ids = json_decode($content_date->capacity_ids,true);
      if($capacity_ids){
        $capacity_ids = array_diff($capacity_ids, array($capacity_id));
        $capacity_ids = array_values($capacity_ids);
        $content_date->capacity_ids=json_encode($capacity_ids);
      }
      $capacities_summary = json_decode($content_date->capacities_summary,true);
      $capacities_summary_new = [];
      foreach($capacities_summary as $capacity_summary){
        if($capacity_summary['id'] === $capacity_id) continue;
        $capacities_summary_new[$capacity_summary['id']] = $capacity_summary;
      }
      $content_date->capacities_summary = json_encode($capacities_summary_new);
      $content_date->save();
    }
  }

}


public static function editCapacityToDate($content_id, $capacity_id)
{
  
  $content = Contents::select('id','service')->find($content_id);
  $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $capacity_id);
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::where('content_id',$content_id)
      ->select('id')
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_dates as $content_date){
      $content_date = Content_date::find($content_date->id);
      $capacities_summary = json_decode($content_date->capacities_summary,true);
      foreach($capacities_summary as $key=>$capacity_summary){
        if($capacity_summary['id'] === $capacity->id){
          $capacities_summary[$key]['type'] = $capacity->type;
          $capacities_summary[$key]['number'] = $capacity->number;
          $capacities_summary[$key]['person'] = $capacity->person;
          $capacities_summary[$key]['price'] = $capacity->price;
          break;
        } 
      }
      $content_date->capacities_summary = json_encode($capacities_summary);
      $content_date->save();
    }
  }

}




public static function deleteMenuToDate($content_id, $menu_id)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::where('content_id',$content_id)
      ->select('id')
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_dates as $content_date){
      $content_date = Content_date::find($content_date->id);
      $menu_ids = json_decode($content_date->menu_ids,true);
      if($menu_ids){
        $menu_ids = array_diff($menu_ids, array($menu_id));
        $menu_ids = array_values($menu_ids);
        $content_date->menu_ids=json_encode($menu_ids);
      }
      $lunch_ids = json_decode($content_date->lunch_ids,true);
      if($lunch_ids){
        $lunch_ids = array_diff($lunch_ids, array($menu_id));
        $lunch_ids = array_values($lunch_ids);
        $content_date->lunch_ids=json_encode($lunch_ids);
      }
      $menus_summary = json_decode($content_date->menus_summary,true);
      $menus_summary_new = [];
      foreach($menus_summary as $menu_summary){
        if($menu_summary['id'] === $menu_id) continue;
        $menus_summary_new[$menu_summary['id']] = $menu_summary;
      }
      $content_date->menus_summary = json_encode($menus_summary_new);
      $lunchs_summary = json_decode($content_date->lunchs_summary,true);
      $lunchs_summary_new = [];
      foreach($lunchs_summary as $lunch_summary){
        if($lunch_summary['id'] === $menu_id) continue;
        $lunchs_summary_new[$lunch_summary['id']] = $lunch_summary;
      }
      $content_date->lunchs_summary = json_encode($lunchs_summary_new);
      $content_date->save();
    }
  }

}


public static function editMenuToDate($content_id, $menu_id)
{
  
  $content = Contents::select('id','service')->find($content_id);
  $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::where('content_id',$content_id)
      ->select('id')
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_dates as $content_date){
      $content_date = Content_date::find($content_date->id);
      $menus_summary = json_decode($content_date->menus_summary,true);
      foreach($menus_summary as $key=>$menu_summary){
        if($menu_summary['id'] === $menu->id){
          $menus_summary[$key]['type'] = $menu->type;
          $menus_summary[$key]['number'] = $menu->number;
          $menus_summary[$key]['person'] = $menu->person;
          $menus_summary[$key]['price'] = $menu->price;
          if($content->service===65 or $content->service===77 or $content->service===90){
            $menus_summary[$key]['simultaneously'] = $menu->simultaneously;
          }
          break;
        } 
      }
      $content_date->menus_summary = json_encode($menus_summary);

      $lunchs_summary = json_decode($content_date->lunchs_summary,true);
      foreach($lunchs_summary as $key=>$lunch_summary){
        if($lunch_summary['id'] === $menu->id){
          $lunchs_summary[$key]['type'] = $menu->type;
          $lunchs_summary[$key]['number'] = $menu->number;
          $lunchs_summary[$key]['person'] = $menu->person;
          $lunchs_summary[$key]['price'] = $menu->price;
          break;
        } 
      }
      $content_date->lunchs_summary = json_encode($lunchs_summary);
      $content_date->save();
    }
  }

}











public static function addCapacityTagkaigi($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_number = 0;
    $sum_capacity_person = 0;
    $room_price_min = 999999999;
    $room_price_max = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      if($room_price_min>$capacity->price){
          $room_price_min = $capacity->price;
      }
      if($room_price_max<$capacity->price){
          $room_price_max = $capacity->price;
      }
      $sum_capacity_number += $capacity->number;
      $sum_capacity_person += ($capacity->area) ? $capacity->area/2 : 0;
    }
    $content->room_price = $room_price_min;
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags = new Content_tags;
    //  $content_tags->content_id = $content->id;
    //  $content_tags->save();
    //}    

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}



public static function addCapacityTagstay($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $hotspring = 0;
    $net = 0;
    $kids = 0;
    $yoji = 0;
    $baby = 0;
    $nonesmoking = 0;
    $bus = 0;
    $toilet = 0;
    $refrigerator = 0;

    $room_price_min = 999999999;
    $room_price_max = 0;
    $room_person_max = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      if($capacity->hotspring) $hotspring = 1;
      if($capacity->net)  $net = 1;
      if($capacity->kids) $kids = 1;
      if($capacity->yoji) $yoji = 1;
      if($capacity->baby) $baby = 1;
      if($capacity->nonesmoking) $nonesmoking = 1;
      if($capacity->bus) $bus = 1;
      if($capacity->toilet) $toilet = 1;
      if($capacity->refrigerator) $refrigerator = 1;
      if($room_price_min>$capacity->price){
          $room_price_min = $capacity->price;
      }
      if($room_price_max<$capacity->price){
          $room_price_max = $capacity->price;
      }
      if($capacity->type===1){
        if($room_person_max<$capacity->person){
          $room_person_max = $capacity->person;
        }
      }
      
      if(!$capacity->public) $sum_capacity_number += $capacity->number;
      if(!$capacity->public) $sum_capacity_person += $capacity->person*$capacity->number;
    }
    $content->room_price = $room_price_min;
    //$content->room_price = '2:' . $room_price_min . ':' . $room_price_max;
    //$content->room_person_max = $room_person_max;
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------


    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags->delete();
    //}
    //$content_tags = new Content_tags;
    //$content_tags->content_id = $content->id;
    //$content_tags->tag41 = $hotspring;
    //$content_tags->tag42 = $net;
    //$content_tags->tag43 = $nonesmoking;
    //$content_tags->tag44 = $bus;
    //$content_tags->tag45 = $toilet;
    //$content_tags->tag46 = $refrigerator;
    //$content_tags->tag47 = $kids;
    //$content_tags->tag48 = $yoji;
    //$content_tags->tag49 = $baby;
    //$content_tags->save();

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}








public static function addCapacityTaghairsalon($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    //if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $private = 0;
    $onlyColor = 0;
    $onlyCut = 0;
    $all = 0;
    $cut = 0;
    $color = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      switch ($capacity->type){
        case 1:  $cut = 1; break;
        case 2:  $color = 1; break;
        case 3:  $all = 1; break;
      }
      if($capacity->private) $private = 1;
      $sum_capacity_number += $capacity->number;
      $sum_capacity_person += $capacity->number;
    }
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags->delete();
    //}
    //$content_tags = new Content_tags;
    //$content_tags->content_id = $content->id;
    //if($all===0 and $cut===1 and $color===0) $content_tags->tag41 = 1;
    //if($all===0 and $cut===0 and $color===1) $content_tags->tag42 = 1;
    //$content_tags->tag43 = $private;
    //$content_tags->save();

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}



public static function addCapacityTagdivination($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      //$content->sum_capacity_number = $sum_capacity_number;
      //$content->sum_capacity_person = $sum_capacity_person;
    }
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags->delete();
    //}
    //$content_tags = new Content_tags;
    //$content_tags->content_id = $content->id;
    //$content_tags->save();

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}




public static function addCapacityTagspasalon($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $massage = 0;
    $body = 0;
    $face = 0;
    $nail = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      switch ($capacity->type){
        case 1:  $massage = 1; break;
        case 2:  $body = 1; break;
        case 3:  $face = 1; break;
        case 4:  $nail = 1; break;
      }
      //$content->sum_capacity_number = $sum_capacity_number;
      //$content->sum_capacity_person = $sum_capacity_person;
    }
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags->delete();
    //}
    //$content_tags = new Content_tags;
    //$content_tags->content_id = $content->id;
    //$content_tags->tag41 = $massage;
    //$content_tags->tag42 = $body;
    //$content_tags->tag43 = $face;
    //$content_tags->tag44 = $nail;
    //$content_tags->save();

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}






public static function addCapacityTagrecruit($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
    }
    //service===4,6,7はメニューでsum_capacityを決定する。
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}



public static function addCapacityTaglesson($content_id)
{

    //add capacity to Contents table
    //------------------------------
    /*
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
  
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $hobby = 0;
    $music = 0;
    $sports = 0;
    $study = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      switch ($capacity->type){
        case 1:  $hobby = 1;  break;
        case 2:  $music = 1;  break;
        case 3:  $sports= 1;  break;
        case 4:  $study = 1;  break;
      }
    }
    //service===4,6,7はメニューでsum_capacityを決定する。
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    //if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    //  $content_tags->delete();
    //}
    //$content_tags = new Content_tags;
    //$content_tags->content_id = $content->id;
    //$content_tags->tag41 = $hobby;
    //$content_tags->tag42 = $music;
    //$content_tags->tag43 = $sports;
    //$content_tags->tag44 = $study;
    //$content_tags->save();
    */
    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}




public static function addCapacityTagactive($content_id)
{

    //add capacity to Contents table
    //------------------------------
    $content = Contents::find($content_id);
    /*

    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $darts = 0;
    $tabletennis = 0;
    $tennis = 0;
    $Billiards = 0;
    $Bouldering = 0;
    $gym = 0;
    $pool = 0;
    $free = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      switch ($capacity->type){
        case 1:  $darts=1; $sum_capacity_number+=$capacity->number; break;
        case 2:  $tabletennis=1; $sum_capacity_number+=$capacity->number; break;
        case 3:  $tennis=1; $sum_capacity_number+=$capacity->number; break;
        case 4:  $Billiards=1; $sum_capacity_number+=$capacity->number; break;
        case 5:  $Bouldering=1; $sum_capacity_person+=$capacity->person; break;
        case 6:  $gym=1; $sum_capacity_person+=$capacity->person; break;
        case 7:  $pool=1; $sum_capacity_person+=$capacity->person; break;
        case 9:  $free=1; $sum_capacity_person+=$capacity->person; break;
      }
    }
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    if($content_tags = Content_tags::where('content_id',$content->id)->first()){
      $content_tags->delete();
    }
    $content_tags = new Content_tags;
    $content_tags->content_id = $content->id;
    $content_tags->tag41 = $darts;
    $content_tags->tag42 = $tabletennis;
    $content_tags->tag43 = $tennis;
    $content_tags->tag44 = $Billiards;
    $content_tags->tag45 = $Bouldering;
    $content_tags->tag46 = $gym;
    $content_tags->tag47 = $pool;
    $content_tags->tag49 = $free;
    $content_tags->save();
    */
    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}





public static function addCapacityTagstudio($content_id)
{

    //add capacity to Contents table
    //------------------------------
    
    $content = Contents::find($content_id);
    /*
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);

    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $photo = 0;
    $music = 0;
    $live = 0;
    $kitchen = 0;
    $free = 0;
    $room_price_min = 999999999;
    $room_price_max = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }
      switch ($capacity->type){
        case 1:  $photo = 1; break;
        case 2:  $music = 1; break;
        case 3:  $live = 1; break;
        case 4:  $kitchen = 1; break;
        case 9:  $free = 1; break;
      }
      if($room_price_min>$capacity->price){
          $room_price_min = $capacity->price;
      }
      if($room_price_max<$capacity->price){
          $room_price_max = $capacity->price;
      }
      $sum_capacity_number += $capacity->number;
      $sum_capacity_person += ($capacity->area) ? $capacity->area/3 : 0;
    }
    $content->room_price = '2:' . $room_price_min . ':' . $room_price_max;
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags
    if($content_tags = Content_tags::where('content_id',$content->id)->first()){
      $content_tags->delete();
    }
    $content_tags = new Content_tags;
    $content_tags->content_id = $content->id;
    $content_tags->tag41 = $photo;
    $content_tags->tag42 = $music;
    $content_tags->tag43 = $live;
    $content_tags->tag44 = $kitchen;
    $content_tags->tag45 = $free;
    $content_tags->save();
    */

    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}



public static function addCapacityTagfood($content_id)
{

    //add capacity to Contents table
    //------------------------------
    
    $content = Contents::find($content_id);
    if( $content->service===69 or $content->service===101 ) return null;
    /*
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  
    $sum_capacity_person = 0;
    $sum_capacity_number = 0;
    $private_flug = 0;
    $nonesmoking_flug = 0;
    $smoking_flug = 0;
    $sheet_flug = 0;
    $yukabori_flug = 0;
    $room_price_min = 999999999;
    $room_price_max = 0;
    $room_price_yes = 0;
    $room_price_no = 0;

    foreach($capacities as $key=>$capacity){
      if($capacity->delete_flug){
        continue;
      }

      if($capacity->private===1) $private_flug = 1;
      if($capacity->yukabori===1) $yukabori_flug = 1;
      //logger($capacity->nonesmoking);
      if($capacity->nonesmoking===1){
        $nonesmoking_flug = 1;
      }else{
        $smoking_flug = 1;
      }
      if($capacity->sheet===1) $sheet_flug = 1;
      if($capacity->price){
        $room_price_yes = 1;
        if($room_price_min>$capacity->price){
            $room_price_min = $capacity->price;
        }
        if($room_price_max<$capacity->price){
            $room_price_max = $capacity->price;
        }
      }else{
        $room_price_no = 1;
      }

      $sum_capacity_number += $capacity->number;
      $sum_capacity_person += $capacity->person*$capacity->number;
      
    }
    if($room_price_yes){
        if($room_price_no){
            $content->room_price = '1:' . $room_price_min . ':' . $room_price_max;
        }else{
            $content->room_price = '2:' . $room_price_min . ':' . $room_price_max;
        }
    }

    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
    $content->save();
    //end add capacity to Contents table
    //------------------------------

    // add capacity tags 
    if($content_tags = Content_tags::where('content_id',$content->id)->first()){
      $content_tags->delete();
    }
    $content_tags = new Content_tags;
    $content_tags->content_id = $content->id;
    if($nonesmoking_flug===1 and $smoking_flug===1){
      $content_tags->tag41 = 0;
      $content_tags->tag42 = 1;
    }elseif($nonesmoking_flug===1 and $smoking_flug===0){
      $content_tags->tag41 = 1;
      $content_tags->tag42 = 0;
    }else{
      $content_tags->tag41 = 0;
      $content_tags->tag42 = 0;
    }
    $content_tags->tag43 = $private_flug;
    $content_tags->tag44 = $sheet_flug;
    $content_tags->tag45 = $yukabori_flug;
    $content_tags->save();

    */
    if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
      DB::table('contents_check')->insert(['content_id'=>$content->id]);
    }

    return 1;

}







public static function checkStartEnd($start, $end, $content_id, $content_date)
{

    $ans = ['err'=>null, 'message'=>''];
  
    if($content_date_before_tmp = Content_date::select('start','end')->where('content_id',$content_id)
      ->where('start', '<', date('Y-m-d H:i:s', strtotime($content_date->start)) )
      ->orderBy('start', 'desc')
      ->first())
    {
      $content_date_before = $content_date_before_tmp->end;
    }else{
      $content_date_before = date('Y-m-d H:i:s');
    }
    if($content_date_after_tmp = Content_date::select('start','end')->where('content_id',$content_id)
      ->where('start', '>', date('Y-m-d H:i:s', strtotime($content_date->end)) )
      ->orderBy('start', 'asc')
      ->first())
    {
      $content_date_after = $content_date_after_tmp->start;
    }else{
      $content_date_after = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
    }
    //logger($start);
    //logger($end);
    //logger($content_date_before);
    //logger($content_date_after);
  
    $DT_start  = new DateTime($start);
    $DT_end    = new DateTime($end);
    $DT_before = new DateTime($content_date_before);
    $DT_after  = new DateTime($content_date_after);
    if($DT_start < $DT_before){
      $ans['err'] = 1;
      $ans['message'] = '前スケジュールより小さくできません。';
    }
    if($DT_end > $DT_after){
      $ans['err'] = 1;
      $ans['message'] = '後スケジュールより大きくできません。';
    }
    if($DT_start > $DT_end){
      $ans['err'] = 1;
      $ans['message'] = '開始より終了は大きくしてください。';
    }
  
    return $ans;

}


//
//price put to content.
//---------------------
public static function putMaxMinPriceToContent($content_id)
{

  $content = Contents::find($content_id);
  $max_price = 0;
  $min_price = 99999999;
  $sum_capacity_number = 0;
  $sum_capacity_person = 0;
  switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
    case 'food' : $menus = Content_menu_food::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'active' : //$menus = Content_menu_experience::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'experience' : $menus = Content_menu_experience::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'lesson' : $menus = Content_menu_lesson::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'spasalon' : $menus = Content_menu_spasalon::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'tour' : $menus = Content_menu_tour::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'ticket' : $menus = Content_menu_ticket::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'hairsalon' : $menus = Content_menu_hairsalon::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'stay' : $menus = Content_menu_stay::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'studio' : //$menus = Content_menu_stay::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'kaigi' : //$menus = Content_menu_stay::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'hotel' : //$menus = Content_menu_stay::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'recruit' : //$menus = Content_menu_stay::select('price')->where('content_id',$content_id)->take(500)->get(); break;
    case 'divination' : $menus = Content_menu_divination::select('price')->where('content_id',$content_id)->take(500)->get(); break;
  }

  foreach($menus as $val){
    if($val->price > $max_price) $max_price = $val->price;
    if($val->price < $min_price) $min_price = $val->price;
    if($content->service===62 or $content->service===69 or $content->service===101){
      //ticket7はカスタマーに枚数を入力させるタイプ、4、６は利用人数で利用数を決定させるタイプで異なるが、
      //許容枠は両者numberで統一されているため最大数はこれで問題なし。客のカウントはnumberとpersonで分ける用にする。
      $sum_capacity_number += $val->number;
      $sum_capacity_person += $val->number;
    }
  }
  if($content->service===62 or $content->service===69 or $content->service===101){
    //$content->sum_capacity_number = $sum_capacity_number;
    //$content->sum_capacity_person = $sum_capacity_person;
  }

  $content->price = $min_price;
  //$content->price_min = $min_price;
  $content->save();

  if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
    DB::table('contents_check')->insert(['content_id'=>$content->id]);
  }
  
}





public static function checkRequestContentMenu($content_id,$menu_id)
{

  $content = Contents::select('service')->find($content_id);
  switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
    case 'lesson': $table_menu = 'content_menu_lesson'; $table_check = 'content_menu_lesson_check'; break;
    case 'tour': $table_menu = 'content_menu_tour';   $table_check = 'content_menu_tour_check';   break;
    case 'ticket': $table_menu = 'content_menu_ticket'; $table_check = 'content_menu_ticket_check'; break;
  }
  if(!$exist = DB::table($table_check)->where($table_menu.'_id',$menu_id)->first()){
    DB::table($table_check)->insert([$table_menu.'_id'=>$menu_id, 'content_id'=>$content_id]);
  }

}





public static function checkUseMenuToUser($content_id, $menu_id){

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date_users = Content_date_users::where('content_id',$content_id)
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_date_users as $content_date_user){
      $menu_ids = json_decode($content_date_user->menu_ids,true);
      if( $menu_ids and in_array($menu_id, $menu_ids, true) ){
        return 1;
      }
    }
  }
  return 0;

}




  
public static function getDiscount($content, $use_time)
{

  $content_discount = Content_discount::where('content_id',$content->id)->first();
  //logger($content_discount);

  if($use_time===3){
    if($content_discount->day3)   return $content_discount->day3;
    if($content_discount->day2)   return $content_discount->day2;
    if($content_discount->hour12) return $content_discount->hour12;
    if($content_discount->hour11) return $content_discount->hour11;
    if($content_discount->hour10) return $content_discount->hour10;
    if($content_discount->hour9)  return $content_discount->hour9;
    if($content_discount->hour8)  return $content_discount->hour8;
    if($content_discount->hour7)  return $content_discount->hour7;
    if($content_discount->hour6)  return $content_discount->hour6;
    if($content_discount->hour5)  return $content_discount->hour5;
    if($content_discount->hour4)  return $content_discount->hour4;
    if($content_discount->hour3)  return $content_discount->hour3;
    if($content_discount->hour2)  return $content_discount->hour2;
    if($content_discount->hour1)  return $content_discount->hour1;
    return 0;
  }elseif($use_time===2){
    if($content_discount->day2)   return $content_discount->day2;
    if($content_discount->hour12) return $content_discount->hour12;
    if($content_discount->hour11) return $content_discount->hour11;
    if($content_discount->hour10) return $content_discount->hour10;
    if($content_discount->hour9)  return $content_discount->hour9;
    if($content_discount->hour8)  return $content_discount->hour8;
    if($content_discount->hour7)  return $content_discount->hour7;
    if($content_discount->hour6)  return $content_discount->hour6;
    if($content_discount->hour5)  return $content_discount->hour5;
    if($content_discount->hour4)  return $content_discount->hour4;
    if($content_discount->hour3)  return $content_discount->hour3;
    if($content_discount->hour2)  return $content_discount->hour2;
    if($content_discount->hour1)  return $content_discount->hour1;
    return 0;
  }else{
    $discount_hour = $use_time/60;
    if($discount_hour<1) return 0;
    if($discount_hour>=12){
      if($content_discount->hour12) return $content_discount->hour12;
      if($content_discount->hour11) return $content_discount->hour11;
      if($content_discount->hour10) return $content_discount->hour10;
      if($content_discount->hour9)  return $content_discount->hour9;
      if($content_discount->hour8)  return $content_discount->hour8;
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=11){
      if($content_discount->hour11) return $content_discount->hour11;
      if($content_discount->hour10) return $content_discount->hour10;
      if($content_discount->hour9)  return $content_discount->hour9;
      if($content_discount->hour8)  return $content_discount->hour8;
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=10){
      if($content_discount->hour10) return $content_discount->hour10;
      if($content_discount->hour9)  return $content_discount->hour9;
      if($content_discount->hour8)  return $content_discount->hour8;
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=9){
      if($content_discount->hour9)  return $content_discount->hour9;
      if($content_discount->hour8)  return $content_discount->hour8;
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=8){
      if($content_discount->hour8)  return $content_discount->hour8;
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=7){
      if($content_discount->hour7)  return $content_discount->hour7;
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=6){
      if($content_discount->hour6)  return $content_discount->hour6;
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=5){
      if($content_discount->hour5)  return $content_discount->hour5;
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=4){
      if($content_discount->hour4)  return $content_discount->hour4;
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=3){
      if($content_discount->hour3)  return $content_discount->hour3;
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=2){
      if($content_discount->hour2)  return $content_discount->hour2;
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
    if($discount_hour>=1){
      if($content_discount->hour1)  return $content_discount->hour1;
      return 0;
    }
  }
}







    public static function welcome()
    {
        return 'welcome Utilowner';
    }


}