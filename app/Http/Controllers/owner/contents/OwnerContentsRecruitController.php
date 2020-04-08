<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Contents;

use App\models\Content_date_users;
use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;


use App\models\company;


use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsRecruitController extends Controller {


public function __construct()
{

}








public function index(Request $request, $id)
{

  $content = Contents::find($id);
  
  if(!$content_menu = Content_menu_recruit::select('id')->where('content_id',$id)->first()){
    $to = '/owner/contents/' . $id . '/menu/edit';
    return redirect($to)->with('warning', '先に「面接内容」を登録してください。');
  }

  $content_date_users = Contents::select(
    'content_date_users.id',
    'content_date_users.recruit_status_id',
    'content_date_users.recruit_status_id',
    'content_date_users.recruit_entry_job',
    'content_date_users.recruit_saiyo_type',
    'content_date_users.user_recruit'
  )
  ->join('content_date_users', 'content_date_users.content_id', '=', 'contents.id')
  ->where('contents.user_id',Utilowner::getOwnerId())
  ->where('contents.service',91)
  ->orderBy('content_date_users.created_at', 'desc')
  ->paginate(25);

  foreach($content_date_users as $key=>$content_recruit){
    //$contents_recruit[$key]['favo'] = Util::checkFavo($favo, $content_recruit->id);
    //$content_date_users[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content_recruit->id)->first();
  }
  
  return View('owner.contents.recruit.index', compact('content','content_date_users'));

}




























public function getChangeStatus(Request $request, $id)
{

  $content_date_user_id = (int)$request->get('content_date_user_id');
  if(!$content_date_user = Content_date_users::find($content_date_user_id)){
    return ['err'=>1, 'message'=>'求人エントリーが見つかりません。'];
  }

  $content_menu_recruit = Content_menu_recruit::where('content_id',$id)->first();
  $steps = [];
  for ($i = 1; $i <= $content_menu_recruit->use_test_level; $i++) {
    $steps[$i] = ['step'.$i];
  }

  $option = '';
  foreach($steps as $key=>$step){
    if($key<=$content_date_user->recruit_status_id) continue;
    $option .= '<option value="'.$key.'">'.$key.'次面接</option>';
  }
  $option .= '<option value="9">採用</option>';
  $option .= '<option value="10">不採用</option>';
  
  return $option;

}



public function postChangeStatus(Request $request, $id)
{

  $content = Contents::select('id','name','service','user_id')->find($id);
  if(UtilYoyaku::getNewMenuSenMonTenSummary($content->service)!=='recruit') return ['err'=>1, 'おめでとうハッカー君'];

  $content_date_user_id = (int)$request->get('content_date_user_id');
  if(!$content_date_user = Content_date_users::find($content_date_user_id)){
    return ['err'=>1, 'message'=>'求人エントリーが見つかりません。'];
  }
  $new_step = (int)$request->get('status');
  if( !($new_step > $content_date_user->recruit_status_id and $new_step <=10) ){
    return ['err'=>1, 'message'=>'採用過程ステータスが不正です。'];
  }
  $old_step = $content_date_user->recruit_status_id;
  if($old_step===9 or $old_step===10) return ['err'=>1, 'message'=>'確定済みのため採用過程ステータスの変更はできません。'];

  $content_date_user->recruit_status_id = $new_step;
  $content_date_user->start = null;
  $content_date_user->end = null;
  $content_menu_recruit = Content_menu_recruit::select(Util::contentRecruitEntry($new_step,'key',null,null))->where('content_id',$id)->first();
  $column = Util::contentRecruitEntry($new_step,'key',null,null);
  $email = $content_menu_recruit->$column;

  $owner = User::find($content->user_id);
  $user = User::find($content_date_user->user_id);

  $yoyaku = '<a class="text-blue-500" href="/SenMonTen/求人/contents/'.$content->id.'/desc">面接予約受付</a>';
  $old_step = Util::contentRecruitEntry($old_step,'name',null,null);
  $new_step = Util::contentRecruitEntry($new_step,'name',null,null);
  $user_name = $user->name;

  $email = str_replace('$yoyaku', $yoyaku, $email);
  $email = str_replace('$old_step', $old_step, $email);
  $email = str_replace('$new_step', $new_step, $email);
  $email = str_replace('$user_name', $user_name, $email);

  $data = array(
    'user' => $user,
    'content' => $content,
    'owner' => $owner,
    'content_date_user' => $content_date_user,
    'email' => $email
  );
  Mail::send('emails.account.recruit.statusChange', $data, function ($m) use ($user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($user->email, $user->name);
    $m->subject('[Coordiy予約]求人エントリーについてご連絡です。');
  });
  Mail::send('emails.owner.recruit.statusChange', $data, function ($m) use ($owner) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($owner->email, $owner->name);
    $m->subject('[Coordiy予約]求人エントリーステータス変更控え');
  });

  $content_date_user->content_date_id = 0;
  $content_date_user->save();

  return [
    'status_id'=>$content_date_user->recruit_status_id,
    'status_name'=>Util::contentRecruitEntry($content_date_user->recruit_status_id,'name',null,null),
    'content_date_user_id'=>$content_date_user->id
  ];

}







}