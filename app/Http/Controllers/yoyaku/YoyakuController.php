<?php namespace App\Http\Controllers\yoyaku;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\models\User_recruit;

use App\models\Place_owner_new;

use App\models\Country_area;

use App\models\company;
use App\models\company_code;
use App\models\Company_calendar;


use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_cancel_calendar;
use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;

use App\models\Content_tags;

use App\models\Content_capacity_stay;
use App\models\Content_menu_stay;

use App\models\Recommends;
use App\models\Recommends_pics;

use Auth;
use DB;
use Storage;
use File;
use DateTime;
use DateInterval;
use Validator;
use Redirect;
use Util;
use UtilYoyaku;
use View;
use Mail;




class YoyakuController extends Controller {


public function __construct()
{
}











public function getRegister(Request $request)
{

  if(Auth::check()){
    if(Auth::user()->owner) return redirect()->to('/owner');
    return redirect()->to('/owner/register');
  }

  $contents = Contents::select(
    'contents.id',
    'contents.service',
    'contents.country_area_id',
    'contents.country_area_address_one',
    'contents.country_area_address_two',
    'contents.country_area_address_other',
    'contents.station_name',
    'contents.station_distance',
    'contents.tell',
    'contents.name',
    'contents.price',
    'contents.pic',
    'contents.shop_down',
    'contents.description',
    'contents.recommend_number',
    'contents.recommend_point',
    'contents.good_number',
    'contents.bad_number',
    'contents.user_id'
    )
    //->where('contents.admin_open',1)
    ->whereIn('contents.id',[860578,52,6,41,40,33,50,19,48,46,45])
    ->paginate(20);
    
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);

    if($content->service===62 or $content->service===69 or $content->service===101){
      $content_date = Content_date::where('content_id',$content->id)
        ->where('menu_ids', '=', '['.$content->menu_id.']')
        ->where('start', '>=', date('Y-m-d 00:00:00'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first();
    }else{
      $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>=', date('Y-m-d 00:00:00'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first();
    }

    if($content_date)
    {
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
    }
    $contents[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents[$key]['content_tags'] = [];
    }
    
  }

  $owner_services = [];
  $company = new company;

  $company_code = [];
  $company_code_tmp = company_code::get();
  foreach($company_code_tmp as $val){
    $company_code[$val->id] = $val->name;
  }

  return View::make('yoyaku.register', compact('contents','company','company_code','owner_services'));

}







public function getStep(Request $request, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $step_id = (int)$request->get('step_id');
  $step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $step_id);
  return $step;

}
public function getSteps(Request $request, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  return $steps;

}






public function getMenu(Request $request, $content_id)
{

  $content = Contents::select('service')->find($content_id);
  $menu_id = $request->get('menu_id');
  $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
  return $menu;

}



public function getMenuStep(Request $request, $content_id)
{

  $content = Contents::select('service')->find($content_id);
  $menu_id = (int)$request->get('menu_id');
  $step_id = (int)$request->get('step_id');
  $step = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, $step_id);
  return $step;

}



public function getMenus(Request $request, $content_id)
{

  $content = Contents::select('id','service','user_id')->find($content_id);
  
  $owner = User::select('csv')->find($content->user_id);

  if($owner->csv){
    $ids = [];
    $pics = [];
    $recommends = Recommends::select('id')
      ->where('table_name', 'contents')
      ->where('table_id', $content->id)
      ->orderBy('created_at', 'desc')
      ->take(100)
      ->get();
    foreach($recommends as $a){
      $ids[] = $a->id;
    }
    //logger($ids);
    if($ids){
      if(
        $recommends_pics = Recommends_pics::select('recommends.id','recommends_pics.pic','recommends.user_id','users.name as user_name')
          ->join('recommends', 'recommends.id', '=', 'recommends_pics.recommend_id')
          ->join('users', 'users.id', '=', 'recommends.user_id')
          ->whereIn('recommends_pics.recommend_id',$ids)
          ->where('recommends_pics.type',2)
          ->orderBy('recommends_pics.created_at','desc')->take(20)->get()){
        foreach($recommends_pics as $val){
          if($val->pic){
            $pics[] = [
              'title'=> UtilYoyaku::getNewContentCapacity($content->service) . ' 投稿:' . $val->user_name,
              'p250'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'250'),
              'p1600'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'1600')
            ];
          }
        }
      }
    }
    //logger($pics);
    return $pics;
  }

  $menus = Util::getContentMenu($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  if($content->service===62 or $content->service===69 or $content->service===101){
    foreach($menus as $key=>$menu){
      $menus[$key]['steps'] = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, null);
    }
  }
  //logger($menus);
  return $menus;

}

