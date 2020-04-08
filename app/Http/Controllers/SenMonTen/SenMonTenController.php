<?php namespace App\Http\Controllers\SenMonTen;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;
use App\models\User_recruit;

use App\models\Place;
use App\models\Place_owner_new;

use App\models\Country_area;

use App\models\company;
use App\models\Company_calendar;
use App\models\company_code;

use App\models\Contents;
use App\models\Content_tags;

use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_cancel_calendar;
use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;

use App\models\Content_capacity_stay;
use App\models\Content_menu_stay;

use App\models\Recommends;
use App\models\Recommends_pics;

use App\models\Itownpage;

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




class SenMonTenController extends Controller {


public function __construct()
{
}










public function index_map(Request $request, $service_name)
{

  $take_number = 100;
  $yoyaku_type_id     = $GLOBALS['yoyaku_type_id'];
  $yoyaku_type_tag_id = $GLOBALS['yoyaku_type_tag_id'];

  if($request->has('yoyaku_type_tag_id')){
    $yoyaku_type_tag_id = $request->get('yoyaku_type_tag_id');
    setcookie('yoyaku_type_tag_id',$request->get('yoyaku_type_tag_id'));
    $GLOBALS['yoyaku_type_tag_id'] = (int)$request->get('yoyaku_type_tag_id');
    $GLOBALS['yoyaku_type_tag_name'] = UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_id'], $GLOBALS['yoyaku_type_tag_id']);
  }

  if($request->has('country_area_id')){
   //logger('country_area in');
    $country_area_id = $request->get('country_area_id');
    $country_area_address_one_custom_id = 0;
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_id',$request->get('country_area_id'));
    setcookie('country_area_address_one_custom_id',0);
    setcookie('country_area_address_two_custom_id',0);
  }elseif(isset($_COOKIE['country_area_id']) and $_COOKIE['country_area_id']){
    //logger('in2');
    $country_area_id = $_COOKIE['country_area_id'];
  }else{
    //logger('in3');
    setcookie('country_area_id',0);
    $country_area_id = 0;
    setcookie('country_area_address_one_custom_id',0);
    $country_area_address_one_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
    $country_area_address_two_custom_id = 0;
  }
  //logger('country_area_id1: '. $country_area_id);

  if($request->has('country_area_address_one_custom_id')){
    $country_area_address_one_custom_id = $request->get('country_area_address_one_custom_id');
    setcookie('country_area_address_one_custom_id',$request->get('country_area_address_one_custom_id'));
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
  }elseif(!isset($country_area_address_one_custom_id)){
    if(isset($_COOKIE['country_area_address_one_custom_id']) and $_COOKIE['country_area_address_one_custom_id']){
      $country_area_address_one_custom_id = $_COOKIE['country_area_address_one_custom_id'];
    }else{
      $country_area_address_one_custom_id = 0;
    }
  }

  if($request->has('country_area_address_two_custom_id')){
    $country_area_address_two_custom_id = $request->get('country_area_address_two_custom_id');
    setcookie('country_area_address_two_custom_id',$request->get('country_area_address_two_custom_id'));
  }elseif(!isset($country_area_address_two_custom_id)){
    if(isset($_COOKIE['country_area_address_two_custom_id']) and $_COOKIE['country_area_address_two_custom_id']){
      $country_area_address_two_custom_id = $_COOKIE['country_area_address_two_custom_id'];
    }else{
      $country_area_address_two_custom_id = 0;
    }
  }
  //logger('country_area_id2: '. $country_area_id);
  $country_area_id    = (int)$country_area_id;
  //logger('country_area_id3: '. $country_area_id);
  
  $country_area_address_one_custom_id = (int)$country_area_address_one_custom_id;
  $country_area_address_two_custom_id = (int)$country_area_address_two_custom_id;

  $GLOBALS['country_area_id'] = $country_area_id;
  $GLOBALS['country_area_address_one_id'] = $country_area_address_one_custom_id;
  $GLOBALS['country_area_address_two_id'] = $country_area_address_two_custom_id;
  
  //site_latlon
  if($country_area_id){
    $tmp=Country_area::select('latitude','longitude')
      ->where('ken_id',$country_area_id)->first();
    $site_latlon = $tmp->latitude . ',' . $tmp->longitude;
  }else{
    $site_latlon = '35.6697797,139.8135074';
  }


  if($country_area_id){
    $GLOBALS['country_area_name'] = Util::getCountryAreaName($country_area_id);
  }else{
    $GLOBALS['country_area_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_one_name'] = Util::getCountryAreaOneName($country_area_address_one_custom_id);
  }else{
    $GLOBALS['country_area_address_one_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_two_name'] = Util::getCountryAreaTwoName($country_area_address_two_custom_id);
  }else{
    $GLOBALS['country_area_address_two_name'] = '';
  }
  //logger('country_area_id5: '. $country_area_id);

  return View('SenMonTen.index_map', compact('contents','site_latlon'));
  
}






public function ajaxMapContents_new(Request $request, $service_name)
{

  $take_number = 300;
  $yoyaku_type_id     = $GLOBALS['yoyaku_type_id'];
  $yoyaku_type_tag_id = $GLOBALS['yoyaku_type_tag_id'];
  

  if($request->has('yoyaku_type_tag_id')){
    $yoyaku_type_tag_id = $request->get('yoyaku_type_tag_id');
    setcookie('yoyaku_type_tag_id',$request->get('yoyaku_type_tag_id'));
    $GLOBALS['yoyaku_type_tag_id'] = (int)$request->get('yoyaku_type_tag_id');
    $GLOBALS['yoyaku_type_tag_name'] = UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_id'], $GLOBALS['yoyaku_type_tag_id']);
  }

  if($request->has('country_area_id')){
    $country_area_id = $request->get('country_area_id');
    $country_area_address_one_custom_id = 0;
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_id',$request->get('country_area_id'));
    setcookie('country_area_address_one_custom_id',0);
    setcookie('country_area_address_two_custom_id',0);
  }elseif(isset($_COOKIE['country_area_id']) and $_COOKIE['country_area_id']){
    //logger('in2');
    $country_area_id = $_COOKIE['country_area_id'];
  }else{
    //logger('in3');
    setcookie('country_area_id',0);
    $country_area_id = 0;
    setcookie('country_area_address_one_custom_id',0);
    $country_area_address_one_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
    $country_area_address_two_custom_id = 0;
  }
  //logger('country_area_id10: '. $country_area_id);

  if($request->has('country_area_address_one_custom_id')){
    $country_area_address_one_custom_id = $request->get('country_area_address_one_custom_id');
    setcookie('country_area_address_one_custom_id',$request->get('country_area_address_one_custom_id'));
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
  }elseif(!isset($country_area_address_one_custom_id)){
    if(isset($_COOKIE['country_area_address_one_custom_id']) and $_COOKIE['country_area_address_one_custom_id']){
      $country_area_address_one_custom_id = $_COOKIE['country_area_address_one_custom_id'];
    }else{
      $country_area_address_one_custom_id = 0;
    }
  }

  if($request->has('country_area_address_two_custom_id')){
    $country_area_address_two_custom_id = $request->get('country_area_address_two_custom_id');
    setcookie('country_area_address_two_custom_id',$request->get('country_area_address_two_custom_id'));
  }elseif(!isset($country_area_address_two_custom_id)){
    if(isset($_COOKIE['country_area_address_two_custom_id']) and $_COOKIE['country_area_address_two_custom_id']){
      $country_area_address_two_custom_id = $_COOKIE['country_area_address_two_custom_id'];
    }else{
      $country_area_address_two_custom_id = 0;
    }
  }

  $country_area_id    = (int)$country_area_id;
  $country_area_address_one_custom_id = (int)$country_area_address_one_custom_id;
  $country_area_address_two_custom_id = (int)$country_area_address_two_custom_id;

  $GLOBALS['country_area_id'] = $country_area_id;
  $GLOBALS['country_area_address_one_id'] = $country_area_address_one_custom_id;
  $GLOBALS['country_area_address_two_id'] = $country_area_address_two_custom_id;
  
  if($country_area_id){
    $GLOBALS['country_area_name'] = Util::getCountryAreaName($country_area_id);
  }else{
    $GLOBALS['country_area_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_one_name'] = Util::getCountryAreaOneName($country_area_address_one_custom_id);
  }else{
    $GLOBALS['country_area_address_one_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_two_name'] = Util::getCountryAreaTwoName($country_area_address_two_custom_id);
  }else{
    $GLOBALS['country_area_address_two_name'] = '';
  }

  //logger('country_area_id: ' . $country_area_id);
  //logger('country_area_address_one_custom_id: ' . $country_area_address_one_custom_id);
  //logger('country_area_address_two_custom_id: ' . $country_area_address_two_custom_id);
  //logger('yoyaku_type_id: ' . $yoyaku_type_id);
  //logger('yoyaku_type_tag_id: ' . $yoyaku_type_tag_id);

  if($request->has('searchWords')){
    $searchWords = $request->get('searchWords');
   //logger('searchWords: ' . $searchWords);
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.station_name',
      'contents.station_distance',
      'contents.latitude',
      'contents.longitude',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.name', 'like', '%'.$searchWords.'%')
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id and $country_area_address_one_custom_id and $country_area_address_two_custom_id and $yoyaku_type_tag_id){
   //logger('all in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id, 1)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.country_area_address_two',$country_area_address_two_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id and $country_area_address_two_custom_id and $country_area_address_one_custom_id){
   //logger('2 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.country_area_address_two',$country_area_address_two_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id and $country_area_address_one_custom_id and $yoyaku_type_tag_id){
   //logger('3 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id, 1)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id and $country_area_address_one_custom_id){
    //logger('4 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id and $yoyaku_type_tag_id){
    //logger('5 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id,1)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($country_area_id){
    //logger('6 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }elseif($yoyaku_type_tag_id){
    //logger('7 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id,1)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }else{
    //logger('8 in');
    $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.country_area_address_other',
      'contents.latitude',
      'contents.longitude',
      'contents.station_name',
      'contents.station_distance',
      'contents.tell',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.description',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'contents.user_id'
    )
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.shop_down',0)
    ->where('contents.country_area_id',13)
    ->orderBy('contents.recommend_point', 'desc')
    ->orderBy('contents.recommend_number', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->take($take_number)
    ->get();
  }

  //logger($contents);
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

  }
  
