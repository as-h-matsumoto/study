<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\models\Contents;
use App\models\Content_recruit;
use App\models\Content_recruit_type;

use App\models\Content_date;
use App\models\Place;

use App\models\company;

use App\models\Content_menu_recruit;
use App\models\Content_menu_step_lesson;
use App\models\Content_menu_step_tour;
use App\models\Content_menu_step_ticket;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsMenuController extends Controller {

public function __construct()
{

}







//stepValidation
function stepValidation($request, $content_id){
  if(!$request->get('menu_id')) return ['err'=>1, 'message'=>'画面を読み込み直してお試しください。'];
  $menu_id = (int)$request->get('menu_id');
  $content = Contents::select('service')->find($content_id);
  $menu = Util::getContentMenu($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);

  if(!$request->get('title')) return ['err'=>1, 'message'=>'Gポイントタイトルを登録してください。'];
  if( mb_strlen($request->get('title')) > 40) return ['err'=>1, 'message'=> 'Gポイントタイトルは40文字以内で入力ください。']; 

  if(!$request->get('description')) return ['err'=>1, 'message'=>'ステップ詳細を登録してください。'];
  if( mb_strlen($request->get('description')) > 300) return ['err'=>1, 'message'=> '概要は300文字以内で入力ください。']; 

  $count = Util::getContentMenuStep($content_id, $content->service, $menu_id, null, true, null);
  if($count>10) return ['err'=>1, 'message'=>'ステップは10ステップまでです。'];
  $pic = $request->file('pic');
  if($pic){
    $pic_size = filesize($pic);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return ['err'=>1, 'message'=>'もっと大きな写真をアップしてください。'];
    if( $pic_size>20971520 ) return ['err'=>1, 'message'=>'20MByte以下の写真をアップしてください。'];
  }
  return ['err'=>0];
}





public function postMenuStepNew(Request $request, $id)
{  
  
  //$step_id = (int)$request->get('step_id');
  //if(!$request->get('step_id')) return ['err'=>1, 'message'=>'画面を読み込み直してお試しください。'];

  $content = Contents::select('id','service')->find($id);
  $ans = $this->stepValidation($request, $id );
  if($ans['err']){ return $ans; }

  $menu_id = (int)$request->get('menu_id');
  switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)) {
    case 'lesson': $step = new Content_menu_step_lesson; break;
    case 'tour': $step = new Content_menu_step_tour; break;
    case 'ticket': $step = new Content_menu_step_ticket; break;
  }
  
  $step->content_id = $id;
  $step->menu_id = $menu_id;
  $step->title = $request->get('title');
  $step->description = $request->get('description');
  $step->save();

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/menu/' . $menu_id . '/step/' . $step->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $step->pic = Util::formFileToImage($pic, $pic_path, null, $pic_name, $pic_type );  
  }
  $step->save();

  $steps = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, null);
  
  $element_number = 1;
  foreach($steps as $s){
    //$edit_step = Content_menu_step_lesson::find($s->id);
    $edit_step = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, $s->id);
    $edit_step->element_number = $element_number;
    $element_number++;
    $edit_step->save();
  }

  $steps = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, null);
  return $steps;

}



public function postMenuStepEdit(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  $ans = $this->stepValidation($request, $id);
  if($ans['err']){ return $ans; }

  $menu_id = (int)$request->get('menu_id');
  $step_id = (int)$request->get('step_id');
  if(!$request->get('step_id')) return ['err'=>1, 'message'=>'画面を読み込み直してもう一度お試しください。'];

  $step = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, $step_id);
  $step->title = $request->get('title');
  $step->description = $request->get('description');

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/menu/' . $menu_id . '/step/' . $step->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $step->pic = Util::formFileToImage($pic, $pic_path, $step->pic, $pic_name, $pic_type );  
  }
  $step->save();

  $steps = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, null);
  $element_number = 1;
  foreach($steps as $s){
    $edit_step = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, $s->id);
    $edit_step->element_number = $element_number;
    $element_number++;
    $edit_step->save();
  }

  $steps = Util::getContentMenuStep(null, $content->service, $menu_id, null, null, null);
  return $steps;

}