public function getCapacity(Request $request, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('capacity_id'));
  return $capacity;

}

public function getCapacities(Request $request, $content_id)
{

  $content = Contents::select('id','service','user_id')->find($content_id);

  $owner = User::select('csv')->find($content->user_id);

  if($owner->csv){
    $ids = [];
    $pics = [];
    $recommends = Recommends::select('id')
      ->where('table_name', 'contents')
      ->where('table_id', $content->id)
      ->orderBy('created_at', 'desc')
      ->take(100)
      ->get();
    foreach($recommends as $a){
      $ids[] = $a->id;
    }
    if($ids){
      if(
        $recommends_pics = Recommends_pics::select('recommends.id','recommends_pics.pic','recommends.user_id','users.name as user_name')
          ->join('recommends', 'recommends.id', '=', 'recommends_pics.recommend_id')
          ->join('users', 'users.id', '=', 'recommends.user_id')
          ->whereIn('recommends_pics.recommend_id',$ids)
          ->where('recommends_pics.type',3)
          ->orderBy('recommends_pics.created_at','desc')->take(20)->get()){
        foreach($recommends_pics as $val){
          if($val->pic){
            $pics[] = [
              'title'=> UtilYoyaku::getNewContentCapacity($content->service) . ' 投稿:' . $val->user_name,
              'p250'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'250'),
              'p1600'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'1600')
            ];
          }
        }
      }
    }
    return $pics;
  }

  $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  return $capacities;

}

public function getDateCapacities(Request $request, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  if(!$content_date = Content_date::find($request->get('content_date_id'))) return ['err'=>1,'message'=>'must param'];
  $capacity_ids = json_decode($content_date->capacity_ids, true);
  return Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null);

}



public function getMedias(Request $request, $content_id)
{

  $pics = [];
  $content = Contents::select('id','user_id','name','service','pic','back_pic')->find($content_id);

  if($content->pic){
    $pics[] = [
        'title'=>$content->name,
        'p400'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content_id, 400),
        'p1600'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content_id, 1600)
    ];
  }
  if($content->back_pic){
    $pics[] = [
        'title'=>$content->name,
        'p400'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content_id, 400),
        'p1600'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content_id, 1600)
    ];
  }

  
  foreach(Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null) as $step){
    if($step->pic){
      $pics[] = [
        'title'=>'ポイント' . $step->element_number,
        'p400'=>'/storage/uploads/contents/' . $content->id . '/step/' . $step->id . '/' . Util::addFilename($step->pic,'400'),
        'p1600'=>'/storage/uploads/contents/' . $content->id . '/step/' . $step->id . '/' . Util::addFilename($step->pic,'1600')
      ];
    }
  }
  
  if( !($content->service===69 or $content->service===101) ){
      $Capacity = Util::getContentCapacityDesc($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null, null);
      if(!empty($Capacity)){
        foreach($Capacity as $val){
          if($val->pic){
          $pics[] = [
            'title'=> UtilYoyaku::getNewContentCapacity($content->service),
            'p400'=>Util::getPicCapa('capa', false, $val->pic,  $content->id, 400, $val->id),
            'p1600'=>Util::getPicCapa('capa', false, $val->pic,  $content->id, 1600, $val->id)
          ];
          }
        }
      }
  }
  
  if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) ){
  $menus = Util::getContentMenu($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null, null);
  if(!empty($menus)){
    foreach($menus as $val){
      if($val->pic){
        $pics[] = [
          'title'=> $val->name,
          'p400'=>Util::getPicMenu(null, false, $val->pic, $content->id, 400, $val->id),
          'p1600'=>Util::getPicMenu(null, false, $val->pic, $content->id, 1600, $val->id)
        ];
      }
    }
  }
  }

  $ids = [];
  $recommends = Recommends::select('id')
    ->where('table_name', 'contents')
    ->where('table_id', $content->id)
    ->orderBy('created_at', 'desc')
    ->take(100)
    ->get();
  foreach($recommends as $a){
    $ids[] = $a->id;
  }
  //logger($ids);
  if($ids){
    if(
      $recommends_pics = Recommends_pics::select('recommends.id','recommends_pics.pic','recommends.user_id','users.name as user_name')
        ->join('recommends', 'recommends.id', '=', 'recommends_pics.recommend_id')
        ->join('users', 'users.id', '=', 'recommends.user_id')
        ->whereIn('recommends_pics.recommend_id',$ids)->orderBy('recommends_pics.created_at','desc')->take(20)->get()){
      foreach($recommends_pics as $val){
        if($val->pic){
          $pics[] = [
            'title'=> '投稿:' . $val->user_name,
            'p400'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'400'),
            'p1600'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'1600')
          ];
        }
      }
    }
  }
  
  return $pics;

}




