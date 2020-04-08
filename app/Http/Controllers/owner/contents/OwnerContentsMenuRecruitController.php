<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\models\Contents;

use App\models\Content_tags;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_menu_recruit;
use App\models\Content_recruit_type;

use App\models\company;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsMenuRecruitController extends Controller {

public function __construct()
{

}





//validation
function validation($request, $id){
  $content = Contents::select('service')->find($id);
  if(!$request->get('use_test_level')) return ['err'=>1, 'message'=>'最大面接回数を選択してください。'];
  if(!$request->get('paper')) return ['err'=>1, 'message'=>'「書類選考エントリーの返答メール」を入力してください。'];
  if(!$request->get('adoption')) return ['err'=>1, 'message'=>'採用連絡メールを入力してください。'];
  if(!$request->get('rejection')) return ['err'=>1, 'message'=>'不採用連絡メールを入力してください。'];
  if(!$request->get('time')) return ['err'=>1, 'message'=>'面接時間を選んでください。'];
  if(!$request->get('recruit_type')) return ['err'=>1, 'message'=>'最低ひとつ、採用形態を選んでください。'];
  if(!$request->get('type')) return ['err'=>1, 'message'=>'最低ひとつ、募集職種を選んでください。'];
  $use_test_level = (int)$request->get('use_test_level');
  if( !($use_test_level>=1 and $use_test_level<=8) ) return ['err'=>1, 'message'=>'最大面接回数が不正です。'];
  if($use_test_level===8){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step4')) return ['err'=>1, 'message'=>'「4次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step4')) > 2000) return ['err'=>1, 'message'=> '「4次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step5')) return ['err'=>1, 'message'=>'「5次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step5')) > 2000) return ['err'=>1, 'message'=> '「5次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step6')) return ['err'=>1, 'message'=>'「6次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step6')) > 2000) return ['err'=>1, 'message'=> '「6次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step7')) return ['err'=>1, 'message'=>'「7次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step7')) > 2000) return ['err'=>1, 'message'=> '「7次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step8')) return ['err'=>1, 'message'=>'「8次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step8')) > 2000) return ['err'=>1, 'message'=> '「8次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===7){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step4')) return ['err'=>1, 'message'=>'「4次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step4')) > 2000) return ['err'=>1, 'message'=> '「4次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step5')) return ['err'=>1, 'message'=>'「5次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step5')) > 2000) return ['err'=>1, 'message'=> '「5次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step6')) return ['err'=>1, 'message'=>'「6次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step6')) > 2000) return ['err'=>1, 'message'=> '「6次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step7')) return ['err'=>1, 'message'=>'「7次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step7')) > 2000) return ['err'=>1, 'message'=> '「7次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===6){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step4')) return ['err'=>1, 'message'=>'「4次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step4')) > 2000) return ['err'=>1, 'message'=> '「4次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step5')) return ['err'=>1, 'message'=>'「5次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step5')) > 2000) return ['err'=>1, 'message'=> '「5次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step6')) return ['err'=>1, 'message'=>'「6次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step6')) > 2000) return ['err'=>1, 'message'=> '「6次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===5){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step4')) return ['err'=>1, 'message'=>'「4次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step4')) > 2000) return ['err'=>1, 'message'=> '「4次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step5')) return ['err'=>1, 'message'=>'「5次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step5')) > 2000) return ['err'=>1, 'message'=> '「5次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===4){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step4')) return ['err'=>1, 'message'=>'「4次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step4')) > 2000) return ['err'=>1, 'message'=> '「4次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===3){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step3')) return ['err'=>1, 'message'=>'「3次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step3')) > 2000) return ['err'=>1, 'message'=> '「3次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===2){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
    if(!$request->get('step2')) return ['err'=>1, 'message'=>'「2次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step2')) > 2000) return ['err'=>1, 'message'=> '「2次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  if($use_test_level===1){
    if(!$request->get('step1')) return ['err'=>1, 'message'=>'「1次面接のお願いメール」を入力してください。'];
    if( mb_strlen($request->get('step1')) > 2000) return ['err'=>1, 'message'=> '「1次面接のお願いメール」は2000文字以内で入力ください。']; 
  }
  return ['err'=>0];
}




