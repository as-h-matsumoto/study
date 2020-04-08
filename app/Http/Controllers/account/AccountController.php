<?php namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;

use App\User;
use App\models\User_recruit;

use App\models\Messages;
use App\models\Messages_notread;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_cancel_calendar;

use App\models\Content_recruit_entry;
use App\models\Content_recruit_type;

use App\models\Learning;
use App\models\Learning_region;
use App\models\Learning_relation;
use App\models\License;
use App\models\License_examination_subject;
use App\models\License_question;
use App\models\License_question_contents;
use App\models\License_question_contents_answer;
use App\models\License_question_learning;
use App\models\License_question_literature;
use App\models\License_question_contents_learning;
use App\models\License_question_contents_literature;
use App\models\License_schedule;
use App\models\License_schedule_examination_subject;
use App\models\License_schedule_pass_rate;
use App\models\License_schedule_statistics;
use App\models\Literature;

use App\models\License_question_try_master;
use App\models\License_question_try_answer;
use App\models\License_question_try_score;

use App\models\Recommends;
use App\models\Recommends_pics;

use App\models\company;
use App\models\Rss_messages_user_month;

use App\models\Place_owner_new;

use Auth;
use Mail;
use DB;
use Redirect;
use Util;
use UtilYoyaku;
use Utilowner;
use View;
use DateTime;



use Illuminate\Http\Request;

class AccountController extends Controller {


public function __construct()
{
}








public function getSpeak()
{

  $rss_messages_user_month = Rss_messages_user_month::where('user_id',Auth::user()->id)->orderBy('date','desc')->take(100)->get();

  return View('account.speak.index', compact('rss_messages_user_month'));

}


public function postSupportContact(Request $request){

  //validation
  if( !$request->get('message') ) return ['err'=>1, 'message'=> 'メッセージを入力してください。']; 
  if( mb_strlen($request->get('message')) < 10) return ['err'=>1, 'message'=> 'メッセージが短すぎます。'];
  if( mb_strlen($request->get('message')) > 2000) return ['err'=>1, 'message'=> 'メッセージは2000文字以内で入力ください。']; 

  $auth_user = User::find(Utilowner::getOwnerId());
  $to_user = User::find(1);

  $message = new Messages;
  $message->user_id = $auth_user->id;
  $message->to_user_id = $to_user->id;
  $message->message = $request->get('message');
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();

  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>$auth_user->id,
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  $data = array(
    'to_user' => $to_user,
    'auth_user' => $auth_user,
    'words' => $message
  );
  Mail::send('emails.account.support.contact.toAdmin', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($to_user->email, $to_user->name);
    $m->subject('[Coordiy]カスタマーからお問合せが届いています。');
  });
  Mail::send('emails.account.support.contact.toOwner', $data, function ($m) use ($auth_user) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($auth_user->email, $auth_user->name);
    $m->subject('[Coordiy]お問合せを承りました。');
  });

  return ['err'=>0, 'message'=>'メッセージを送信しました。'];

}







public function getYoyaku()
{
  return redirect('/account/yoyaku/history');
}





public function getContentDateUser($content_date_user_id)
{

  $content_date_user = Content_date_users::find($content_date_user_id);
  $content = Contents::select('user_id')->find($content_date_user->content_id);

  return ['content_date_user'=>$content_date_user];

}



public function getYoyakuHistory(Request $request)
{

  $contents = Contents::select(
      'contents.id',
      'contents.service',
      'contents.country_area_id',
      'contents.country_area_address_one',
      'contents.country_area_address_two',
      'contents.name',
      'contents.price',
      'contents.pic',
      'contents.room_price',
      'contents.allUseNumber',
      'contents.recommend_number',
      'contents.recommend_point',
      'contents.good_number',
      'contents.bad_number',
      'content_date_users.recruit_status_id as recruit_status_id',
      'content_date_users.id as content_date_user_id',
      'content_date_users.goin as content_date_user_goin',
      'content_date_users.start',
      'content_date_users.end'
    )
    ->join('content_date_users', 'content_date_users.content_id', '=', 'contents.id')
    ->where('content_date_users.user_id',Utilowner::getOwnerId())
    ->whereIn('content_date_users.goin',[1,2,9])
    ->orderBy('content_date_users.start', 'desc')
    ->paginate(25);

  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);
    if($content->service===91){
      $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
    }
  }
    
  if ($request->has('page')) {
    return json_encode(View::make('include.search_contents_yoyaku_history', array('contents' => $contents))->render());
  }

  return View('account.yoyaku.history', compact('contents'));

}