  return json_encode($contents);

}















public function index(Request $request, $service_name)
{

  $yoyaku_type_id     = $GLOBALS['yoyaku_type_id'];
  $yoyaku_type_tag_id = $GLOBALS['yoyaku_type_tag_id'];

  if($request->has('yoyaku_type_tag_id')){
    $yoyaku_type_tag_id = $request->get('yoyaku_type_tag_id');
    setcookie('yoyaku_type_tag_id',$request->get('yoyaku_type_tag_id'));
    $GLOBALS['yoyaku_type_tag_id'] = (int)$request->get('yoyaku_type_tag_id');
    $GLOBALS['yoyaku_type_tag_name'] = UtilYoyaku::getNewContentTag($GLOBALS['yoyaku_type_id'], $GLOBALS['yoyaku_type_tag_id']);
  }

  if($request->has('orderBy')){
    $GLOBALS['orderBy'] = (int)$request->get('orderBy');
    if($request->get('orderBy')==1){
      $orderBy01 = 'contents.recommend_point';
      $orderBy02 = 'contents.recommend_number';
      $orderBy03 = 'contents.updated_at';
    }elseif($request->get('orderBy')==2){
      $orderBy01 = 'contents.updated_at';
      $orderBy02 = 'contents.recommend_point';
      $orderBy03 = 'contents.recommend_number';
    }
  }else{
    $GLOBALS['orderBy'] = 2;
    $orderBy01 = 'contents.updated_at';
    $orderBy02 = 'contents.recommend_point';
    $orderBy03 = 'contents.recommend_number';
  }

  $contents_tokyo = [];
  $contents_osaka = [];
  $contents_nagoya = [];
  $contents_fukuoka = [];

  if($request->has('country_area_id')){
   //logger('in1');
    $country_area_id = $request->get('country_area_id');
    $country_area_address_one_custom_id = 0;
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_id',$request->get('country_area_id'));
    setcookie('country_area_address_one_custom_id',0);
    setcookie('country_area_address_two_custom_id',0);
  }elseif(isset($_COOKIE['country_area_id']) and $_COOKIE['country_area_id']){
   //logger('in2');
    $country_area_id = $_COOKIE['country_area_id'];
  }else{
   //logger('in3');
    setcookie('country_area_id',0);
    $country_area_id = 0;
    setcookie('country_area_address_one_custom_id',0);
    $country_area_address_one_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
    $country_area_address_two_custom_id = 0;
  }

  if($request->has('country_area_address_one_custom_id')){
    $country_area_address_one_custom_id = $request->get('country_area_address_one_custom_id');
    setcookie('country_area_address_one_custom_id',$request->get('country_area_address_one_custom_id'));
    $country_area_address_two_custom_id = 0;
    setcookie('country_area_address_two_custom_id',0);
  }elseif(!isset($country_area_address_one_custom_id)){
    if(isset($_COOKIE['country_area_address_one_custom_id']) and $_COOKIE['country_area_address_one_custom_id']){
      $country_area_address_one_custom_id = $_COOKIE['country_area_address_one_custom_id'];
    }else{
      $country_area_address_one_custom_id = 0;
    }
  }

  if($request->has('country_area_address_two_custom_id')){
    $country_area_address_two_custom_id = $request->get('country_area_address_two_custom_id');
    setcookie('country_area_address_two_custom_id',$request->get('country_area_address_two_custom_id'));
  }elseif(!isset($country_area_address_two_custom_id)){
    if(isset($_COOKIE['country_area_address_two_custom_id']) and $_COOKIE['country_area_address_two_custom_id']){
      $country_area_address_two_custom_id = $_COOKIE['country_area_address_two_custom_id'];
    }else{
      $country_area_address_two_custom_id = 0;
    }
  }

  $country_area_id    = (int)$country_area_id;
  $country_area_address_one_custom_id = (int)$country_area_address_one_custom_id;
  $country_area_address_two_custom_id = (int)$country_area_address_two_custom_id;

  $GLOBALS['country_area_id'] = $country_area_id;
  $GLOBALS['country_area_address_one_id'] = $country_area_address_one_custom_id;
  $GLOBALS['country_area_address_two_id'] = $country_area_address_two_custom_id;
  
  if($country_area_id){
    $GLOBALS['country_area_name'] = Util::getCountryAreaName($country_area_id);
  }else{
    $GLOBALS['country_area_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_one_name'] = Util::getCountryAreaOneName($country_area_address_one_custom_id);
  }else{
    $GLOBALS['country_area_address_one_name'] = '';
  }
  if($country_area_address_one_custom_id){
    $GLOBALS['country_area_address_two_name'] = Util::getCountryAreaTwoName($country_area_address_two_custom_id);
  }else{
    $GLOBALS['country_area_address_two_name'] = '';
  }

  //logger('country_area_id: ' . $country_area_id);
  //logger('country_area_address_one_custom_id: ' . $country_area_address_one_custom_id);
  //logger('country_area_address_two_custom_id: ' . $country_area_address_two_custom_id);
  //logger('yoyaku_type_id: ' . $yoyaku_type_id);
  //logger('yoyaku_type_tag_id: ' . $yoyaku_type_tag_id);

  $pagination_number = 15;



  if($request->has('searchWords')){
    $searchWords = $request->get('searchWords');
   //logger('searchWords: ' . $searchWords);
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.name', 'like', '%'.$searchWords.'%')
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id and $country_area_address_one_custom_id and $country_area_address_two_custom_id and $yoyaku_type_tag_id){
   //logger('all in');
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
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id, 1)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.country_area_address_two',$country_area_address_two_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id and $country_area_address_two_custom_id and $country_area_address_one_custom_id){
   //logger('2 in');
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.country_area_address_two',$country_area_address_two_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id and $country_area_address_one_custom_id and $yoyaku_type_tag_id){
   //logger('3 in');
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
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id, 1)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id and $country_area_address_one_custom_id){
   //logger('4 in');
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.country_area_address_one',$country_area_address_one_custom_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id and $yoyaku_type_tag_id){
   //logger('5 in');
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
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id,1)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($country_area_id){
   //logger('6 in');
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }elseif($yoyaku_type_tag_id){
   //logger('7 in');
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
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id,1)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate($pagination_number);
  }else{
    //logger('8 in');
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate(4);

    $contents_tokyo = Contents::select(
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.country_area_id',13)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate(4);

    $contents_osaka = Contents::select(
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.country_area_id',27)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate(4);

    $contents_nagoya = Contents::select(
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.country_area_id',23)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate(4);

    $contents_fukuoka = Contents::select(
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
    ->where('contents.admin_open',1)
    ->where('contents.owner_open',1)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->where('contents.country_area_id',40)
    ->orderBy('contents.shop_down','asc')
    ->orderBy($orderBy01, 'desc')
    ->orderBy($orderBy02, 'desc')
    ->orderBy($orderBy03, 'desc')
    ->paginate(4);

  }
  

  if( $request->has('searchWords') ){
    $contents->appends([
      'searchWords' => $searchWords,
      'country_area_id' => $country_area_id,
      'country_area_address_one_custom_id' => $country_area_address_one_custom_id,
      'country_area_address_two_custom_id' => $country_area_address_two_custom_id,
      'yoyaku_type_tag_id' => $yoyaku_type_tag_id,
      'orderBy' => $GLOBALS['orderBy']
    ])->links();
  }else{
    $contents->appends([
      'country_area_id' => $country_area_id,
      'country_area_address_one_custom_id' => $country_area_address_one_custom_id,
      'country_area_address_two_custom_id' => $country_area_address_two_custom_id,
      'yoyaku_type_tag_id' => $yoyaku_type_tag_id,
      'orderBy' => $GLOBALS['orderBy']
    ])->links();
  }

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

  if ($request->has('page') or $request->has('ajax')) {
    return json_encode(View::make('SenMonTen.include.search_contents_index', array('contents' => $contents))->render());
  }


  foreach($contents_tokyo as $key=>$content){
    $contents_tokyo[$key]['favo'] = Util::checkFavo($favo, $content->id);

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
    $contents_tokyo[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents_tokyo[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents_tokyo[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents_tokyo[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents_tokyo[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents_tokyo[$key]['content_tags'] = [];
    }

  }

  foreach($contents_osaka as $key=>$content){
    $contents_osaka[$key]['favo'] = Util::checkFavo($favo, $content->id);

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
    $contents_osaka[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents_osaka[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents_osaka[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents_osaka[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents_osaka[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents_osaka[$key]['content_tags'] = [];
    }

  }
  

  foreach($contents_nagoya as $key=>$content){
    $contents_nagoya[$key]['favo'] = Util::checkFavo($favo, $content->id);

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
    $contents_nagoya[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents_nagoya[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents_nagoya[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents_nagoya[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents_nagoya[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents_nagoya[$key]['content_tags'] = [];
    }

  }


  foreach($contents_fukuoka as $key=>$content){
    $contents_fukuoka[$key]['favo'] = Util::checkFavo($favo, $content->id);

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
    $contents_fukuoka[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents_fukuoka[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents_fukuoka[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents_fukuoka[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents_fukuoka[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents_fukuoka[$key]['content_tags'] = [];
    }

  }

  return View('SenMonTen.index', compact('contents','contents_tokyo','contents_osaka','contents_nagoya','contents_fukuoka'));
  
}









public function getStep(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $step_id = (int)$request->get('step_id');
  $step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $step_id);
  return $step;

}
public function getSteps(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  return $steps;

}






public function getMenu(Request $request, $service_name, $content_id)
{

  $content = Contents::select('service')->find($content_id);
  $menu_id = $request->get('menu_id');
  $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
  return $menu;

}



public function getMenuStep(Request $request, $service_name, $content_id)
{

  $content = Contents::select('service')->find($content_id);
  $menu_id = (int)$request->get('menu_id');
  $step_id = (int)$request->get('step_id');
  $step = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, $step_id);
  return $step;

}



public function getMenus(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service','user_id')->find($content_id);

  /*
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
  */

  $menus = Util::getContentMenu($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  if($content->service===62 or $content->service===69 or $content->service===101){
    foreach($menus as $key=>$menu){
      $menus[$key]['steps'] = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, null);
    }
  }
  //logger($menus);
  return $menus;

}




public function getCapacity(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('capacity_id'));
  return $capacity;

}




public function getCapacities(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service','user_id')->find($content_id);

  /*
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
  */

  $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  return $capacities;

}

public function getDateCapacities(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);
  if(!$content_date = Content_date::find($request->get('content_date_id'))) return ['err'=>1,'message'=>'must param'];
  $capacity_ids = json_decode($content_date->capacity_ids, true);
  return Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $capacity_ids, null);

}





public function getMedias(Request $request, $service_name, $content_id)
{

  $pics = [];
  $content = Contents::select('id','user_id','name','service','pic','back_pic')->find($content_id);

  if($content->pic){
    $pics[] = [
        'title'=>$content->name,
        'p250'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content_id, 250),
        'p1600'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), false, $content->pic, $content_id, 1600)
    ];
  }
  if($content->back_pic){
    $pics[] = [
        'title'=>$content->name,
        'p250'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content_id, 250),
        'p1600'=>Util::getPicContent(UtilYoyaku::getNewMenuSenMonTenKey($content->service), true, $content->back_pic, $content_id, 1600)
    ];
  }

  
  foreach(Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null) as $step){
    if($step->pic){
      $pics[] = [
        'title'=>'ポイント' . $step->element_number,
        'p250'=>'/storage/uploads/contents/' . $content->id . '/step/' . $step->id . '/' . Util::addFilename($step->pic,'250'),
        'p1600'=>'/storage/uploads/contents/' . $content->id . '/step/' . $step->id . '/' . Util::addFilename($step->pic,'160')
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
            'p250'=>Util::getPicCapa('capa', false, $val->pic,  $content->id, 250, $val->id),
            'p1600'=>Util::getPicCapa('capa', false, $val->pic,  $content->id, 1600, $val->id)
          ];
          }
        }
      }
  }
  
  if( !($content->service===39 or $content->service===85 or $content->service===89 or $content->service===91) ){
  //Util::getPicMenu($serviceToMenus, false, $menu->pic, $content->id, 250, $menu->id)
  $menus = Util::getContentMenu($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null, null);
  if(!empty($menus)){
    foreach($menus as $val){
      if($val->pic){
        $pics[] = [
          'title'=> $val->name,
          'p250'=>Util::getPicMenu(null, false, $val->pic, $content->id, 250, $val->id),
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
            'p250'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'250'),
            'p1600'=>'/storage/uploads/users/' . $val->user_id . '/recommend/' . $val->id . '/' . Util::addFilename($val->pic,'1600')
          ];
        }
      }
    }
  }
  
  return $pics;

}




public function getUseTimes(Request $request, $service_name, $content_id)
{
  
  $content_date = Content_date::find($request->get('content_date_id'));
  return $content_date;

}



public function getDateUsers(Request $request, $service_name, $content_id)
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

public function getDateOne(Request $request, $service_name, $content_id)
{

  $content_date = Content_date::find($request->get('content_date_id'));
  return $content_date;

}





public function getIframeCalendar(Request $request, $service_name, $content_id)
{

  $content = Contents::find($content_id);

  $company = Company::where('user_id',$content->user_id)->first();

  if( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91) ){
    if( !$content_calendar = Company_calendar::where('content_id', $content->id)->first() )
    {
      return View('SenMonTen.iframe.incomplete', compact('現在登録中です。'));
    }  
  }

  return View('SenMonTen.iframe.calendar', compact('content'));

}




public function getContentDesc(Request $request, $service_name, $content_id)
{

  $favo = Util::getFavo('contents');
  $content = Contents::find($content_id);
  $content['favo'] = Util::checkFavo($favo, $content->id);
  $owner = User::select('csv')->find($content->user_id);

  $content_calendar = null;
  $place = null;

  $contents = [];
  if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit'){
    $contents = Contents::where('user_id',$content->user_id)
      ->where('service',91)
      ->where('admin_open',1)
      ->where('owner_open',1)
      ->paginate(10);
    foreach($contents as $key=>$recruit){
      $contents[$key]['favo'] = Util::checkFavo($favo, $recruit->id);
  
      $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$recruit->id)->first();
      $contents[$key]['menu'] = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$recruit->id)->first();
      $contents[$key]['company'] = company::select('name')->where('user_id',$recruit->user_id)->first();
    }
  }
  
  if(!$place_owner = Place_owner_new::where('content_id',$content->id)->first()){
    $place_owner = new Place_owner_new;
  }

  if($owner->csv!==1){
    if( !($content->service===62 or $content->service===69 or $content->service===101 or $content->service===91) ){
      if( !$content_calendar = Company_calendar::where('content_id', $content->id)->first() )
      {
        return redirect('/yoyaku')->with('warning', 'しばらく経ってからアクセスしてください。');
      }  
    }
    $company = company::where('user_id',$content->user_id)->first();
  }else{
    $company = Itownpage::where('id',$content->itownpage_id)->first();
  }


  $recommends = Recommends::select(
      'recommends.id',
      'recommends.user_id',
      'recommends.table_name',
      'recommends.table_id',
      'recommends.owner_open',
      'recommends.admin_open',
      'recommends.recommend',
      'recommends.point',
      'recommends.pic',
      'recommends.good_number',
      'recommends.bad_number',
      'recommends.created_at',
      'recommends.updated_at',
      'users.name as user_name',
      'users.pic as user_pic'
    )
    ->join('users', 'users.id', '=', 'recommends.user_id')
    ->where('recommends.table_name','contents')
    ->where('recommends.table_id',$content->id)
    ->where('recommends.admin_open',1)
    ->orderBy('recommends.updated_at', 'desc')
    ->paginate(3);
    
  if ($request->has('page')) {
    return json_encode(View::make('include.recommend_more', array('recommends'=>$recommends,'content'=>$content))->render());
  }

  $content_recruit_types = [];
  $content_date_user = [];
  $content_menu_recruit = [];
  $user_recruit = [];
  $content_cancel_calendar = [];
  $content_tags = [];
  
  if($content->service===91){
    $content_recruit_types = Content_recruit_type::where('content_id',$content->id)->first();
    $content_menu_recruit = Content_menu_recruit::where('content_id',$content->id)->first();
    if( Auth::check() ){
      if(!$user_recruit = User_recruit::where('user_id',Auth::user()->id)->first()){
        $user_recruit = new User_recruit;
        $user_recruit->user_id = Auth::user()->id;
      }
      if(!$content_date_user=Content_date_users::where('content_id',$content->id)->where('user_id',Auth::user()->id)->first()){
        $content_date_user = new Content_date_users;
      }
    }else{
      $user_recruit = new User_recruit;
      $content_date_user = [];
    }
  }else{
    if($owner->csv!==1){
      $content_cancel_calendar = Content_cancel_calendar::where('content_id',$content->id)->first();
    }
    $content_tags = Content_tags::where('content_id',$content->id)->first();
  }

/*
  DB::table('station_line')
  ->select('station_line.line_name')
  ->join('stations', 'stations.line_cd', '=', 'station_line.id')
  ->where('stations.id',$content->station_id)
  ->first();
*/

  $stations = DB::table('contents_stations')
    ->select(
      'stations.station_name',
      'station_line.line_name',
      'contents_stations.station_distance'
    )
    ->join('stations', 'stations.id', '=', 'contents_stations.station_id')
    ->join('station_line', 'stations.line_cd', '=', 'station_line.id')
    ->where('contents_stations.content_id',$content->id)
    ->orderBy('contents_stations.station_distance','asc')
    ->take(3)
    ->get();

  $content['steps'] = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  
  return View('SenMonTen.contentDesc', compact('content','recommends','content_calendar','company','content_cancel_calendar','content_tags','content_recruit_types','content_menu_recruit','user_recruit','content_date_user','place_owner','contents','owner','stations'));

}






public function getContentMenuDesc(Request $request, $service_name, $content_id, $menu_id)
{

  $favo = Util::getFavo('contents');
  $content = Contents::find($content_id);
  $content['favo'] = Util::checkFavo($favo, $content->id);
  $owner = User::select('csv')->find($content->user_id);
  $contents = [];

  $contentMenuDesc = true;

  if( !($content->service===62 or $content->service===69 or $content->service===101) ){
    if( !$content_calendar = Company_calendar::where('content_id', $content->id)->first() )
    {
      return redirect('/')->with('warning', 'しばらく経ってからアクセスしてください。');
    }  
  }

  $recommends_number = Recommends::where('table_name','contents')
    ->where('table_id',$content->id)
    ->where('admin_open',1)
    ->count();

  $place_owner = Place_owner_new::where('content_id',$content->id)->first();

  $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
  $menu['steps'] = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, null);
  
  return View('SenMonTen.contentDesc', compact('content','menu','contentMenuDesc','recommends_number','place_owner','owner','contents'));

}





public function getDate(Request $request, $service_name, $content_id)
{

  $content = Contents::select('id','service')->find($content_id);

  Content_date::where('content_id',$content_id)
    ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-2 day')))
    ->where('end', '<', date('Y-m-d H:i:s'))
    ->update(['status'=>9]);
    
  // axios
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date = Content_date::where('content_id',$content_id)
      ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(1000)->get()
  ){
    foreach($content_date as $key=>$val){
      if($val->status>=1 and $val->status<=3 ){
        if($content->service===62 or $content->service===69 or $content->service===101){
          $menu_ids = json_decode($val->menu_ids,true);
          $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_ids[0]);
          $content_date[$key]['title'] .= $menu->name;
        }
        $content_date[$key]['title'] .= Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
        if($val->percent and $val->percent<100){
          $content_date[$key]['title'] = '割引' . $content_date[$key]['title'];
          $content_date[$key]['color'] = '#FF5722';
        }
      }else{
        $content_date[$key]['title'] = Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
      }
      if($val->to_tour >= 1){
        $content_date[$key]['to_tour_name'] = Util::getCountryAreaName($val->to_tour);
      }
      if($val->from_tour >= 1){
        $content_date[$key]['from_tour_name'] = Util::getCountryAreaName($val->from_tour);
      }
    }
  }else{
    $content_date = new Content_date;
  }
  //logger($content_date);
  return $content_date;
  
}