public function deleteMenuStep(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  if(!$menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('menu_id'))) return ['err'=>1,'message'=>'メニューが見つかりません。'];
  if(!$step = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, $request->get('step_id'))) return ['err'=>1,'message'=>'ステップが見つかりません。'];
  
  Util::deleteImage('/uploads/contents/' . $content->id . '/menu/' . $menu->id . '/step/' . $step->id . '/', $step->pic);
  $step->delete();

  $steps = Util::getContentMenuStep(null, $content->service, $menu->id, null, null, null);

  return $steps;

}





public function existMenuToDate(Request $request, $id)
{

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if($content_date = Content_date::select('id','lunch_ids')->where('content_id',$id)
  ->where('start', '>=', date('Y-m-d H:i:s'))
  ->where('start', '<=', $last_day)
  ->orderBy('start', 'asc')
  ->first())
  {
    $lunch = json_decode($content_date->lunch_ids,true);
    if($lunch){
      return 2;
    }else{
      return 1;
    }
  }else{
    return 0;
  }

}

public function postAddMenuToDate(Request $request, $id)
{

  $content = Contents::select('service')->find($id);

  if( !(
    $content->service===15 or
    $content->service===65 or
    $content->service===77 or
    $content->service===81 or
    $content->service===90
  ) ){
    return ['err'=>1,'message'=>'登録できないタイプのサービスです。'];
  }

  $menu_id = $request->get('menu_id');
  $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
  $action = $request->get('action');
  /* service === 1 
  addMenuToDateDo(1);" >ランチメニュー、通常メニューに追加</button><br />
  addMenuToDateDo(2);" >ランチメニューだけに追加</button><br />
  addMenuToDateDo(3);" >通常メニューだけに追加</button>
  else
  addMenuToDateDo(3);" >追加</button>
  */ 

  // axios
  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
      $content_dates = Content_date::select('id')
      ->where('content_id',$id)
      ->where('start', '>=', date('Y-m-d H:i:s'))
      ->where('start', '<=', $last_day)
      ->orderBy('start', 'asc')
      ->take(2000)->get()
  ){
    foreach($content_dates as $val){
      $content_date = Content_date::find($val->id);
      switch ($action) {
        case 1:
            $content_date = $this->addPublicMenu($content->service, $content_date, $menu);
            $content_date = $this->addLunchMenu($content->service, $content_date, $menu);
            break;
        case 2:
            $content_date = $this->addLunchMenu($content->service, $content_date, $menu);
            break;
        case 3:
            $content_date = $this->addPublicMenu($content->service, $content_date, $menu);
            break;
      }
      $content_date->save();
    }
  }

  return 'ok';

}
function addPublicMenu($service, $content_date, $menu)
{

  $menu_ids = json_decode($content_date->menu_ids,true);
  $menu_ids[] = $menu->id;
  $content_date->menu_ids = json_encode($menu_ids);
  $menus_summary = json_decode($content_date->menus_summary,true);
  $simultaneously = null;
  if($service===5 or $service===8 or $service===14 ) $simultaneously = $menu->simultaneously;
  //logger($menus_summary);
  $menus_summary[$menu->id] = [
      'id'=>$menu->id,
      'type'=>$menu->type,
      'number'=>$menu->number,
      'person'=>$menu->person,
      'price'=>$menu->price,
      'simultaneously'=>$simultaneously
  ];
  //logger($menus_summary);
  $content_date->menus_summary = json_encode($menus_summary);
  return $content_date;

}
function addLunchMenu($service, $content_date, $menu)
{

  $lunch_ids = json_decode($content_date->lunch_ids,true);
  $lunch_ids[] = $menu->id;
  $content_date->lunch_ids = json_encode($lunch_ids);
  $lunchs_summary = json_decode($content_date->lunchs_summary,true);
  $lunchs_summary[$menu->id] = [
    'id'=>$menu->id,
    'type'=>$menu->type,
    'number'=>$menu->number,
    'person'=>$menu->person,
    'price'=>$menu->price
  ];
  $content_date->lunchs_summary = json_encode($lunchs_summary);
  return $content_date;

}