public function getYoyakuHistoryDesc($content_date_user_id)
{

  $content_date_user = Content_date_users::find($content_date_user_id);
  
  $content = Contents::find($content_date_user->content_id);
  $favo = Util::getFavo('contents');
  $content['favo'] = Util::checkFavo($favo, $content->id);

  $company = company::where('user_id',$content->user_id)->first();
  if(!$place_owner = Place_owner_new::where('content_id',$content->id)->first()){
    $place_owner = new Place_owner_new;
  }

  return View('account.yoyaku.historyDesc', compact('content','content_date_user','company'));

}





public function getCancelStart($content_date_user_id)
{

  $content_date_user = Content_date_users::find($content_date_user_id);
  $content = Contents::find($content_date_user->content_id);
  $content_cancel_calendar = Content_cancel_calendar::where('content_id',$content->id)->first();

  $time    = new DateTime($content_date_user->end);
  $current = new DateTime('now');
  if($time < $current){
    return ['err'=>1, 'message'=>'このご予約は終了しています。'];
  }

  $DT_time = new DateTime($time->format('Y-m-d 00:00:00'));
  $DT_current = new DateTime($current->format('Y-m-d 00:00:00'));
  //logger('DT_time ' . $DT_time->format('Y-m-d 00:00:00'));
  //logger('DT_current ' . $DT_current->format('Y-m-d 00:00:00'));
  $diff    = $DT_current->diff($DT_time);
  if($diff->days===0){
    $calumn = 'today';
  }elseif($diff->days <= 15){
    $calumn = 'day' . $diff->d;
  }else{
    $calumn = null;
  }
  //logger('calumn: ' . $calumn);
  //logger('content_cancel_calendar->calumn: ' . $content_cancel_calendar->$calumn);
  $cancel_message = '';
  $cancel_message_sub = '';
  if($content_date_user->goin===2){
    if($calumn and $content_cancel_calendar->$calumn){
      $cancel_price = $content_date_user->payment_sum*($content_cancel_calendar->$calumn/100);
      $cancel_price = (int)$cancel_price;
      $cancel_message = '本日' . $current->format('Y年m月d日') . '、このご予約をキャンセルすると、次のキャンセル表のとおり、支払額の' . $content_cancel_calendar->$calumn . '%がキャンセル料となります。';
      if($content_cancel_calendar->$calumn===100){
        $cancel_message_sub = 'キャンセルによる返金はございません。';
      }else{
        $cancel_message_sub = 'キャンセルを行うと、現在の支払いは一度取り消され、キャンセル料の「&yen;' . (int)$cancel_price . '」がお支払額となります。';
      }
    }else{
      $cancel_message = '本日' . $current->format('Y年m月d日') . 'にこのご予約をキャンセルすると、次のキャンセル表のとおり、キャンセル料はかかりません。';
    }
  }else{
    $cancel_message = 'このご予約のキャンセル料などは一切ありません。';
    $content_cancel_calendar = null;
  }
  $ans = [
    'content_cancel_calendar'=>$content_cancel_calendar,
    'cancel_message'=>$cancel_message,
    'cancel_message_sub'=>$cancel_message_sub
  ];

  return $ans;

}





