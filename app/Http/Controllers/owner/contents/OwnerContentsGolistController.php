<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Contents;

use App\models\Content_capacity_food;
use App\models\Content_capacity_active;
use App\models\Content_capacity_lesson;
use App\models\Content_capacity_spasalon;
use App\models\Content_capacity_hairsalon;
use App\models\Content_capacity_stay;
use App\models\Content_capacity_studio;
use App\models\Content_capacity_kaigi;
use App\models\Content_capacity_recruit;
use App\models\Content_capacity_divination;


use App\models\company;
use App\models\Company_calendar;
use App\models\Country;
use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;


use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;
use DOMDocument;

class OwnerContentsGolistController extends Controller {

public function __construct()
{

}



public function getGolist(Request $request, $id)
{

}



public function getGolistEdit(Request $request, $id)
{
  
  $content = Contents::find($id);

  return View('owner.contents.golist.golistEditSingle', compact('content'));
  
}








public function postGolistEdit($id, Request $request)
{

  $this->validate($request, [
    'zip'                       => 'required|exists:ad_address,zip',
    'country_area_id'           => 'required|exists:country_area,ken_id',
    'country_area_address_one'  => 'required|exists:city_address,city_id',
    'country_area_address_two'  => 'required|exists:town_address,town_id',
    'country_area_address_other'=> 'required|min:1|max:500'
  ]);

  //Content Logic
  $content = Contents::find($id);

  $content->zip = $request->get('zip');
  $content->country_area_id = (int)$request->get('country_area_id');
  $content->country_area_address_one = (int)$request->get('country_area_address_one');
  $content->country_area_address_two = (int)$request->get('country_area_address_two');
  $content->country_area_address_other = $request->get('country_area_address_other');
  $ad_address = DB::table('ad_address')->where('town_id',$content->country_area_address_two)->first();
  $content->address = $ad_address->ken_name . $ad_address->city_name . $ad_address->town_name . $content->country_area_address_other;
  //logger($content);
  $content->save();





  //
  //latlng add 
  //
  $google_leapis_url = "https://maps.googleapis.com/maps/api/geocode/json";
  $country_area = Util::getCountryAreaName($content->country_area_id);
  $country_area_address_one = Util::getCountryAreaOneName($content->country_area_address_one);
  $country_area_address_two = Util::getCountryAreaTwoName($content->country_area_address_two);
  $other = DB::table('company')->where('user_id',$content->user_id)->first();
  $url_encode = rawurlencode($country_area . $country_area_address_one . $country_area_address_two . $other->country_area_address_other);

  $googleMapsApiData = json_decode(file_get_contents($google_leapis_url."?address=".$url_encode."&key=AIzaSyA6D8nAecIr1cvbbd-iqf2ctxk4RODCyJk", false), true);
  // 緯度経度を取得
  //logger($googleMapsApiData);

  $status = $googleMapsApiData["status"];
  //logger('content: ' . $content->id . ' googleMapsApiData status: ' . $status);
  if($status=='OK'){
    $lat    = $googleMapsApiData["results"][0]["geometry"]["location"]["lat"];
    $lng    = $googleMapsApiData["results"][0]["geometry"]["location"]["lng"];
    DB::table('contents')->where('id',$content->id)->update(['latitude'=>$lat,'longitude'=>$lng]);

    $content = Contents::find($content->id);
    $ad_address = DB::table('ad_address')->select('zip')->where('town_id',$content->country_area_address_two)->first();
    //logger($ad_address->zip);
    $stations = DB::table('stations')->select('id','station_name','lon','lat')->where('post','=',$ad_address->zip)->where('e_status',0)->get();
    if( empty($stations) ){
      $zip_edit = substr($ad_address->zip, 0, 3);
      //logger($zip_edit);
      $stations = DB::table('stations')->where('post','like',$zip_edit.'%')->where('e_status',0)->get();
      if( empty($stations) ){
        $zip_edit = substr($ad_address->zip, 0, 2);
        //logger($zip_edit);
        $stations = DB::table('stations')->where('post','like',$zip_edit.'%')->where('e_status',0)->get();
      }
    }

    if( !empty($stations) ){

      $lat1 = $content->latitude;
      $lon1 = $content->longitude;
      $ans = null;
      $station_id = null;
      $station_name = null;
      $mostleast = 99999999999999;
      foreach($stations as $k => $v){
        $lat2 = $v->lat;
        $lon2 = $v->lon;
        $long=Util::location_distance($lat1, $lon1, $lat2, $lon2);
        DB::table('contents_stations')->insert(['content_id'=>$content->id, 'station_id'=>$v->id, 'station_name'=>$v->station_name, 'station_distance'=>$long['distance']]);
        if($long['distance'] < $mostleast){
          $mostleast = $long['distance'];
          $station_id = $v->id;
          $station_name = $v->station_name;
        }
      }
  
      DB::table('contents')->where('id',$content->id)->update([
        'station_id'=>$station_id,
        'station_name'=>$station_name,
        'station_distance'=>$mostleast
      ]);

    }
  }elseif($status=='ZERO_RESULTS'){
    //logger('ZERO_RESULTS latlon: ' . $content->id);
  }else{
    //logger('dont get latlon: ' . $content->id);
  }


  /*
  //  capacityデフォルト登録処理  //
  */
  $this->createFirstCapacities($content->id, $content->service);
  
  if($content->calendar_flug){
    return redirect('/owner/contents/'.$content->id.'/capacity/edit')->with('info', '次に「'.UtilYoyaku::getNewContentCapacity($content->service).'」を登録してください。');
  }else{
    return redirect('/owner/contents/'.$content->id.'/top')->with('info', '所在地を変更しました。');
  }

  return $content->id;

}



function createFirstCapacities($id, $service){

  switch ($service) {
    case 15: //food
      if(!$exists = Content_capacity_food::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_food;
        $capacity->content_id = $id;
        $capacity->type = 1;
        $capacity->number = 4;
        $capacity->description = '素敵なカウンター席です。';
        $capacity->save();
    
        $capacity = new Content_capacity_food;
        $capacity->content_id = $id;
        $capacity->type = 2;
        $capacity->person = 4;
        $capacity->number = 2;
        $capacity->description = '素敵なテーブル席です。';
        $capacity->save();
      }
      break;
    case 39: //active
      if(!$exists = Content_capacity_active::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_active;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '小規模アクティブスペース';
        $capacity->price = 500;
        $capacity->person = 5;
        $capacity->number = 1;
        $capacity->description = '小規模なアクティブスペースです。';
        $capacity->save();
    
        $capacity = new Content_capacity_active;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '大規模アクティブスペース';
        $capacity->price = 500;
        $capacity->person = 30;
        $capacity->number = 1;
        $capacity->description = '大規模なアクティブスペースです。';
        $capacity->save();
      }
      break;
    case 100: //experience
      break;
    case 62: //lesson
      if(!$exists = Content_capacity_lesson::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_lesson;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '小規模レッスンスペース';
        $capacity->person = 5;
        $capacity->number = 1;
        $capacity->description = '小規模なレッスンスペースです。';
        $capacity->save();
    
        $capacity = new Content_capacity_lesson;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '大規模レッスンスペース';
        $capacity->person = 30;
        $capacity->number = 1;
        $capacity->description = '大規模なレッスンスペースです。';
        $capacity->save();
      }
      break;
    case 65: //spasalon
      if(!$exists = Content_capacity_spasalon::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_spasalon;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = 'プライベートスパスペース';
        $capacity->person = 1;
        $capacity->number = 1;
        $capacity->description = 'プライベートなスパスペースです。';
        $capacity->save();
    
        $capacity = new Content_capacity_spasalon;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '大規模スパスペース';
        $capacity->person = 30;
        $capacity->number = 1;
        $capacity->description = '大規模なスパペースです。';
        $capacity->save();
      }
      break;
    case 77: //hairsalon
      if(!$exists = Content_capacity_hairsalon::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_hairsalon;
        $capacity->content_id = $id;
        $capacity->type = 3;
        $capacity->private = 1;
        $capacity->number = 1;
        $capacity->description = 'プライベートなカットスペースです。';
        $capacity->save();
    
        $capacity = new Content_capacity_hairsalon;
        $capacity->content_id = $id;
        $capacity->type = 3;
        $capacity->number = 10;
        $capacity->description = 'スマートなカットスペースです。';
        $capacity->save();
      }
      break;
    case 81: //stay
      if(!$exists = Content_capacity_stay::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_stay;
        $capacity->content_id = $id;
        $capacity->type = 1;
        $capacity->name = 'ツインルーム';
        $capacity->number = 10;
        $capacity->area = 52.5;
        $capacity->height = 3.2;
        $capacity->person = 2;
        $capacity->nonesmoking = 1;
        $capacity->bus = 1;
        $capacity->toilet = 1;
        $capacity->refrigerator = 1;
        $capacity->tv = 1;
        $capacity->price = 8000;
        $capacity->description = '素敵なツインルームです。';
        $capacity->save();
    
        $capacity = new Content_capacity_stay;
        $capacity->content_id = $id;
        $capacity->type = 1;
        $capacity->name = 'ファミリールーム';
        $capacity->number = 4;
        $capacity->area = 82.5;
        $capacity->height = 3.2;
        $capacity->person = 4;
        $capacity->nonesmoking = 1;
        $capacity->bus = 1;
        $capacity->toilet = 1;
        $capacity->refrigerator = 1;
        $capacity->tv = 1;
        $capacity->price = 12000;
        $capacity->description = '素敵なファミリールームルームです。';
        $capacity->save();
      }
      break;
    case 85: //studio
      if(!$exists = Content_capacity_studio::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_studio;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '小規模スタジオ';
        $capacity->number = 2;
        $capacity->area = 52.5;
        $capacity->height = 3.2;
        $capacity->price = 10000;
        $capacity->description = '小規模なスタジオです。';
        $capacity->save();
    
        $capacity = new Content_capacity_studio;
        $capacity->content_id = $id;
        $capacity->type = 9;
        $capacity->name = '大規模スタジオ';
        $capacity->number = 2;
        $capacity->area = 82.5;
        $capacity->height = 3.2;
        $capacity->price = 16000;
        $capacity->description = '大規模なスタジオです。';
        $capacity->save();
      }
      break;
    case 89: //kaigi
      if(!$exists = Content_capacity_kaigi::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_kaigi;
        $capacity->content_id = $id;
        $capacity->name = '小規模会議室';
        $capacity->person = 6;
        $capacity->number = 4;
        $capacity->area = 22.5;
        $capacity->height = 3.2;
        $capacity->price = 6000;
        $capacity->description = '小規模な会議室です。';
        $capacity->save();
    
        $capacity = new Content_capacity_kaigi;
        $capacity->content_id = $id;
        $capacity->name = '大規模会議室';
        $capacity->person = 30;
        $capacity->number = 2;
        $capacity->area = 82.5;
        $capacity->height = 3.2;
        $capacity->price = 22000;
        $capacity->description = '大規模な会議室です。';
        $capacity->save();
      }
      break;
    case 91: //recruit
      if(!$exists = Content_capacity_recruit::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_recruit;
        $capacity->content_id = $id;
        $capacity->type = 0;
        $capacity->name = '面談Aルーム';
        $capacity->person = 10;
        $capacity->number = 1;
        $capacity->description = '10名向けの面談ルームです。';
        $capacity->save();
      }
      break;
    case 90: //uranai
      if(!$exists = Content_capacity_divination::select('id')->where('content_id',$id)->first()){
        $capacity = new Content_capacity_divination;
        $capacity->content_id = $id;
        $capacity->name = 'プライベート占いスペース';
        $capacity->person = 1;
        $capacity->number = 1;
        $capacity->description = 'プライベートな占いスペースです。';
        $capacity->save();
    
        $capacity = new Content_capacity_divination;
        $capacity->content_id = $id;
        $capacity->name = '大規模占いスペース';
        $capacity->person = 30;
        $capacity->number = 1;
        $capacity->description = '大規模な占いペースです。';
        $capacity->save();
      }
      break;
  }
}












}