public function getMenuEdit(Request $request, $id)
{
  
  $content = Contents::find($id);
  $company = company::where('user_id',$content->user_id)->first();

  if($content->service===39 or $content->service===85 or $content->service===89){
      $to = '/owner/contents/' . $content->id . '/discount/edit';
      return redirect($to);
  }else{
    if( !($content->service===62 or $content->service===69 or $content->service===101) ){
      if(!Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null)){
        $to = '/owner/contents/' . $content->id . '/capacity/edit';
        return redirect($to)->with('warning', '先に「' . UtilYoyaku::getNewContentCapacity($content->service) . '」を登録してください。');
      }
    }
  }

  if($content->service===91){
    if(!$content_recruit = Content_menu_recruit::where('content_id',$content->id)->first()){
      $content_recruit = new Content_recruit;
      $content_recruit->content_id = $id;
      $content_recruit->paper = Util::contentRecruitEntry(0,'email',$company,$content);
      $content_recruit->step1 = Util::contentRecruitEntry(1,'email',$company,$content);
      $content_recruit->step2 = Util::contentRecruitEntry(2,'email',$company,$content);
      $content_recruit->step3 = Util::contentRecruitEntry(3,'email',$company,$content);
      $content_recruit->step4 = Util::contentRecruitEntry(4,'email',$company,$content);
      $content_recruit->step5 = Util::contentRecruitEntry(5,'email',$company,$content);
      $content_recruit->step6 = Util::contentRecruitEntry(6,'email',$company,$content);
      $content_recruit->step7 = Util::contentRecruitEntry(7,'email',$company,$content);
      $content_recruit->step8 = Util::contentRecruitEntry(8,'email',$company,$content);
      $content_recruit->adoption = Util::contentRecruitEntry(9,'email',$company,$content);
      $content_recruit->rejection = Util::contentRecruitEntry(10,'email',$company,$content);
    }
    if(!$content_recruit_types = Content_recruit_type::where('content_id',$content->id)->first() ){
      $content_recruit_types = new Content_recruit_type;
    }
    return View('owner.contents.menu.menuEditRecruit', compact('content','company','content_recruit','content_recruit_types'));
  }else{
    return View('owner.contents.menu.menuEdit', compact('content','company'));
  }

}







public function deleteMenu(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  if(!$menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $request->get('menu_id'))) return ['err'=>1,'message'=>'メニューが見つかりません。'];

  Utilowner::deleteMenuToDate($content->id, $menu->id);
  
  //
  //use check to menu
  //-----------------
  $use = Utilowner::checkUseMenuToUser($content->id, $menu->id);
  if($use){
    $menu->delete_flug = 1;
    $menu->save();
    $ans = [
      'err'=>2,
      'title'=>'メニューを削除できませんでした。',
      'message'=> 'すでに「' . $menu->name . '」をご予約しているユーザ様がいるため削除できませんでした。ただし、現在予約受付中のスケジュールからはこのメニューを削除していますので、新規でこのメニューを予約することはできません。ご予約者がいなくなってから削除してください。'
    ];
    return $ans;
  }else{

    Util::deleteImage('/uploads/contents/' . $content->id . '/menu/' . $menu->id . '/', $menu->pic);
    $menu->delete();
    Utilowner::putMaxMinPriceToContent($content->id);
  
    return ['err'=>0,'message'=>'削除しました。'];
  }

}









public function postElementNumber(Request $request, $id)
{

  $content = Contents::select('service')->find($id);

  $capacities = $request->get('element_number');
  $count = 1;
  foreach($capacities as $val){
    $id = explode('menu', $val);
    $menu_id = (int)$id[1];
    //logger($menu_id);

    $menu = Util::getContentMenu(null, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, $menu_id);
    $menu->element_number = $count;
    $menu->save();

    $count++;
  }

  return 1;

}






}