public function postCancelDone($content_date_user_id)
{

  $content_date_user = Content_date_users::find($content_date_user_id);
  if( !($content_date_user->goin===1 or $content_date_user->goin===2) ) return ['err'=>1, 'message'=>'ご予約がございません。'];
  $content = Contents::find($content_date_user->content_id);
  $content_date = Content_date::find($content_date_user->content_date_id);
  $content_cancel_calendar = Content_cancel_calendar::where('content_id',$content->id)->first();

  $time    = new DateTime($content_date_user->end);
  $current = new DateTime('now');
  if($time < $current){
    return ['err'=>1, 'message'=>'このご予約は終了しています。'];
  }
  
  //返金処理
  if($content_date_user->goin===2){

    $DT_time = new DateTime($time->format('Y-m-d 00:00:00'));
    $DT_current = new DateTime($current->format('Y-m-d 00:00:00'));
    //logger('DT_time ' . $DT_time->format('Y-m-d 00:00:00'));
    //logger('DT_current ' . $DT_current->format('Y-m-d 00:00:00'));
    $diff    = $DT_current->diff($DT_time);
    if($diff->days===0){
      $calumn = 'today';
    }elseif($diff->days <= 15){
      $calumn = 'day' . $diff->d;
    }else{
      $calumn = null;
    }

    if($content_cancel_calendar->$calumn===100){
      $content_date_user->cancel_price = $content_date_user->payment_sum;
      $content_date_user->goin=9;
      $content_date_user->save();
      UtilYoyaku::chengeStatus($content, $content_date);
      return ['err'=>0, 'message'=>'ご予約はキャンセルしました。'];
    }

    \Payjp\Payjp::setApiKey('sk_test_f62734f365fdf0a40536374b');
    if(!$content_date_user->payment_charge_id) return ['err'=>1, 'message'=>'支払い情報がみつかりません。'];
    $charge = \Payjp\Charge::retrieve($content_date_user->payment_charge_id);
    $cancel_price = 0;
    if($calumn and $content_cancel_calendar->$calumn){
      $cancel_price = $content_date_user->payment_sum*($content_cancel_calendar->$calumn/100);
      $cancel_price = (int)$cancel_price;
    }
    //logger($cancel_price);

    //全額返金
    if($cancel_price===0){
      try{
        $charge->refund();
      }catch(\Exception $e){
        //logger($e);
        return back()->with('warning', '取り消しエラー。問合せください。');
      }
      $content_date_user->cancel_price = 0;
      $content_date_user->goin=9;
      $content_date_user->save();
      UtilYoyaku::chengeStatus($content, $content_date);
      return ['err'=>0, 'message'=>'ご予約はキャンセルしました。'];
    }

    //キャンセル料支払い+全額返金
    $content_date_user->cancel_price = $cancel_price;
    try{
      $charge_cancel = \Payjp\Charge::create(array(
        "customer" => Auth::user()->payjp_customer_id,
        "card"     => $charge->card->id,
        "currency" => 'jpy',
        "amount"   => $content_date_user->cancel_price
      ));
      try{
        $charge->refund();
      }catch(\Exception $e){
        //logger($e);
        return ['err'=>1, 'message'=>'取り消しエラー。問合せください。'];
      }
    }catch(\Exception $e){
      //logger($e);
      return ['err'=>1, 'message'=>'キャンセル料エラー。問合せください。'];
    }
    $content_date_user->goin=9;
    $content_date_user->save();
    UtilYoyaku::chengeStatus($content, $content_date);
    return ['err'=>0, 'message'=>'ご予約はキャンセルしました。'];

  }else{
    $content_date_user->cancel_price = 0;
    $content_date_user->goin=9;
    $content_date_user->save();
    UtilYoyaku::chengeStatus($content, $content_date);
    return ['err'=>0, 'message'=>'ご予約はキャンセルしました。'];
  }

}












#リコメンド編集パターンで利用（今は学習メモの編集）
public function ajaxGetRecommend(Request $request)
{

  $recommend_id = $request->get('recommend_id');
  
  if(!$recommend = Recommends::find($recommend_id))
  {
      return ['err'=>1, 'message'=>'学習メモが見つかりません。'];
  }

  if($recommend->table_name == 'learning')
  {
    $learning = Learning::select('title','url')->where('id',$recommend->table_id)->first();
    $recommend['title'] = $learning->name;
    $recommend['url'] = $learning->url;
  }
  elseif($recommend->table_name == 'license_question')
  {
    $license_question = License_question::select(
      'license.id as license_id', #試験ＩＤ
      'license.name as license_name', #試験名
      'license_schedule.license_year', #試験年度
      'license_examination_subject.name as subject_name', #試験科目名、全科目は「全科目」
      'license_question.id',
      'license_question.number'
      )
      ->leftjoin('license', 'license.id', '=', 'license_question.license_id')
      ->leftjoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
      ->leftjoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
      ->where('license_question.id',$recommend->table_id)
      ->first();
    $recommend['title'] = $license_question->subject_name . '('.$license_question->license_year.')';
    $recommend['url'] = '/license/'.$license_question->license_id.'/license_question/'.$license_question->id;
  }
  $recommend['pics'] = Recommends_pics::where('recommend_id',$recommend_id)->take(200)->get();
  return $recommend;

}


