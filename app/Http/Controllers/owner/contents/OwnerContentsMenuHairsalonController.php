<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_menu_hairsalon;

use App\models\company;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsMenuHairsalonController extends Controller {

public function __construct()
{

}





//validation
function validation($request, $id){
  $content = Contents::select('service')->find($id);
  if(!$request->get('name')) return ['err'=>1, 'message'=>'メニュー名を入力してください。'];
  if(!$request->get('type')) return ['err'=>1, 'message'=>'タイプを選択してください。'];
  if(!$request->get('price')) return ['err'=>1, 'message'=>'料金を入力してください。'];
  if(!$request->get('simultaneously')) return ['err'=>1, 'message'=>'同時施術人数を入力してください。'];
  if(!$request->get('time')) return ['err'=>1, 'message'=>'施術時間を入力してください。'];
  if( $request->get('price') > 99999999 ) return ['err'=>1, 'message'=> '料金が大きすぎます。']; 
  if( $request->get('simultaneously') > 99999 ) return ['err'=>1, 'message'=> '同時施術人数が大きすぎます。']; 
  if( mb_strlen($request->get('description')) > 2000) return ['err'=>1, 'message'=> '概要は2000文字以内で入力ください。']; 
  $count = Util::getContentMenu($id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null);
  if($count>250) return ['err'=>1, 'message'=>'上限。問合せ:admin@coordiy.com'];
  $pic = $request->file('pic');
  if($pic){
    $pic_size = filesize($pic);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return ['err'=>1, 'message'=>'もっと大きな写真をアップしてください。'];
    if( $pic_size>20971520 ) return ['err'=>1, 'message'=>'20MByte以下の写真をアップしてください。'];
  }
  return ['err'=>0];
}




public function postMenuNew(Request $request, $id)
{

  $ans = $this->validation($request, $id);
  if($ans['err']){ return $ans; }

  $menu = new Content_menu_hairsalon;
  $menu->content_id = $id;
  $menu->name = $request->get('name');
  $menu->type = $request->get('type');
  $menu->number = 9999;
  $menu->person = 1;
  $menu->simultaneously = ($request->get('simultaneously')) ? $request->get('simultaneously') : 1;
  $menu->price = $request->get('price');
  $menu->time = $request->get('time');
  $menu->description = $request->get('description');
  $menu->save();

  $pic = $request->file('formPic');
  if($pic){
    $pic_path = '/uploads/contents/' . $menu->content_id . '/menu/' . $menu->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $menu->pic = Util::formFileToImage($pic, $pic_path, null, $pic_name, $pic_type );  
  }
  $menu->save();

  //price put max, min price to content.
  Utilowner::putMaxMinPriceToContent($id);
  return ['menu'=>$menu, 'use'=>0];

}



public function postMenuEdit(Request $request, $id)
{

  $ans = $this->validation($request, $id);
  if($ans['err']){ return $ans; }
  
  if(!$menu = Content_menu_hairsalon::find((int)$request->get('modal-menu-id'))) return ['err'=>1, 'message'=>'メニューがみつかりません。'];
  $menu->name = $request->get('name');
  $menu->type = $request->get('type');
  $menu->simultaneously = ($request->get('simultaneously')) ? $request->get('simultaneously') : 1;
  $menu->price = $request->get('price');
  $menu->time = $request->get('time');
  $menu->description = $request->get('description');

  $pic = $request->file('formPic');
  if($pic){
    $pic_path = '/uploads/contents/' . $menu->content_id . '/menu/' . $menu->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $menu->pic = Util::formFileToImage($pic, $pic_path, $menu->pic, $pic_name, $pic_type );  
  }
  $menu->save();

  //price put max, min price to content.
  Utilowner::putMaxMinPriceToContent($id);
  Utilowner::editMenuToDate($id, $menu->id);
  
  $use = Utilowner::checkUseMenuToUser($id, $menu->id);
  return ['menu'=>$menu, 'use'=>$use];

}








}