public function getDateMenu(Request $request, $service_name, $content_id, $menu_id)
{

  $content = Contents::select('id','service')->find($content_id);

  Content_date::where('content_id',$content_id)
    ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-2 day')))
    ->where('end', '<', date('Y-m-d H:i:s'))
    ->update(['status'=>9]);
    
  // axios
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_date = Content_date::where('content_id',$content_id)
        ->where('menu_ids', '=', '['.$menu_id.']')
        ->where('start', '>=', date('Y-m-d H:i:s', strtotime('-3 day')))
        ->where('start', '<=', $last_day)
        ->orderBy('start', 'asc')
        ->take(1000)->get()
  ){
    foreach($content_date as $key=>$val){
      if($val->status>=1 and $val->status<=3 ){
        if($content->service===62 or $content->service===69 or $content->service===101){
          $menu_ids = json_decode($val->menu_ids,true);
          $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_ids[0]);
          $content_date[$key]['title'] .= $menu->name;
        }
        $content_date[$key]['title'] .= Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
        if($val->percent and $val->percent<100){
          $content_date[$key]['title'] = '割引' . $content_date[$key]['title'];
          $content_date[$key]['color'] = '#FF5722';
        }
      }else{
        $content_date[$key]['title'] = Util::getContentDateStatus($val->status,'name',null);
        $content_date[$key]['color'] = Util::getContentDateStatus($val->status,'color',null);
      }
      if($val->to_tour >= 1){
        $content_date[$key]['to_tour_name'] = Util::getCountryAreaName($val->to_tour);
      }
      if($val->from_tour >= 1){
        $content_date[$key]['from_tour_name'] = Util::getCountryAreaName($val->from_tour);
      }
    }
  }else{
    $content_date = new Content_date;
  }
  return $content_date;
  
}