#Recommend Right area
public function getRecommendRight(Request $request)
{

  $recommends = Recommends::select(
    'recommends.id',
    'recommends.user_id',
    'recommends.table_name',
    'recommends.table_id',
    'recommends.owner_open',
    'recommends.admin_open',
    'recommends.recommend',
    'recommends.point',
    'recommends.sub_name',
    'recommends.sub_url',
    'recommends.pic',
    'recommends.good_number',
    'recommends.bad_number',
    'recommends.created_at',
    'recommends.updated_at',
    'users.name as user_name',
    'users.pic as user_pic'
  )
  ->join('users', 'users.id', '=', 'recommends.user_id')
  ->where('recommends.user_id',Auth::user()->id)
  ->orderBy('recommends.point', 'desc')
  ->orderBy('recommends.updated_at', 'desc')
  ->paginate(9);

  $recommends = Util::putTitleUrlToRecommends($recommends);
  
  return json_encode(View::make('include.recommend_more_right', array('recommends'=>$recommends))->render());

}




#マイページのリコメンド一覧で利用（今は学習メモ一覧）
public function getRecommend(Request $request)
{

  $recommends_number = Recommends::where('table_name','contents')
  ->where('user_id',Auth::user()->id)
  ->count();

  $recommends = Recommends::select(
    'recommends.id',
    'recommends.user_id',
    'recommends.table_name',
    'recommends.table_id',
    'recommends.owner_open',
    'recommends.admin_open',
    'recommends.recommend',
    'recommends.point',
    'recommends.sub_name',
    'recommends.sub_url',
    'recommends.pic',
    'recommends.good_number',
    'recommends.bad_number',
    'recommends.created_at',
    'recommends.updated_at',
    'users.name as user_name',
    'users.pic as user_pic'
  )
  ->join('users', 'users.id', '=', 'recommends.user_id')
  ->where('recommends.user_id',Auth::user()->id)
  ->orderBy('recommends.point', 'desc')
  ->orderBy('recommends.updated_at', 'desc')
  ->paginate(9);

  $recommends = Util::putTitleUrlToRecommends($recommends);
  
  if ($request->has('page')) {
    return json_encode(View::make('include.recommend_more', array('recommends'=>$recommends))->render());
  }
  
  return View('account.recommend', compact('recommends'));

}




public function getRecommendExists(Request $request)
{

  $table_name = $request->get('table_name');
  $table_id = $request->get('table_id');
  if($recommend = Recommends::select('id')->where('user_id',Auth::user()->id)
    ->where('table_name',$table_name)
    ->where('table_id',$table_id)
    ->first())
  {
      return 1;
  }else{
      return 0;
  }

}


public function postRecommendEdit(Request $request)
{

  $ans= ['err'=>0, 'message'=>''];
  $rating = $request->get('rating');
  if($rating<0 or $rating>5){
    $rating = 3;
  }

  $first_reco = false;
  if(!$recommend = Recommends::find($request->get('recommend_id'))){
    $first_reco = true;
    $recommend = new Recommends;
    $recommend->user_id = Auth::user()->id;
    $recommend->table_name = $request->get('table_name');
    $recommend->table_id = (int)$request->get('table_id');
  }

  $recommend->point = 0;
  if(Auth::user()->id<=100){
    $recommend->admin_open = 1;
  }
  $recommend->recommend = $request->get('recommend');
  $recommend->sub_name = $request->get('sub_name');
  $recommend->sub_url = $request->get('sub_url');
  $recommend->point = $request->get('rating');
  $recommend->save();

  if($request->hasFile('recommendPics')) {
    $picsCount = Recommends_pics::where('recommend_id',$recommend->id)->count();
    if($picsCount>20){
      $ans['err'] = 1;
      $ans['message'] = '合計20枚以上写真を投稿できません。';
      return $ans;
    }
    $pics = $request->file('recommendPics');
    if(count($pics)>6){
      $ans['err'] = 1;
      $ans['message'] = '一度に6枚以上の写真をアップできません。';
      return $ans;
    }
    $recommend->pic = 1;
    foreach($pics as $pic){
      $pic_size = filesize($pic);
      if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
      if( $pic_size<1000 ) return ['err'=>1, 'message'=>'もっと大きな写真をアップしてください。'];
      if( $pic_size>21520000 ) return ['err'=>1, 'message'=>'20MByte以下の写真をアップしてください。'];
      $pic_path = '/uploads/users/' . Auth::user()->id . '/recommend/' . $recommend->id . '/';
      $pic_type = 'pic';
      $pic_name = 'memo_'.$recommend->id.'_' . uniqid() . '.' . $pic->extension();
      $pic_name = Util::formFileToImage($pic, $pic_path, null, $pic_name, $pic_type ); 
      Recommends_pics::insert(['recommend_id'=>$recommend->id, 'type'=>(int)$request->get('table_type'), 'pic'=>$pic_name, 'updated_at' => date("Y-m-d H:i:s")]);
    }
  }
  $recommend->save();

  if($first_reco){
    $user = Auth::user();
    $data = array(
      'user' => $user,
      'recommend' => $recommend->recommend
    );
    Mail::send('emails.account.recommend.send', $data, function ($m) use ($user) {
      $m->from('admin@coordiy.com', '[資格問題ＣＯＯＤ]');
      $m->to($user->email, $user->name);
      $m->bcc('admin@coordiy.com', '[資格問題ＣＯＯＤ]');
      $m->subject('[資格問題ＣＯＯＤ]メモの登録が完了しました。');
    });
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
    'recommends.sub_name',
    'recommends.sub_url',
    'recommends.pic',
    'recommends.good_number',
    'recommends.bad_number',
    'recommends.created_at',
    'recommends.updated_at',
    'users.name as user_name',
    'users.pic as user_pic'
  )
  ->join('users', 'users.id', '=', 'recommends.user_id')
  ->where('recommends.id',$recommend->id)
  ->first();

  $recommends = Util::putTitleUrlToRecommends($recommends);

  return json_encode(View::make('include.recommend_one', array('recommends'=>$recommends))->render());

}




