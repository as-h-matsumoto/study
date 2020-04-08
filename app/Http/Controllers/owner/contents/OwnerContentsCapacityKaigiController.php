<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;

use App\models\Content_capacity_kaigi;

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

class OwnerContentsCapacityKaigiController extends Controller {

public function __construct()
{

}




function validation($request, $id){
  if(!$request->get('name')) return ['err'=>1, 'message'=>'会議室名を入力してください。'];
  if(!$request->get('price') ) return ['err'=>1, 'message'=>'料金を入力してください。']; 
  if(!$request->get('area') ) return ['err'=>1, 'message'=>'平米数を入力してください。']; 
  if(!$request->get('height') ) return ['err'=>1, 'message'=>'高さを入力してください。']; 
  if(!$request->get('number') ) return ['err'=>1, 'message'=>'会議室数を入力してください。']; 
  if(!$request->get('person') ) return ['err'=>1, 'message'=>'許容人数を入力してください。']; 
  if(!$request->get('time') ) return ['err'=>1, 'message'=>'利用時間を入力してください。'];
  if( $request->get('time') > 2880 ) return ['err'=>1, 'message'=> '利用時間は2880分以内で入力してください。'];
  if( $request->get('price') > 99999999 ) return ['err'=>1, 'message'=> '料金が高すぎます。'];
  if( $request->get('number') > 99999 ) return ['err'=>1, 'message'=> '数が多すぎます。']; 
  if( $request->get('area') > 999999 ) return ['err'=>1, 'message'=> '広さが大きすぎます。']; 
  if( $request->get('height') > 9999 ) return ['err'=>1, 'message'=> '高さが大きすぎます。']; 
  if( $request->get('person') > 999999 ) return ['err'=>1, 'message'=> '許容人数が大きすぎます。']; 
  if( $request->get('least_time') > 100 ) return ['err'=>1, 'message'=>'最低利用時間が大きすぎます。'];
  if( mb_strlen($request->get('description')) > 2000) return ['err'=>1, 'message'=> '概要は2000文字以内で入力ください。']; 
  $count = Content_capacity_kaigi::where('content_id',$id)->count();
  if($count>250) return ['err'=>1, 'message'=>'上限。問合せ:admin@coordiy.com'];
  $pic = $request->file('pic');
  if($pic){
    $pic_size = filesize($pic);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return ['err'=>1, 'message'=>'もっと大きな写真をアップしてください。'];
    if( $pic_size>20971520 ) return ['err'=>1, 'message'=>'20MByte以下の写真をアップしてください。'];
  }
}






public function postCapacityNew(Request $request, $id)
{

  $ans = $this->validation($request, $id);
  if($ans['err']) return $ans;

  $capacity = new Content_capacity_kaigi;
  $capacity->content_id = $id;

  $capacity->name = $request->get('name');
  $capacity->area = $request->get('area');
  $capacity->height = $request->get('height');
  $capacity->number = (int)$request->get('number');
  $capacity->person = (int)$request->get('person');
  $capacity->time = ( $request->has('time') ) ? (int)$request->get('time') : null;
  $capacity->price = ( $request->get('price') ) ? (int)$request->get('price') : 0;
  $capacity->least_time = ($request->get('least_time')) ? (int)$request->get('least_time') : 0 ;
  $capacity->description = $request->get('description');
  $capacity->save();

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/capacity/' . $capacity->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $capacity->pic = Util::formFileToImage($pic, $pic_path, $capacity->pic, $pic_name, $pic_type );  
  }
  $capacity->save();

  //add capacity to Contents table of data.
  Utilowner::addCapacityTagkaigi($capacity->content_id);
  
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::where('content_id',$id)
      ->select('id')
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->first()
  ){
    $ans = 2;
  }else{
    $ans = 0;
  }
  return ['capacity'=>$capacity, 'ans'=>$ans];

}





public function postCapacityEdit(Request $request, $id)
{

  $ans = $this->validation($request, $id);
  if($ans['err']) return $ans;

  if(!$capacity = Content_capacity_kaigi::find($request->get('capa_id'))) return ['err'=>1, 'message'=>'設備がみつかりません。'];

  $capacity->name = $request->get('name');
  $capacity->area = $request->get('area');
  $capacity->height = $request->get('height');
  $capacity->number = (int)$request->get('number');
  $capacity->person = (int)$request->get('person');
  $capacity->time = ( $request->has('time') ) ? (int)$request->get('time') : null;
  $capacity->price = ( $request->get('price') ) ? (int)$request->get('price') : 0;
  $capacity->least_time = ($request->get('least_time')) ? (int)$request->get('least_time') : 0 ;
  $capacity->description = $request->get('description');

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/capacity/' . $capacity->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $capacity->pic = Util::formFileToImage($pic, $pic_path, $capacity->pic, $pic_name, $pic_type );  
  }
  $capacity->save();

  //add capacity to Contents table
  Utilowner::addCapacityTagkaigi($capacity->content_id);
  Utilowner::editCapacityToDate($id, $capacity->id);
  if(Utilowner::checkUsedCapacity($capacity)){
    $capacity->number = $request->get('number');
    $capacity->save();
    return ['err'=>2, 'title'=>'一部変更完了' ,'message'=>'このスペースのご利用予定の方には変更前のサービスを提供いただくか、ご理解いただけるようにご説明お願いいたします。'];
  }else{
    return ['capacity'=>$capacity, 'ans'=>0];
  }

}











}