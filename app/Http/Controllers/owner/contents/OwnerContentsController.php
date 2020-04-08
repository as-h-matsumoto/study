<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_recruit_type;
use App\models\Content_discount;
use App\models\Content_cancel_calendar;
use App\models\Content_menu_recruit;

use App\models\Place_owner_new;
use App\models\company;
use App\models\Company_calendar;

use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;
use App\models\Owners_users;

use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use Utilowner;
use UtilYoyaku;
use DateTime;

class OwnerContentsController extends Controller {

public function __construct()
{

}




public function getTop(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  $content['steps'] = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);

  if( !($content->service===69 or $content->service===101) ){
    $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
    if(!$place_owner = Place_owner_new::where('content_id',$id)->first()){
      $place_owner = new Place_owner_new;
    }
  }

  //menus
  $menus = [];
  if( !($content->service===39 or $content->service===85 or $content->service===89) ){
    $menus = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
    if($content->service===62 or $content->service===69 or $content->service===101){
      foreach($menus as $key=>$menu){
        $menus[$key]['steps'] = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, null);
      }
    }
  }

  //discount
  $content_discount = false;
  if($content->service===85 or $content->service===89 or $content->service===39){
    if($content_discount = Content_discount::select('id')->where('content_id',$content->id)->first()){
      $content_discount = true;
    }
  }

  //desc
  //$content

  //cancel
  $content_cancel_calendar = false;
  if($content_cancel_calendar = Content_cancel_calendar::where('content_id',$id)->first()){
    $content_cancel_calendar = true;
  }

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  //date
  $content_date = false;
  if($content_date = Content_date::select('id')->where('content_id',$id)
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->first() )
  {
    $content_date = true;
  }

  //active_content_date_users
  $content_date_users_total = Content_date_users::select('id')
      ->where('content_id',$id)
      ->whereIn('goin',[1,2])
      ->count();
  $content_date_users_active = Content_date_users::select('id')
      ->where('content_id',$id)
      ->whereIn('goin',[1,2])
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->count();

  $content_recruit_types = false;
  $content_menu_recruit = false;
  
  if($content->service===91){
    if($content_recruit_types = Content_recruit_type::where('content_id',$content->id)->first() ) $content_recruit_types = true;
    if($content_menu_recruit = Content_menu_recruit::where('content_id',$content->id)->first() ) $content_menu_recruit = true;
  }

  return View('owner.contents.top.index', compact('content','company','menus','content_discount','content_cancel_calendar','content_date','content_date_users_total','content_date_users_active','content_recruit_types','content_menu_recruit','place_owner','capacities'));

}



public function getDayDates(Request $request, $content_id)
{

  $day_start = $request->get('day') . ' 00:00:00';
  $day_end = $request->get('day') . ' 23:59:59';

  if(
    $content_date = Content_date::select('id','start','end')
      ->where('content_id',$content_id)
      ->where('start', '>=', $day_start)
      ->where('start', '<=', $day_end)
      ->whereNotNull('status')
      ->orderBy('start', 'asc')
      ->take(2)
      ->get()
  ){
    return $content_date;
  }

  return [];

}