public function postRecommendDeletePic(Request $request)
{

  $recommends_pics_id = (int)$request->get('recommends_pics_id');
  if(!$recommend_pic = Recommends_pics::find($recommends_pics_id)){
    return ['err'=>1, 'message'=>'参考図がみつかりません。'];
  }
  $recommend_id = $recommend_pic->recommend_id;

  $path = '/uploads/users/' . Auth::user()->id . '/recommend/' . $recommend_pic->recommend_id . '/';
  Util::delelteImage($path, $recommend_pic->pic);
  $recommend_pic->delete();

  $count = Recommends_pics::where('recommend_id',$recommend_id)->count();
  if($count===0){
    $recommend = Recommends::find($recommend_id);
    $recommend->pic = 0;
    $recommend->save();
  }

  

  return ['err'=>0, 'message'=>'参考図を削除しました。'];
  
}


public function postRecommendDeleteRecommend(Request $request)
{

  $recommend_id = (int)$request->get('recommend_id');
  //logger($recommend_id);
  if(!$recommend = Recommends::find($recommend_id)){
    return 'ng';
  }
  if($recommend_pics = Recommends_pics::select('id','pic')->where('recommend_id',$recommend_id)->get()){
    $path = '/uploads/users/' . Auth::user()->id . '/recommend/' . $recommend_id . '/';
    foreach($recommend_pics as $pic){
      $ans = Util::delelteImage($path, $pic->pic);
      if($ans === 'ok'){
        Recommends_pics::where('id',$pic->id)->delete();
      }else{
        //logger('errer delete recommend pic recommend_id:' . $recommend_id . 'pic_id:' . $pic->id);
      }
    }
    
  }

  $recommend->delete();

  return ['err'=>0, 'message'=>'学習メモを削除しました。'];

}






public function getNotAlreadyMessage(Request $request)
{

  return Messages_notread::select(
      'messages_notread.id',
      'messages_notread.already_read',
      'messages.user_id',
      'messages.all_users',
      'messages.all_owners',
      'messages.to_user_id',
      'messages.updated_at',
      'messages.message',
      'users.id as target_user_id',
      'users.owner as target_user_owner',
      'users.name as target_user_name',
      'users.pic as target_user_pic'
    )
    ->join('messages', 'messages.id', '=', 'messages_notread.message_id')
    ->join('users', 'users.id', '=', 'messages.user_id')
    ->where('messages_notread.already_read', 0)
    ->where('messages_notread.to_user_id', Utilowner::getOwnerId())
    ->orderBy('messages.updated_at', 'desc')
    ->paginate(5);

}