public function getMenuIds(Request $request, $service_name, $content_id)
{

  // axios
  $content = Contents::select('service')->find($content_id);
  $ids = json_decode($request->get('ids'),true);
  $content_menus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $ids, null);
  return $content_menus;
}

public function getMenusSelect(Request $request, $service_name, $content_id)
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
public function getMenusSelectStay(Request $request, $service_name, $content_id)
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
public function getMenuSelect(Request $request, $service_name, $content_id)
{

  // axios
  $content = Contents::select('service')->find($content_id);
  if(!$content_date = Content_date::find((int)$request->get('id'))) return ['err'=>1, 'message'=>'must param'];
  $menus = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, json_decode($content_date->menu_ids, true), null);
  return $menus[0];

}



public function getContentChat(Request $request, $service_name)
{
  return View('SenMonTen.contentChat', compact(''));
}

public function getContentYoyaku(Request $request, $service_name)
{
  return View('SenMonTen.contentYoyaku', compact(''));
}

public function getContentConfime(Request $request, $service_name)
{
  return View('SenMonTen.contentConfime', compact(''));
}

public function getContentCompletion(Request $request, $service_name)
{
  return View('SenMonTen.contentCompletion', compact(''));
}














public function sitemap(Request $request, $service_name)
{

  $country_area = DB::table('country_area')->select('ken_id','name')->where('country_id',392)->get();
  return View('SenMonTen.cmn.sitemap', compact('country_area'));
  
}