public function getUseTimes(Request $request, $content_id)
{
  
  $content_date = Content_date::find($request->get('content_date_id'));
  return $content_date;

}



public function getDateUsers(Request $request, $content_id)
{
  
  $content = Contents::select('id','service')->find($content_id);
  if(!$content_date = Content_date::select('id','start')->find($request->get('content_date_id'))) return ['err'=>1, 'message'=>'must param'];
  
  ///////
  // content_date の 30分ごとの status 判定
  // active2, spasalon5, hairsalon8, studio10, kaigi11 で利用
  $content_date_users_30min = [];
  if(
    $content->service===39 or
    $content->service===65 or
    $content->service===77 or
    $content->service===85 or
    $content->service===89 or
    $content->service===91 or
    $content->service===90
  ){
    $request_start = ($request->has('request_start')) ? $request->get('request_start') : $content_date->start ;
    $DT_start = new DateTime($request_start);
    $DT_startPlus = new DateTime($request_start);
    $DT_startPlus->modify('30 minute');
    $content_date_users_30min = Content_date_users::select(
        'start',
        'end',
        'use_time',
        'use_time_desc',
        'join_user_number',
        'menu_ids',
        'menus_summary',
        'menus_desc',
        'capacity_ids',
        'capacities_summary',
        'capacities_desc'
      )
      ->where('content_id',$content->id)
      ->whereIn('goin',[1,2])
      ->where('start', '<=', $DT_start->format('Y-m-d H:i:s'))
      ->where('start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
      ->where('end', '>=', $DT_start->format('Y-m-d H:i:s'))
      ->where('end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
      ->take(10000)
      ->get();
  }
  if($content->service===39 or $content->service===85 or $content->service===89){
    //2, 10, 11 は最大3日間利用するためこの期間を取得
    $DT_startAgo = new DateTime($request_start);
    $DT_startAgo->modify('-3 day');
    $content_dates = Content_date::select('id')
      ->where('content_id',$content->id)
      ->where('start', '<=', $DT_start->format('Y-m-d H:i:s'))
      ->where('start', '>=', $DT_startAgo->format('Y-m-d 00:00:00'))
      ->take(10)
      ->get();
    $content_date_ids = [];
    foreach($content_dates as $val){
      $content_date_ids[] = $val->id;
    }
    //logger($content_date_ids);
    $content_date_users_oneDate = Content_date_users::select(
        'start',
        'end',
        'use_time',
        'use_time_desc',
        'join_user_number',
        'menu_ids',
        'menus_summary',
        'menus_desc',
        'capacity_ids',
        'capacities_summary',
        'capacities_desc'
      )
      ->where('content_id',$content->id)
      ->whereIn('content_date_id', $content_date_ids)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get();
    //logger($content_date_users_oneDate);
  }else{ //その他はcontent_date単位で問題ないでしょう。
    //logger('this one?');
    //logger('content_date->id: ' . $content_date->id);
    $content_date_users_oneDate = Content_date_users::select(
        'start',
        'end',
        'use_time',
        'use_time_desc',
        'join_user_number',
        'menu_ids',
        'menus_summary',
        'menus_desc',
        'capacity_ids',
        'capacities_summary',
        'capacities_desc'
      )
      ->where('content_id',$content->id)
      ->where('content_date_id', $content_date->id)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get();
  }

  $dateTotalCapacities = UtilYoyaku::getDateTotalCapacities($content_date->id);

  return ['content_date_users_30min'=>$content_date_users_30min, 'content_date_users_oneDate'=>$content_date_users_oneDate, 'dateTotalCapacities'=>$dateTotalCapacities];
 
}

public function getDateOne(Request $request, $content_id)
{
  
  $content_date = Content_date::find($request->get('content_date_id'));
  return $content_date;

}





public function getIframeCalendar(Request $request, $content_id)
{

  $content = Contents::find($content_id);

  $company = Company::where('user_id',$content->user_id)->first();

  if( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91) ){
    if( !$content_calendar = Company_calendar::where('content_id', $content->id)->first() )
    {
      return View('yoyaku.iframe.incomplete', compact('現在登録中です。'));
    }  
  }

  $place_owner = Place_owner_new::where('content_id',$content->id)->first();

  return View('yoyaku.iframe.calendar', compact('content','company','place_owner'));

}






public function getMenuIds(Request $request, $content_id)
{
  // axios
  $content = Contents::select('service')->find($content_id);
  $ids = json_decode($request->get('ids'),true);
  $content_menus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $ids, null);
  return $content_menus;
}

