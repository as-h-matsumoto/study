<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;

use App\models\Content_capacity_hairsalon;

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

class OwnerContentsCapacityHairsalonController extends Controller {

public function __construct()
{

}



function validation($request, $id){
  if(!$request->get('type')) return ['err'=>1, 'message'=>'タイプを選んでください。'];
  if(!$request->get('number') ) return ['err'=>1, 'message'=>'席数を入力してください。']; 
  if( $request->get('number') > 999999 ) return ['err'=>1, 'message'=> '席数が多すぎます。']; 
  if( mb_strlen($request->get('description')) > 2000) return ['err'=>1, 'message'=> '概要は2000文字以内で入力ください。']; 
  $count = Content_capacity_hairsalon::where('content_id',$id)->count();
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

  $capacity = new Content_capacity_hairsalon;
  $capacity->content_id = $id;

  $capacity->type = (int)$request->get('type');
  $capacity->private = ( $request->has('private') ) ? 1 : 0;
  $capacity->number = (int)$request->get('number');
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
  $capacities = Utilowner::addCapacityTaghairsalon($capacity->content_id);

  return ['capacity'=>$capacity, 'ans'=>0];

}





public function postCapacityEdit(Request $request, $id)
{

  $ans = $this->validation($request, $id);
  if($ans['err']) return $ans;

  if(!$capacity = Content_capacity_hairsalon::find($request->get('capa_id'))) return ['err'=>1, 'message'=>'設備がみつかりません。'];

  $capacity->type = (int)$request->get('type');
  $capacity->private = ( $request->has('private') ) ? 1 : 0;
  $capacity->number = (int)$request->get('number');
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
  $capacities = Utilowner::addCapacityTaghairsalon($capacity->content_id);

  if(Utilowner::checkUsedCapacity($capacity)){
    $capacity->number = $request->get('number');
    $capacity->save();
    return ['err'=>2, 'title'=>'一部変更完了' ,'message'=>'このスペースのご利用予定の方には変更前のサービスを提供いただくか、ご理解いただけるようにご説明お願いいたします。'];
  }else{
    return ['capacity'=>$capacity, 'ans'=>0];
  }

}















}