public function sitemap_desc(Request $request, $service_name)
{
  
  if(!$request->get('country_area_id')){
    return redirect('/err404')->with('warning', 'ページが見つかりません。');
  }
  $country_area_id = (int)$request->get('country_area_id');
  $yoyaku_type_id = $GLOBALS['yoyaku_type_id'];
  $yoyaku_type_tag_id = (int)$request->get('yoyaku_type_tag_id');
  $country_area_name = Util::getCountryAreaName($country_area_id);
  $yoyaku_type_name = $GLOBALS['yoyaku_type_name'];
  $yoyaku_type_tag_name = '';

  if($yoyaku_type_tag_id){
    $yoyaku_type_tag_name = UtilYoyaku::getNewContentTag($yoyaku_type_id, $yoyaku_type_tag_id);
    $contents = Contents::select(
      'contents.id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name'
    )
    ->join('content_tags', 'contents.id', '=', 'content_tags.content_id')
    ->where('contents.admin_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('content_tags.tag' . $yoyaku_type_tag_id,1)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.country_area_id', 'asc')
    ->orderBy('contents.pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->get();
  }else{
    $contents = Contents::select(
      'contents.id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name'
    )
    ->where('contents.admin_open',1)
    ->where('contents.country_area_id',$country_area_id)
    ->where('contents.service',$yoyaku_type_id)
    ->where('contents.user_id','<>',1)
    ->where('contents.delete_flug',0)
    ->orderBy('contents.country_area_id', 'asc')
    ->orderBy('contents.pic', 'desc')
    ->orderBy('contents.updated_at', 'desc')
    ->get();
  }



  return View('SenMonTen.cmn.sitemap_desc', compact('contents','country_area_id','yoyaku_type_id','yoyaku_type_tag_id','country_area_name','yoyaku_type_name','yoyaku_type_tag_name'));
  
}







public function getRequestEditContent(Request $request, $service_name)
{

  $yoyaku_type_id = UtilYoyaku::getNewMenuSenMonTenReverce($service_name);
  if(!$yoyaku_type_id) return redirect()->route('404');

  if(!Auth::check()){
    return redirect()->to('/login')->with("info","先にログインしてください。");
  }

  if(!$request->get('content_id')){
    return redirect()->back()->with("info","編集するコンテンツがみつかりません。");
  }
  $content = Contents::find((int)$request->get('content_id'));
  
  return View('SenMonTen.request.edit.content', compact('content'));

}

public function postRequestEditContent(Request $request, $service_name)
{

  $yoyaku_type_id = UtilYoyaku::getNewMenuSenMonTenReverce($service_name);
  if(!$yoyaku_type_id) return redirect()->route('404');

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















public function yoyakuHeaderUpdate(Request $request, $service_name)
{

  $yoyaku_type_id     = $GLOBALS['yoyaku_type_id'];
  $yoyaku_type_tag_id = $GLOBALS['yoyaku_type_tag_id'];
  $ans = [];

  if($request->get('country_area_id')){
    $country_area_id = $request->get('country_area_id');
    $tmp = DB::table('country_area')->select('name')->where('ken_id',$request->get('country_area_id'))->first();
    $ans['search_country_area_name'] = $tmp->name;
    $ans['search_country_area_address_one_name'] = 'すべて';
    $ans['search_country_area_address_two_name'] = 'すべて';
  }elseif(isset($_COOKIE['country_area_id']) and $_COOKIE['country_area_id']){
    $tmp = DB::table('country_area')->select('name')->where('ken_id',$_COOKIE['country_area_id'])->first();
    $ans['search_country_area_name'] = $tmp->name;
  }else{
    $ans['search_country_area_name'] = 'すべて';
    $ans['search_country_area_address_one_name'] = 'すべて';
    $ans['search_country_area_address_two_name'] = 'すべて';
  }

  //search_country_area_address_one_name
  if($request->get('country_area_address_one_custom_id')){
    $tmp = DB::table('city_address')->select('city_name')->where('city_id',$request->get('country_area_address_one_custom_id'))->first();
    $ans['search_country_area_address_one_name'] = $tmp->city_name;
  }elseif(!isset($ans['search_country_area_address_one_name'])){
    if(isset($_COOKIE['country_area_address_one_custom_id']) and $_COOKIE['country_area_address_one_custom_id']){
      $tmp = DB::table('city_address')->select('city_name')->where('city_id',$_COOKIE['country_area_address_one_custom_id'])->first();
      $ans['search_country_area_address_one_name'] = $tmp->city_name;
    }else{
      $ans['search_country_area_address_one_name'] = 'すべて';
    }
  }
  
  //search_country_area_address_one_name
  if($request->get('country_area_address_two_custom_id')){
    $tmp = DB::table('town_address')->select('town_name')->where('town_id',$request->get('country_area_address_two_custom_id'))->first();
    $ans['search_country_area_address_two_name'] = $tmp->town_name;
  }elseif(!isset($ans['search_country_area_address_two_name'])){
    if(isset($_COOKIE['country_area_address_two_custom_id']) and $_COOKIE['country_area_address_two_custom_id']){
      $tmp = DB::table('town_address')->select('town_name')->where('town_id',$_COOKIE['country_area_address_two_custom_id'])->first();
      $ans['search_country_area_address_two_name'] = $tmp->town_name;
    }else{
      $ans['search_country_area_address_two_name'] = 'すべて';
    }
  }

  //search_yoyaku_type_tag_name
  if($request->get('yoyaku_type_tag_id')){
    $ans['search_yoyaku_type_tag_name'] = UtilYoyaku::getNewContentTag($yoyaku_type_id,$request->get('yoyaku_type_tag_id'));
  }else{
    $ans['search_yoyaku_type_tag_name'] = 'すべて';
  }
  return $ans;

}












public function getRegister(Request $request, $service_name)
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
    ->where('contents.user_id',1)
    ->where('contents.service',$GLOBALS['yoyaku_type_id'])
    ->paginate(1);
    
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

  return View::make('SenMonTen.register', compact('contents','company','company_code','owner_services'));

}





}