public function getMenusSelect(Request $request, $content_id)
{
  
  // axios
  if(!$request->get('time')) return 'ng';
  $content = Contents::select('service')->find($content_id);
  $content_date = Content_date::find((int)$request->get('id'));

  if( $content->service===39 or $content->service===85 or $content->service===89 ){
    $capacity_ids = json_decode($content_date->capacity_ids, true);
    return Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null);
  }

  if($content->service===15){
    $lunch_menus = json_decode($content_date->lunch_ids, true);
    if($lunch_menus){
      $requestTime = str_replace('T',' ',$request->get('time'));
      $requestTime = str_replace('"','',$requestTime);
      //logger($requestTime);
      $date = new DateTime($requestTime);
      $lunchStart = new DateTime($date->format('Y-m-d') . ' 10:00:00');
      $lunchEnd = new DateTime($date->format('Y-m-d') . ' 15:00:00');
      if($date >= $lunchStart and $date <= $lunchEnd){
        //logger('in lunch');
        //return Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $lunch_menus);
        return Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $lunch_menus, null);
      }
    }
  }
  $menus = json_decode($content_date->menu_ids, true);
  return Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $menus, null);

}

//stay9 only
public function getMenusSelectStay(Request $request, $content_id)
{
  
  // axios
  $content = Contents::find($content_id);
  $content_date = Content_date::find((int)$request->get('modalSelectMenuId'));

  if(!$request->get('selectMenuFormperson')) return ['err'=>1, 'message'=> 'ご利用人数を入力してください。'];
  $person = (int)$request->get('selectMenuFormperson');
  if($person > $content->room_person_max) return ['err'=>3, 'message'=> $content->room_person_max+1 . '名以上のお部屋はございませんでした。<br />' . $content->room_person_max . '名以下でご予約を分けてください。'];
  if($person > 20) return ['err'=>3, 'message'=> '一度のご予約は20名様までとなります。<br />' . '人数を分けてご予約ください。'];
  $nonesmoking = ($request->has('selectMenuFormnonesmoking')) ? 1 : 0;

  $oton = 0;
  $kids = 0;
  $yoji = 0;
  $baby = 0;

  switch($person){
    case 1:  $person_select = 1;  break;
    case 2:  $person_select = 2;  break;
    case 3:  $person_select = 4;  break;
    case 4:  $person_select = 4;  break;
    case 5:  $person_select = 6;  break;
    case 6:  $person_select = 6;  break;
    case 7:  $person_select = 8;  break;
    case 8:  $person_select = 8;  break;
    case 9:  $person_select = 10; break;
    case 10: $person_select = 10; break;
    case 11: $person_select = 12; break;
    case 12: $person_select = 12; break;
    case 13: $person_select = 14; break;
    case 14: $person_select = 14; break;
    case 15: $person_select = 16; break;
    case 16: $person_select = 16; break;
    case 17: $person_select = 18; break;
    case 18: $person_select = 18; break;
    case 19: $person_select = 20; break;
    case 20: $person_select = 20; break;
  }
  //logger('person_select: ' . $person_select);
  
  for ($i = 1; $i <= $person; $i++){
    $old = (int)$request->get('selectMenuFormPersonDescOld'.$i);
    if ($old<1){ $baby=1;
    }elseif($old<6){ $yoji=1;
    }elseif($old<10){ $kids=1;
    }else{ $oton=1; }
  }
  //logger('$oton' . $oton);
  //logger('$kids' . $kids);
  //logger('$yoji' . $yoji);
  //logger('$baby' . $baby);
  $capacities = [];
  $capacities_tmp = Content_capacity_stay::where('content_id',$content_id)
    ->where('kids','>=',$kids)
    ->where('yoji','>=',$yoji)
    ->where('baby','>=',$baby)
    ->whereIn('id',json_decode($content_date->capacity_ids, true))
    ->orderBy('element_number','asc')
    ->take(200)
    ->get();
  foreach($capacities_tmp as $capacity){
    if($capacity->type===1){
      if($capacity->nonesmoking !== $nonesmoking) continue;
      if($capacity->person !== $person_select) continue; 
      $capacities[] = $capacity;
    }else{
      if($capacity->use_only_public){
        $capacities[] = $capacity;
      }
    }
  }
  
  $menus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, json_decode($content_date->menu_ids, true), null);
  
  $content_date_users_oneDate = Content_date_users::where('content_id',$content->id)
      ->where('content_date_id', $content_date->id)
      ->whereIn('goin', [1,2])
      ->take(100000)
      ->get();
  
  return ['content_date'=>$content_date,'content_date_users_oneDate'=>$content_date_users_oneDate,'capacities'=>$capacities,'menus'=>$menus];

}