public function getMessages(Request $request){

  $request_type = ($request->get('request_type')) ? $request->get('request_type') : 'receive';
  $user = null;

  switch($request_type){
    case 'receive':
      $messages = Messages_notread::select(
          'messages_notread.id',
          'messages_notread.already_read',
          'messages.user_id',
          'messages.all_users',
          'messages.all_owners',
          'messages.to_user_id',
          'messages.updated_at',
          'messages.message',
          'users.id as target_user_id',
          'users.owner as target_user_owner',
          'users.name as target_user_name',
          'users.pic as target_user_pic'
        )
        ->join('messages', 'messages.id', '=', 'messages_notread.message_id')
        ->join('users', 'users.id', '=', 'messages.user_id')
        ->where('messages_notread.to_user_id', Utilowner::getOwnerId())
        ->orderBy('messages.updated_at', 'desc')
        ->paginate(25);
      break;
    case 'send':
      $messages = Messages_notread::select(
          'messages_notread.id',
          'messages_notread.already_read',
          'messages.user_id',
          'messages.all_users',
          'messages.all_owners',
          'messages.to_user_id',
          'messages.updated_at',
          'messages.message',
          'users.id as target_user_id',
          'users.owner as target_user_owner',
          'users.name as target_user_name',
          'users.pic as target_user_pic'
        )
        ->join('messages', 'messages.id', '=', 'messages_notread.message_id')
        ->join('users', 'users.id', '=', 'messages.to_user_id')
        ->where('messages_notread.user_id', Utilowner::getOwnerId())
        ->orderBy('messages.updated_at', 'desc')
        ->paginate(25);
      break;
    case 'user':
      $user_id = (int)$request->get('user_id');
      //$user = Users::select('id','name','pic')->find($user_id);
      $messages = Messages_notread::select(
          'messages_notread.id',
          'messages_notread.already_read',
          'messages.user_id',
          'messages.all_users',
          'messages.all_owners',
          'messages.to_user_id',
          'messages.updated_at',
          'messages.message',
          'users.id as target_user_id',
          'users.owner as target_user_owner',
          'users.name as target_user_name',
          'users.pic as target_user_pic'
        )
        ->join('messages', 'messages.id', '=', 'messages_notread.message_id')
        ->join('users', 'users.id', '=', 'messages.user_id')
        ->where('messages_notread.user_id', $user_id)
        ->where('messages_notread.to_user_id', Utilowner::getOwnerId())
        ->orderBy('messages.updated_at', 'desc')
        ->paginate(25);
      break;
  }

  if ($request->has('page')) {
    return json_encode(View::make('account.include.messages_more', array('messages' => $messages))->render());
  }

  return View('account.messages', compact('messages','request_type','user'));

}




public function getOneMessage(Request $request){

  $messeges_notread_id = (int)$request->get('messeges_notread_id');
  //logger('messeges_notread_id: ' . $messeges_notread_id);
  $message_notread = Messages_notread::select('message_id')->find($messeges_notread_id);
  $message = Messages::find($message_notread->message_id);
  $user = User::select('name','pic')->find($message->user_id);
  $user['user_pic'] = Util::getPic('user', null, $user->pic, $message->user_id, 400, null);

  return ['message'=>$message, 'user'=>$user];

}





public function postMessageReply(Request $request){

  //validation
  $user_id = (int)$request->get('user_id');
  if(!$to_user = User::find($user_id)){
    return ['err'=>1, 'message'=>'送信先が見つかりませんでした。'];
  }
  $no_owner = true;
  if($to_user->owner) $no_owner = false;
  if(Auth::user()->owner) $no_owner = false;
  if($no_owner) return ['err'=>1, 'message'=>'メッセージを送れない相手でした。'];
  if( !$request->get('message') ) return ['err'=>1, 'message'=> 'メッセージを入力してください。']; 
  if( mb_strlen($request->get('message')) < 10) return ['err'=>1, 'message'=> 'メッセージが短すぎます。'];
  if( mb_strlen($request->get('message')) > 2000) return ['err'=>1, 'message'=> 'メッセージは2000文字以内で入力ください。']; 

  $message = new Messages;
  $message->user_id = Utilowner::getOwnerId();
  $message->to_user_id = $to_user->id;
  $message->message = $request->get('message');
  $message->all_users = 0;
  $message->all_owners = 0;
  $message->save();

  DB::table('messages_notread')->insert([
    'message_id'=>$message->id,
    'user_id'=>Utilowner::getOwnerId(),
    'all_users'=>$message->all_users,
    'all_owners'=>$message->all_owners,
    'to_user_id'=>$to_user->id,
    'updated_at' => date("Y-m-d H:i:s")]);

  $auth_user = User::find(Utilowner::getOwnerId());
  $data = array(
    'to_user' => $to_user,
    'auth_user' => $auth_user,
    'words' => $message
  );
  Mail::send('emails.account.message.send', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($to_user->email, $to_user->name);
    $m->bcc('admin@coordiy.com', '[Coordiy]');
    $m->subject('[Coordiy]メッセージが届いています。');
  });

  return ['err'=>0, 'message'=>'メッセージを送信しました。'];

}



