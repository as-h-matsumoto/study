<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Place_owner_new;

use App\models\Contents;
use App\models\Content_date;

use App\models\Content_menu_recruit;

use App\models\company;
use App\models\Company_calendar;
use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;

use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use Utilowner;
use UtilYoyaku;


class OwnerContentsCapacityController extends Controller {

public function __construct()
{

}









public function postCapacityDelete(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('capacity_id') );

  if(
    $content->service===15 or
    $content->service===39 or
    $content->service===65 or
    $content->service===77 or
    $content->service===90 or
    $content->service===81 or
    $content->service===85 or
    $content->service===89) Utilowner::deleteCapacityToDate($id, $capacity->id);
  if(Utilowner::checkUsedCapacity($capacity)){
    $capacity->delete_flug = 1;
    $capacity->save();
    $ans = [
      'err'=>2,
      'title'=>'削除できませんでした。',
      'message'=> 'こちらはご利用予定のユーザ様がいるため削除できませんでしたが、新規ご予約からはこちらを利用しないように登録しました。ご利用予定ユーザ様がいなくなってから削除してください。'
    ];
    return $ans;
  }

  $path = '/uploads/contents/' . $content->id . '/capacity/' . $capacity->id . '/';
  if( Util::deleteImage($path, $capacity->pic) ){
    $capacity->delete();
    //add capacity to Contents table
    //------------------------------
    $func_name = 'addCapacityTag' . UtilYoyaku::getNewMenuSenMonTenSummary($content->service);
    $capacities = Utilowner::$func_name($capacity->content_id);
    //end add capacity to Contents table
    //------------------------------
    return 'ok';
  }else{
    return [ 'err'=>1, 'message'=>'エラー。お問合せください。'];
  }

  return 'ok';
  
}


public function postAddCapacityToDate(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);

  if( 
    $content->service===69 or
    $content->service===101
  ){
    return ['err'=>1,'message'=>'登録できないタイプのサービスです。'];
  }

  $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('capacity_id') );

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::select('id')
      ->where('content_id',$id)
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)
      ->get()
  ){
    foreach($content_dates as $content_date){

      $content_date = Content_date::find($content_date->id);
      $capacity_ids = json_decode($content_date->capacity_ids,true);
      $capacity_ids[] = $capacity->id;
      $content_date->capacity_ids = json_encode($capacity_ids);
      $capacities_summary = json_decode($content_date->capacities_summary,true);
      $capacities_summary[$capacity->id] = [
        'id'=>$capacity->id,
        'type'=>$capacity->type,
        'number'=>$capacity->number,
        'person'=>$capacity->person,
        'price'=>$capacity->price
      ];
      $content_date->capacities_summary = json_encode($capacities_summary);
      $content_date->save();
    }
  }
  return 1;

}







public function getCapacityEdit(Request $request, $id)
{

  $content = Contents::find($id);

  $to='/owner/contents/' . $id . '/golist/edit';
  if(!$content->country_area_address_other)
  {
    return redirect($to)->with('warning', '先に「所在地」を登録してください。');
  }
  if(!$place_owner = Place_owner_new::where('content_id',$id)->first()){
    $place_owner = new Place_owner_new;
  }

  return View('owner.contents.capacity.singleEdit', compact('content','place_owner'));

}








public function getPlaceOwner(Request $request, $id)
{

  if(!$place_owner = Place_owner_new::where('content_id',$id)->first()){
    $place_owner = new Place_owner_new;
  }

  return $place_owner;

}


public function postPlaceOwner(Request $request, $id)
{

  $this->validate($request, [
    'pic'           => 'image',
    'description'   => 'max:1000',
    'name'          => 'max:255'
  ]);

  if( !$place_owner = Place_owner_new::where('content_id',$id)->first() ){
    $place_owner = new Place_owner_new;
    $place_owner->content_id = $id;
  }

  if($request->get('description')){$place_owner->description = $request->get('description');}
  if($request->get('parking')){$place_owner->parking = $request->get('parking');}
  if($request->get('name')){$place_owner->name = $request->get('name');}
  $place_owner->save();

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/place/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $place_owner->pic = Util::formFileToImage($pic, $pic_path, $place_owner->pic, $pic_name, $pic_type );  
  }
  $place_owner->save();

  return $place_owner;

}




public function postElementNumber(Request $request, $id)
{

  $content = Contents::select('service')->find($id);

  $capacities = $request->get('element_number');
  $count = 1;
  foreach($capacities as $val){
    $id = explode('capacity', $val);
    $capacity_id = (int)$id[1];
    //logger($capacity_id);

    $capacity = Util::getContentCapacityDesc(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $capacity_id);
    $capacity->element_number = $count;
    $capacity->save();

    $count++;
  }

  return 1;

}








}