// service 4,6,7 の content_date に menu がひとつのタイプ
public function getMenuSelect(Request $request, $content_id)
{
  
  // axios
  $content = Contents::select('service')->find($content_id);
  if(!$content_date = Content_date::find((int)$request->get('id'))) return ['err'=>1, 'message'=>'must param'];
  $menus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, json_decode($content_date->menu_ids, true), null);
  return $menus[0];

}



public function getContentChat(Request $request)
{
  return View('yoyaku.contentChat', compact(''));
}

public function getContentYoyaku(Request $request)
{
  return View('yoyaku.contentYoyaku', compact(''));
}

public function getContentConfime(Request $request)
{
  return View('yoyaku.contentConfime', compact(''));
}

public function getContentCompletion(Request $request)
{
  return View('yoyaku.contentCompletion', compact(''));
}












public function getIntroduce()
{
  return View('yoyaku.introduce.owner.yoyaku', compact(''));
}



public function getIntroduceOwner()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.shop_down',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.user_id',1)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(25);

    $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
    $favo = Util::getFavo('contents');
    foreach($contents as $key=>$content){
      
      $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
  
      if($content->service===62 or $content->service===69 or $content->service===101){
        $content_date = Content_date::where('content_id',$content->id)
          ->where('menu_ids', '=', '['.$content->menu_id.']')
          ->where('start', '>=', date('Y-m-d 00:00:00'))
          ->where('start', '<=', $last_day)
          ->whereIn('status', [1,2,3])
          ->orderBy('start', 'asc')
          ->first();
      }else{
        $content_date = Content_date::where('content_id',$content->id)
          ->where('start', '>=', date('Y-m-d 00:00:00'))
          ->where('start', '<=', $last_day)
          ->whereIn('status', [1,2,3])
          ->orderBy('start', 'asc')
          ->first();
      }
  
      if($content_date)
      {
        $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
        $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
        if($content_date->percent and $content_date->percent<100){
          $content_date['title'] = '割引' . $content_date['title'];
          $content_date['color'] = '#FF5722';
        }
      }
      $contents[$key]['content_date'] = $content_date;
  
      if($content->service===91){
        $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
        $contents[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
      }
  
      $contents[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
      if(!$contents[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
        $contents[$key]['content_tags'] = [];
      }
      
    }


  return View('yoyaku.introduce.owner.yoyaku', compact('contents'));
  
}



public function getIntroduceOwnerFood()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',15)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}




public function getIntroduceOwnerActive()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',39)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}



public function getIntroduceOwnerExperience()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',3)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}




public function getIntroduceOwnerLesson()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',62)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}



public function getIntroduceOwnerSpasalon()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',65)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}



public function getIntroduceOwnerTour()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',69)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}


public function getIntroduceOwnerTicket()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',7)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}


public function getIntroduceOwnerHairsalon()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',77)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}


public function getIntroduceOwnerStay()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',81)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}


public function getIntroduceOwnerStudio()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',85)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}


public function getIntroduceOwnerKaigi()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',89)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}



public function getIntroduceOwnerRecruit()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',91)
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }

    if($content->service===91){
      $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents[$key]['menu'] = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

  }

  return View('yoyaku.introduce.owner.yoyaku.recruit', compact('contents'));
  
}