public function postMessage(Request $request){

  //validation
  $content_id = (int)$request->get('content_id');
  $content = Contents::select('user_id')->find($content_id);
  if(!$to_user = User::find($content->user_id)){
    return ['err'=>1, 'message'=>'送信先が見つかりませんでした。'];
  }
  $no_owner = true;
  if($to_user->owner) $no_owner = false;
  if(Auth::user()->owner) $no_owner = false;
  if($no_owner) return ['err'=>1, 'message'=>'メッセージを送れない相手でした。'];
  if( !$request->get('message') ) return ['err'=>1, 'message'=> 'メッセージを入力してください。']; 
  if( mb_strlen($request->get('message')) < 10) return ['err'=>1, 'message'=> 'メッセージが短すぎます。'];
  if( mb_strlen($request->get('message')) > 2000) return ['err'=>1, 'message'=> 'メッセージは2000文字以内で入力ください。']; 

  $message = new Messages;
  $message->user_id = Utilowner::getOwnerId();
  $message->to_user_id = $to_user->id;
  $message->message = $request->get('message');
  if(Utilowner::getOwnerId()===1){
    $message->all_users = ($request->has('all_users')) ? 1 : 0;
    $message->all_owners = ($request->has('all_owners')) ? 1 : 0;
  }else{
    $message->all_users = 0;
    $message->all_owners = 0;
  }
  $message->save();

  if($message->all_users===1){
    $users = User::select('id')->where('id', '>', 100)->get();
    foreach($users as $user){
      DB::table('messages_notread')->insert([
        'message_id'=>$message->id,
        'user_id'=>Utilowner::getOwnerId(),
        'all_users'=>$message->all_users,
        'all_owners'=>$message->all_owners,
        'to_user_id'=>$user->id,
        'updated_at' => date("Y-m-d H:i:s")]);
    }
  }elseif($message->all_owners===1){
    $owners = User::select('id')->where('id', '>', 100)->where('owner',1)->get();
    foreach($owners as $owner){
      DB::table('messages_notread')->insert([
        'message_id'=>$message->id,
        'user_id'=>Utilowner::getOwnerId(),
        'all_users'=>$message->all_users,
        'all_owners'=>$message->all_owners,
        'to_user_id'=>$owner->id,
        'updated_at' => date("Y-m-d H:i:s")]);
    }
  }else{
    DB::table('messages_notread')->insert([
      'message_id'=>$message->id,
      'user_id'=>Utilowner::getOwnerId(),
      'all_users'=>$message->all_users,
      'all_owners'=>$message->all_owners,
      'to_user_id'=>$to_user->id,
      'updated_at' => date("Y-m-d H:i:s")]);
  }

  $auth_user = User::find(Utilowner::getOwnerId());
  $data = array(
    'to_user' => $to_user,
    'auth_user' => $auth_user,
    'words' => $message 
  );
  Mail::send('emails.account.message.send', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($to_user->email, $to_user->name);
    $m->bcc('admin@coordiy.com', '[Coordiy]');
    $m->subject('[Coordiy]メッセージが届いています。');
  });

  return ['err'=>0, 'message'=>'メッセージを送信しました。'];

}


public function postMessageAlready(Request $request){

  //validation
  $messages = $request->get('messages');
  //logger($messages);
  foreach($messages as $message_notread_id){
    //logger('message_notread_id: ' . $message_notread_id);
    $messages_notread = Messages_notread::find((int)$message_notread_id);
    //logger($messages_notread);
    $messages_notread->already_read = ($messages_notread->already_read===1) ? 0 : 1;
    $messages_notread->save();
  }

  return 1;

}

public function postMessageDelete(Request $request){

  //validation
  $messages = $request->get('messages');
  //logger($messages);
  foreach($messages as $message_notread_id){
    DB::table('messages_notread')->where('id',$message_notread_id)->delete();
  }

  return 1;

}





public function getFavorite(Request $request)
{

  $favo = Util::getFavo('license_question');
  $license_questions = License_question::whereIn('id',$favo)
    ->orderBy('updated_at', 'desc')
    ->paginate(25);
  foreach($license_questions as $key=>$license_question){
    $license_questions[$key]['favo'] = Util::checkFavo($favo, $license_question->id);
  }

  if ($request->has('page')) {
    return json_encode(View::make('include.search_license_questions', array('license_questions' => $license_questions))->render());
  }
  return View('account.favorite', compact('license_questions'));

}