public function getDateUsers(Request $request, $content_id)
{

  $data = [];
  $content = Contents::select('id','service','user_id')->find($content_id);
  $content_dates = Content_date::where('id',$request->get('content_date_id'))->take(2)->get();
  if(empty($content_dates)){
    if(
      $content->service===62 or
      $content->service===69 or
      $content->service===101
    ){
      $take_number = 50;
    }else{
      $take_number = 2;
    }
    
    $day_start = $request->get('day') . ' 00:00:00';
    $day_end = $request->get('day') . ' 23:59:59';
    if(
      !$content_dates = Content_date::where('content_id',$content_id)
        ->where('start', '>=', $day_start)
        ->where('start', '<=', $day_end)
        ->whereNotNull('status')
        ->orderBy('start', 'asc')
        ->take($take_number)
        ->get()
    ){
      return [];
    }
  }

  if($content->service===62 or $content->service===69 or $content->service===101){
    foreach($content_dates as $key=>$val){
          $menu_ids = json_decode($val->menu_ids,true);
          $content_dates[$key]['menu'] = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_ids[0]);
    }
  }
  

  $active_user = false;
  ///////
  // content_date の 30分ごとの status 判定
  // active2, spasalon5, hairsalon8, studio10, kaigi11 で利用
  foreach($content_dates as $key=>$content_date){

    $content_date_users_30min = [];
    if(
      $content->service===15 or
      $content->service===39 or
      $content->service===65 or
      $content->service===77 or
      $content->service===39 or
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
          'content_date_users.start',
          'content_date_users.end',
          'content_date_users.use_time',
          'content_date_users.use_time_desc',
          'content_date_users.join_user_number',
          'content_date_users.menu_ids',
          'content_date_users.menus_summary',
          'content_date_users.menus_desc',
          'content_date_users.capacity_ids',
          'content_date_users.capacities_summary',
          'content_date_users.capacities_desc'
        )
        ->where('content_date_users.content_id',$content->id)
        ->whereIn('content_date_users.goin',[1,2])
        ->where('content_date_users.start', '<=', $DT_start->format('Y-m-d H:i:s'))
        ->where('content_date_users.start', '<=', $DT_startPlus->format('Y-m-d H:i:s'))
        ->where('content_date_users.end', '>=', $DT_start->format('Y-m-d H:i:s'))
        ->where('content_date_users.end', '>=', $DT_startPlus->format('Y-m-d H:i:s'))
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
          'content_date_users.user_id',
          'content_date_users.start',
          'content_date_users.end',
          'content_date_users.use_time',
          'content_date_users.use_time_desc',
          'content_date_users.join_user_number',
          'content_date_users.menu_ids',
          'content_date_users.menus_summary',
          'content_date_users.menus_desc',
          'content_date_users.capacity_ids',
          'content_date_users.capacities_summary',
          'content_date_users.capacities_desc',
          'content_date_users.yoyaku_id',
          'content_date_users.owners_user_id',
          //'users.id as user_id',
          //'users.pic as user_pic',
          'owners_users.name as user_name',
          'owners_users.tell as user_tell'
        )
        ->join('owners_users', 'owners_users.id', '=', 'content_date_users.owners_user_id')
        //->join('users', 'users.id', '=', 'owners_users.user_id')
        ->where('content_date_users.content_id',$content->id)
        ->whereIn('content_date_users.content_date_id', $content_date_ids)
        ->whereIn('content_date_users.goin', [1,2])
        ->orderBy('content_date_users.start','asc')
        ->take(100000)
        ->get();
      //logger($content_date_users_oneDate);
    }else{ //その他はcontent_date単位で問題ないでしょう。
      //logger('this one?');
      //logger('content_date->id: ' . $content_date->id);
      $content_date_users_oneDate = Content_date_users::select(
          'content_date_users.user_id',
          'content_date_users.start',
          'content_date_users.end',
          'content_date_users.use_time',
          'content_date_users.use_time_desc',
          'content_date_users.join_user_number',
          'content_date_users.menu_ids',
          'content_date_users.menus_summary',
          'content_date_users.menus_desc',
          'content_date_users.capacity_ids',
          'content_date_users.capacities_summary',
          'content_date_users.capacities_desc',
          'content_date_users.yoyaku_id',
          'content_date_users.owners_user_id',
          //'users.id as user_id',
          //'users.pic as user_pic',
          'owners_users.name as user_name',
          'owners_users.tell as user_tell'
        )
        ->join('owners_users', 'owners_users.id', '=', 'content_date_users.owners_user_id')
        //->join('users', 'users.id', '=', 'owners_users.user_id')
        ->where('content_date_users.content_id',$content->id)
        ->where('content_date_users.content_date_id', $content_date->id)
        ->whereIn('content_date_users.goin', [1,2])
        ->orderBy('content_date_users.start','asc')
        ->take(100000)
        ->get();
    }

    if( !empty($content_date_users_oneDate) ){
      $active_user = true;
      foreach($content_date_users_oneDate as $key=>$val){
        if($val->user_id!==$content->user_id){
          $user = User::select('pic')->find($val->user_id);
          $content_date_users_oneDate[$key]['user_pic'] = $user->pic;
        }else{
          $content_date_users_oneDate[$key]['user_pic'] = null;
        }
      }
    }
  
    $dateTotalCapacities = UtilYoyaku::getDateTotalCapacities($content_date->id);

    $data[] = ['event'=>$content_date, 'content_date_users_30min'=>$content_date_users_30min, 'content_date_users_oneDate'=>$content_date_users_oneDate, 'dateTotalCapacities'=>$dateTotalCapacities];

  }

  return ['active_user'=>$active_user, 'data'=>$data];

}




    

public function openClose(Request $request, $content_id)
{

  $content = Contents::find($content_id);
  $content->owner_open = ($content->owner_open===1) ? 0 : 1;
  $content->save();

  return ['err'=>0, 'owner_open'=>$content->owner_open];

}



public function deleteContent(Request $request, $content_id)
{

  //logger('delete in');
  $content = Contents::find($content_id);

  $name = $content->name;

  $alltime = $this->checkUsedToContentAllTime($content);
  $now = $this->checkUsedToContentNow($content);

  if($now){ //1 予約者がいる　検索から排除のみ admin_open = 0
    $content->save();
    return redirect('/owner')->with('longMessage', $name.'は予約者がいるため削除できませんでした。予約者の対応が終わってから削除してください。');
  }elseif($alltime){ //2 10年間の間で利用があった。delete_flug=1, オーナーのコンテンツ一覧にも乗らない　検索から排除 admin_open = 0
    $this->deleteContentValue($content);
    $content->admin_open = 0;
    $content->delete_flug = 1;
    $content->save();
    return redirect('/owner/contents')->with('info', $name.'を削除しました。');
  }else{ //3 現在、過去に利用がなければ全部削除
    $this->deleteContentPic($content);
    $this->deleteContentValue($content);
    $content->delete();
    return redirect('/owner/contents')->with('info', $name.'を削除しました。');
  }

}