public function getIntroduceOwnerDivination()
{
  
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('contents.user_id',1)
    ->where('contents.service',90 )
    ->orderBy('pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->paginate(1);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if(
        $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>', date('Y-m-d H:i:s'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first()
    ){
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
      $contents[$key]['content_date'] = $content_date;
    }else{
      $contents[$key]['content_date'] = null;
    }
  }

  return View('yoyaku.introduce.owner.yoyaku.public', compact('contents'));
  
}












public function getRequestEditContent(Request $request)
{

  if(!Auth::check()){
    return redirect()->to('/login')->with("info","先にログインしてください。");
  }

  if(!$request->get('content_id')){
    return redirect()->back()->with("info","編集するコンテンツがみつかりません。");
  }
  $content = Contents::find((int)$request->get('content_id'));
  
  return View('yoyaku.request.edit.content', compact('content'));

}

public function postRequestEditContent(Request $request)
{

  if(!Auth::check()){
    return redirect()->to('/login')->with("info","先にログインしてください。");
  }

  $options['ssl']['verify_peer']=false;
  $options['ssl']['verify_peer_name']=false;

  // リクエストURLの組み立て「https://www.google.com/recaptcha/api/siteverify?secret=[API SECRET]&response=[ユーザ認証コード]」
  $request_url = sprintf("%s?secret=%s&response=%s", env('RECAPTCHA_API_URL', ''), env('RECAPTCHA_API_SECRET', ''), $request->input('g-recaptcha-response'));
  // reCAPTCHA API へリクエストを送り結果を受け取る
  $response = file_get_contents($request_url, false, stream_context_create($options));
  // JSON形式を配列へ変換する
  $response_array = json_decode($response, true);

  if(!$response_array['success']){
    return redirect()->back()->with("warning","画面を読み込み直してもう一度お試しください。");
  }
  if(!$request->get('content_id')){
    return redirect()->back()->with("warning","コンテンツが見つかりませんでした。");
  }

  $owner = ($request->has('owner')) ? 1 :0;
  $iknow = ($request->has('iknow')) ? 1 :0;
  
  DB::table('request_edit_content')->insert([
    'content_id'=>$request->get('content_id'),
    'user_id'=>Auth::user()->id,
    'owner'=>$owner,
    'iknow'=>$iknow,
    'updated_at' => date("Y-m-d H:i:s")
  ]);
  
  $data = array(
    'iknow' => $iknow
  );
  Mail::send('emails.manager.request.edit.content', $data, function ($m) use ($data) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to('admin@coordiy.com', 'Coordiy管理者様');
    $m->subject('[Coordiy]コンテンツ編集リクエスト依頼');
  });

  return redirect()->back()->with("info","編集依頼ありがとうございます。");

}












}