public function getProfile(Request $request){
  if(!$user_recruit = User_recruit::where('user_id',Auth::user()->id)->first()){
    $user_recruit = new User_recruit;
  }
  return View('account.profile', compact('user_recruit'));
}
public function getProfileEdit(Request $request){ 
  return View('account.profileEdit', compact(''));
}
public function getProfileRecruitEdit(Request $request){ 
  if(!$user_recruit = User_recruit::where('user_id',Auth::user()->id)->first()){
    $user_recruit = new User_recruit;
  }
  return View('account.profileRecruitEdit', compact('user_recruit'));
}








public function postProfileEdit(Request $request)
{

  $this->validate($request, [
      'name'           => 'required|min:2|max:255',
      'email'          => 'email'
  ]);

  $user = Auth::user();
  if( $request->has('email') and $request->get('email') ){
    $user->email = $request->get('email');
  }
  if( $request->has('password') and $request->get('password') ){
    $user->password = bcrypt($request->get('password'));
  }
  $user->name = $request->get('name');

  $mainPic = $request->file('mainPic');
  if($mainPic){
    $pic_size = filesize($mainPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/users/' . Auth::user()->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $mainPic->extension();
    $user->pic = Util::formFileToImage($mainPic, $pic_path, $user->pic, $pic_name, $pic_type );
  }

  $backPic = $request->file('backPic');
  if($backPic){
    $pic_size = filesize($backPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/users/' . Auth::user()->id . '/';
    $pic_type = 'back_pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $backPic->extension();
    $user->back_pic = Util::formFileToImage($backPic, $pic_path, $user->back_pic, $pic_name, $pic_type );  
  }

  $user->save();
  return redirect('/account/profile')->with('success', 'プロフィールを変更しました。');

}








public function postProfileRecruitEdit(Request $request)
{

  $this->validate($request, [
    'name_first'                 => 'required|string|max:255',
    'name_second'                => 'required|string|max:255',
    'postal_code'                => 'required|string|max:8',
    'country-area'               => 'required|exists:country_area,ken_id',
    'country-area-address-one'   => 'required|exists:city_address,city_id',
    'country-area-address-two'   => 'required|exists:town_address,town_id',
    'country-area-address-other' => 'required|min:1|max:500',
    'career'                     => 'required|string|max:2000',
    'dob'                        => 'required|date',
    'sns'                        => 'max:255',
    'personality'                => 'max:4',
    'privite_status'             => 'max:4',
    'experience'                 => 'max:2000',
    'description'                => 'max:2000'
  ]);

  if(!$user_recruit = User_recruit::where('user_id',Auth::user()->id)->first()){
    $user_recruit = new User_recruit;
    $user_recruit->user_id = Auth::user()->id;
  }
  
  //$user_recruit->grand_country_area_id = Util::areaUtil($request->get('country-area'));
  $user_recruit->name_first = $request->get('name_first');
  $user_recruit->name_second = $request->get('name_second');
  $user_recruit->personality = $request->get('personality');
  $user_recruit->privite_status = $request->get('privite_status');
  $user_recruit->postal_code = $request->get('postal_code');
  $user_recruit->country = 392;
  $user_recruit->country_area = $request->get('country-area');
  $user_recruit->country_area_address_one = $request->get('country-area-address-one');
  $user_recruit->country_area_address_two = $request->get('country-area-address-two');
  $user_recruit->country_area_address_other = $request->get('country-area-address-other');
  $user_recruit->dob = $request->get('dob');
  $user_recruit->sns = $request->get('sns');
  $tell = $request->get('tell');
  $tell = str_replace('-','',$tell);
  if( !ctype_digit($tell) ) return back()->with('warning', '電話番号は半角の数字とハイフンのみ有効です。')->withInput();
  if( !(strlen($tell)>=10 and strlen($tell)<=11) ) return back()->with('warning', '電話番号は10-11桁で登録してください。')->withInput();
  $user_recruit->tell = $tell;
  $user_recruit->career = $request->get('career');
  $user_recruit->experience = $request->get('experience');
  $user_recruit->description = $request->get('description');

  $mainPic = $request->file('mainPic');
  if($mainPic){
    $pic_size = filesize($mainPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/users/' . $user_recruit->user_id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $mainPic->extension();
    $user_recruit->pic = Util::formFileToImage($mainPic, $pic_path, $user_recruit->pic, $pic_name, $pic_type );
  }

  $user_recruit->save();
  return redirect('/account/profile')->with('success', '詳細プロフィールを変更しました。');

}







}