public function postMenu(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  $ans = $this->validation($request, $id);
  if($ans['err']){ return back()->with('warning', $ans['message'])->withInput(); }

  if(!$menu = Content_menu_recruit::where('content_id',$id)->first()){
    $menu = new Content_menu_recruit;
    $menu->content_id = $id;
  }
  $menu->time = $request->get('time');
  $menu->use_test_level = (int)$request->get('use_test_level');
  //1:社員, 2:派遣, 3:バイト
  $menu->recruit_type_1 = 0;
  $menu->recruit_type_2 = 0;
  $menu->recruit_type_3 = 0;
  $type10100 = 0;
  $type10200 = 0;
  $type10300 = 0;
  $type10400 = 0;
  $type10500 = 0;
  $type10600 = 0;
  $type10700 = 0;
  $type10800 = 0;
  $type10900 = 0;
  $type11000 = 0;
  $type11100 = 0;
  $type11200 = 0;
  $type11300 = 0;
  $type11400 = 0;

  foreach($request->get('recruit_type') as $key=>$val){
    $column = 'recruit_type_' . (int)$val;
    $menu->$column = 1;
  }
  $menu->paper     = $request->get('paper');
  $menu->adoption  = $request->get('adoption');
  $menu->rejection = $request->get('rejection');
  $menu->step1 = $request->get('step1');
  $menu->step2 = $request->get('step2');
  $menu->step3 = $request->get('step3');
  $menu->step4 = $request->get('step4');
  $menu->step5 = $request->get('step5');
  $menu->step6 = $request->get('step6');
  $menu->step7 = $request->get('step7');
  $menu->step8 = $request->get('step8');
  $menu->save();

  if($content_recruit_types = Content_recruit_type::where('content_id',$id)->first() ){
    $content_recruit_types->delete();
  }
  $content_recruit_types = new Content_recruit_type;
  $content_recruit_types->content_id = $id;
  foreach($request->get('type') as $key=>$val){
    $column = 'type' . $val;
    $content_recruit_types->$column = 1;
    $summary_key = substr($val, 0, 3);
    $summary_key = (int)$summary_key.'00';
    switch ($summary_key){
      case 10100: $type10100 = 1; break;
      case 10200: $type10200 = 1; break;
      case 10300: $type10300 = 1; break;
      case 10400: $type10400 = 1; break;
      case 10500: $type10500 = 1; break;
      case 10600: $type10600 = 1; break;
      case 10700: $type10700 = 1; break;
      case 10800: $type10800 = 1; break;
      case 10900: $type10900 = 1; break;
      case 11000: $type11000 = 1; break;
      case 11100: $type11100 = 1; break;
      case 11200: $type11200 = 1; break;
      case 11300: $type11300 = 1; break;
      case 11400: $type11400 = 1; break;
    }
  }
  $content_recruit_types->save();

  // add capacity tags 
  if($content_tags = Content_tags::where('content_id',$content->id)->first()){
    $content_tags->delete();
  }
  $content_tags = new Content_tags;
  $content_tags->content_id = $content->id;
  $content_tags->tag1  = $type10100;
  $content_tags->tag2  = $type10200;
  $content_tags->tag3  = $type10300;
  $content_tags->tag4  = $type10400;
  $content_tags->tag5  = $type10500;
  $content_tags->tag6  = $type10600;
  $content_tags->tag7  = $type10700;
  $content_tags->tag8  = $type10800;
  $content_tags->tag9  = $type10900;
  $content_tags->tag10 = $type11000;
  $content_tags->tag11 = $type11100;
  $content_tags->tag12 = $type11200;
  $content_tags->tag13 = $type11300;
  $content_tags->tag14 = $type11400;
  $content_tags->tag30 = $menu->recruit_type_1;
  $content_tags->tag31 = $menu->recruit_type_2;
  $content_tags->tag32 = $menu->recruit_type_3;
  $content_tags->save();


  if(!$exist = DB::table('contents_check')->where('content_id',$content->id)->first()){
    DB::table('contents_check')->insert(['content_id'=>$content->id]);
  }

  //price put max, min price to content.
  return redirect('/owner/contents/' . $id . '/desc/edit')->with('success', '編集しました。');

}



public function getExampleEmail(Request $request, $id)
{
  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);

  $number = (int)$request->get('number');
  return Util::contentRecruitEntry($number,'email',$company,$content);
}







}