function checkUsedToContentNow($content)
{
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date_users = Content_date_users::select('id')
      ->where('content_date_users.content_id',$content->id)
      ->whereIn('content_date_users.goin',[1,2])
      ->where('content_date_users.start', '>=', date('Y-m-d H:i:s'))
      ->where('content_date_users.start', '<=', $last_day)
      ->first()
  ){
    return true;
  }else{
    return false;
  }
}
function checkUsedToContentAllTime($content)
{
  if(
      $content_date_users = Content_date_users::select('id')
      ->where('content_date_users.content_id',$content->id)
      ->whereIn('content_date_users.goin',[1,2])
      ->where('content_date_users.start', '>=', date('Y-m-d H:i:s', strtotime('-10 year')))
      ->where('content_date_users.start', '<=', date('Y-m-d H:i:s'))
      ->first()
  ){
    return true;
  }else{
    return false;
  }
}
function deleteContentPic($content)
{

  if( !($content->service===69 or $content->service===101) ){
    $capas_pics = Util::getContentCapacityDesc( $content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null, null);
    foreach($capas_pics as $capa){
      $path = '/uploads/contents/' . $content->id . '/capacity/' . $capa->id . '/';
      Util::delelteImage($path, $capa->pic);
    }
  }

  if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) ){
    $menus_pics = Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null, null);
    foreach($menus_pics as $menu){
      $path = '/uploads/contents/' . $content->id . '/menu/' . $menu->id . '/';
      Util::delelteImage($path, $menu->pic);
      if( $content->service===62 or $content->service===69 or $content->service===101 ){
        $menu_steps = Util::getContentMenuStep($content->id, $content->service, $menu->id, null, null, null);
        foreach($menu_steps as $step){
          $path = '/uploads/contents/' . $content->id . '/menu/' . $menu->id . '/step/' . $step->id . '/';
          Util::delelteImage($path, $step->pic);
        }
      }
    }
  }

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  foreach($steps as $step){
    $path = '/uploads/contents/' . $content->id . '/step/' . $step->id . '/';
    Util::delelteImage($path, $step->pic);
  }

  $path = '/uploads/contents/' . $content->id . '/';
  Util::delelteImage($path, $content->pic);
  Util::delelteImage($path, $content->back_pic);

  return 1;

}

function deleteContentValue($content)
{
  DB::table('company_calendar')->where('content_id',$content->id)->delete();
  DB::table('content_date')->where('content_id',$content->id)->delete();
  
  if( !($content->service===39 or $content->service===85 or $content->service===89) ){
    Util::deleteContentMenu(null, $content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true);
    DB::table('content_discount')->where('content_id',$content->id)->delete();
    if( $content->service===62 or $content->service===69 or $content->service===101 ){
      Util::deleteContentMenusSteps($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service));
    }
  }
  
  Util::deleteContentSteps($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service));

  if( !($content->service===69 or $content->service===101) ){
    Util::deleteContentCapacity(null, $content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true);
  }
  if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit'){
    DB::table('content_cancel_calendar')->where('content_id',$content->id)->delete();
  }
  if($content->service===91){
    DB::table('content_recruit_types')->where('content_id',$content->id)->delete();
  }

  DB::table('contents_good')->where('content_id',$content->id)->delete();
  DB::table('contents_bad')->where('content_id',$content->id)->delete();
  return 1;
}










public function index(Request $request)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.owner_open',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.pic',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number'
    )
    ->where('user_id',Utilowner::getOwnerId())
    ->where('delete_flug',0)
    ->orderBy('pic', 'desc')
    ->orderBy('updated_at', 'desc')
    ->paginate(25);
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
    }
  }
  if ($request->has('page')) {
    return json_encode(View::make('include.search_contents', array('contents' => $contents))->render());
  }


  if( empty($contents) ) return redirect('/owner/contents/create/first')->with('info', 'コンテンツタイプを選択してください。');

  return View('owner.contents.index', compact('contents','company'));

}

public function getCreateFirst(Request $request)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $owner_service = owner_service::where('user_id',Utilowner::getOwnerId())->first();

  return View('owner.contents.create_first', compact('company','owner_service'));
  
}


public function getCreateSecond(Request $request)
{

  $service = $request->get('service');
  $company = company::where('user_id',Utilowner::getOwnerId())->first();

  return View('owner.contents.create_second', compact('company','service'));

}


public function postCreateSecond(Request $request)
{

  $this->validate($request, [
    'service'=> 'required',
    'name'   => 'required|min:1|max:255'
  ]);

  $owner_services = owner_service::where('user_id',Utilowner::getOwnerId())->first();
  $key = UtilYoyaku::getNewMenuSenMonTenKey((int)$request->get('service'));
  if($owner_services->$key!==1){
    return back()->with('warning', '許可されていないコンテンツは作成できません。')->withInput();
  }

  $contents = new Contents;

  $contents->service = $request->get('service');
  $contents->user_id = Utilowner::getOwnerId();
  $contents->calendar_flug = 1;
  $contents->name = $request->get('name');

  $contents->save();

  $message = '最初に、所在地を登録してください。';

  return redirect('/owner/contents/' . $contents->id . '/golist/edit')->with('success', $message);

}









}