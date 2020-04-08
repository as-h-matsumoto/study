<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;

use App\models\Content_capacity_stay;

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

class OwnerContentsCapacityStayController extends Controller {

public function __construct()
{

}




function validation($request, $id){
  if(!$request->get('name')) return ['err'=>1, 'message'=>'お名前を入力してください。'];
  if(!$request->get('type')) return ['err'=>1, 'message'=>'タイプを選んでください。'];
  if(!$request->get('person')) return ['err'=>1, 'message'=>'何名様用を選択してください。'];
  if(!$request->get('area')) return ['err'=>1, 'message'=>'広さを入力してください。'];
  //if(!$request->get('height')) return ['err'=>1, 'message'=>'高さを入力してください。'];
  if(!$request->get('number')) return ['err'=>1, 'message'=>'数を入力してください。'];
  if( $request->get('person') > 999999 ) return ['err'=>1, 'message'=> '許容人数が多すぎます。']; 
  if( $request->get('number') > 999999 ) return ['err'=>1, 'message'=> '数が多すぎます。']; 
  if( $request->get('area') > 999999 ) return ['err'=>1, 'message'=> '広さが大きすぎます。']; 
  if( $request->get('height') > 999999 ) return ['err'=>1, 'message'=> '高さが大きすぎます。']; 
  if( mb_strlen($request->get('description')) > 2000) return ['err'=>1, 'message'=> '概要は2000文字以内で入力ください。']; 

  $type = (int)$request->get('type');
  $use_only_public = ($request->get('use_only_public')) ? (int)$request->get('use_only_public') : 0;
  $price = ( $request->get('price') ) ? (int)$request->get('price') : 0;
  //logger('$type: ' . $type);
  //logger('$use_only_public: ' . $use_only_public);
  //logger('$price: ' . $price);
  if($type===2 and $use_only_public===1 and $price<=0) return ['err'=>1, 'message'=>'宿泊者以外も利用できる施設は料金を設定してください。'];
  if($type===2){
    //logger('in type');
    if($use_only_public===1){
      //logger('in use_only_public');
      if($price<=0){
        //logger('in price');
      }
    }
  }
  

  $count = Content_capacity_stay::where('content_id',$id)->count();
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

  $capacity = new Content_capacity_stay;
  $capacity->content_id = $id;
  
  $capacity->name = $request->get('name');
  $capacity->type = (int)$request->get('type');

  $capacity->use_only_public = ($request->get('use_only_public')) ? $request->get('use_only_public') : 0;
  $capacity->price_stay = ($request->get('price_stay')) ? $request->get('price_stay') : 0;

  $capacity->person = (int)$request->get('person');
  $capacity->area = $request->get('area');
  $capacity->height = ($request->get('height')) ? $request->get('height') : 0;

  $capacity->yoji = ( $request->has('yoji') ) ? 1 : 0;
  $capacity->baby = ( $request->has('baby') ) ? 1 : 0;
  $capacity->nonesmoking = ( $request->has('nonesmoking') ) ? 1 : 0;
  $capacity->bus = ( $request->has('bus') ) ? 1 : 0;
  $capacity->toilet = ( $request->has('toilet') ) ? 1 : 0;
  $capacity->hotspring = ( $request->has('hotspring') ) ? 1 : 0;
  $capacity->refrigerator = ( $request->has('refrigerator') ) ? 1 : 0;
  $capacity->tv = ( $request->has('tv') ) ? 1 : 0;
  $capacity->net = ( $request->has('net') ) ? 1 : 0;
  $capacity->price = ( $request->get('price') ) ? (int)$request->get('price') : 0;
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
  Utilowner::addCapacityTagstay($capacity->content_id);
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

  if(!$capacity = Content_capacity_stay::find($request->get('capa_id'))) return ['err'=>1, 'message'=>'設備がみつかりません。'];

  $capacity->name = $request->get('name');
  $capacity->type = (int)$request->get('type');

  $capacity->use_only_public = ($request->get('use_only_public')) ? $request->get('use_only_public') : 0;
  $capacity->price_stay = ($request->get('price_stay')) ? $request->get('price_stay') : 0;

  $capacity->person = (int)$request->get('person');
  $capacity->area = $request->get('area');
  $capacity->height = ($request->get('height')) ? $request->get('height') : 0;

  $capacity->kids = ( $request->has('kids') ) ? 1 : 0;
  $capacity->yoji = ( $request->has('yoji') ) ? 1 : 0;
  $capacity->baby = ( $request->has('baby') ) ? 1 : 0;
  $capacity->nonesmoking = ( $request->has('nonesmoking') ) ? 1 : 0;
  $capacity->bus = ( $request->has('bus') ) ? 1 : 0;
  $capacity->toilet = ( $request->has('toilet') ) ? 1 : 0;
  $capacity->hotspring = ( $request->has('hotspring') ) ? 1 : 0;
  $capacity->refrigerator = ( $request->has('refrigerator') ) ? 1 : 0;
  $capacity->tv = ( $request->has('tv') ) ? 1 : 0;
  $capacity->net = ( $request->has('net') ) ? 1 : 0;
  $capacity->price = ( $request->get('price') ) ? (int)$request->get('price') : 0;
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
  Utilowner::addCapacityTagstay($capacity->content_id);
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