<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Favorite;
use App\models\Company;
use App\models\owner_service;
use App\models\Country;
use App\models\Country_area;
use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;

use App\User;
use App\models\Contents;
use App\models\Content_date;
use App\models\Recommends;
use App\models\Recommends_pics;

use App\models\Event;

use App\models\Messages;
use App\models\Messages_notread;

use Response;
use Mail;
use Validator;
use Redirect;
use Auth;
use DB;
use Storage;
use Image;
use Util;
use Utilowner;

class CmnController extends Controller {

public function __construct()
{
}








public function contact(Request $request)
{



  $this->validate($request, [
    'name' => 'required',
    'email' => 'required|email',
    'comment' => 'required'
  ]);

  $event = [];
  $event['name'] =   $request->get('name');
  $event['phone'] =   $request->get('phone');
  $event['email'] =  $request->get('email');
  $event['comment'] = $request->get('comment');
  
  $data = array(
    'event' => $event
  );
  Mail::send('emails.cmn.contact_owner', $data, function ($m) use ($event) {
    $m->from('coord@coordiy.com', '[Coord]');
    $m->to('coord@coordiy.com', 'Coord管理者様');
    $m->subject('[Coord]質問箱へのご質問を承りました。');
  });
  Mail::send('emails.cmn.contact_user', $data, function ($m) use ($event) {
    $m->from('coord@coordiy.com', '[Coord]');
    $m->to($event['email'], $event['name'].'様');
    $m->subject('[Coord]質問箱へのご質問を承りました。');
  });

  return redirect()->back()->with("info","質問箱へのご質問を承りました。");

}












public function postEvent113(Request $request)
{

  $options['ssl']['verify_peer']=false;
  $options['ssl']['verify_peer_name']=false;

  // リクエストURLの組み立て「https://www.google.com/recaptcha/api/siteverify?secret=[API SECRET]&response=[ユーザ認証コード]」
  $request_url = sprintf("%s?secret=%s&response=%s", env('RECAPTCHA_API_URL', ''), env('RECAPTCHA_API_SECRET', ''), $request->input('g-recaptcha-response'));
  // reCAPTCHA API へリクエストを送り結果を受け取る
  $response = file_get_contents($request_url, false, stream_context_create($options));
  // JSON形式を配列へ変換する
  $response_array = json_decode($response, true);

  if(!$response_array['success']){
    return redirect()->back()->with("warning","画面を読み込み直してもう一度お試しください。");
  }

  $this->validate($request, [
    'email' => 'required|email|unique:event',
    'url'   => 'required|url|unique:event'
  ]);
  $event = new Event;
  $event->email = $request->get('email');
  $event->url = $request->get('url');
  $event->save();
  
  $data = array(
    'event' => $event
  );
  Mail::send('emails.owner.event.113', $data, function ($m) use ($event) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to($event->email, 'オーナー様');
    $m->subject('[Coordiy]ワンクリックオーナー登録を承りました。');
  });
  Mail::send('emails.manager.event.113', $data, function ($m) use ($event) {
    $m->from('admin@coordiy.com', '[Coordiy]');
    $m->to('admin@coordiy.com', 'Coordiy管理者様');
    $m->subject('[Coordiy]ワンクリックオーナー登録依頼');
  });

  return redirect()->back()->with("info","ワンクリック登録へお申込が完了しました。");

}








public function getIntroduce()
{
  return View('yoyaku.introduce.owner.yoyaku', compact(''));
}



public function err404()
{
  return View('errors.404');
}

public function redirect_top()
{
  return redirect('/yoyaku');
}

public function logout(Request $request)
{
  Auth::logout();
  return redirect('/yoyaku');
}

public function getNotAlreadyMessage(Request $request)
{

  if(!Auth::check()) return [];

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

public function ajaxGetContents(Request $request)
{

  if($request->get('user_id')){
    $user_id = (int)$request->get('user_id');
  }else{
    $user_id = Auth::user()->id;
  }
  $type = $request->get('type');
  // 1===My contents, 2===Yoyaku contents, 3===favorite contents

  $contents = Contents::select(
       'contents.id as id',
       'contents.name as name',
       'contents.country_area_id as country_area_id',
       'contents.service as service',
       'contents.stay as stay',
       'contents.price as price',
       'contents.pic as pic',
       'contents.recommend_number as recommend_number',
       'contents.recommend_point as recommend_point',
       'contents.good_number as good_number',
       'contents.bad_number as bad_number'
    )
    ->where('user_id', $user_id)
    ->paginate(9);

  return $contents;

}

public function ajaxGetContentsYoyaku(Request $request)
{

  $user_id = Auth::user()->id;
  // 1===My contents, 2===Yoyaku contents, 3===favorite contents

  $contents = Contents::select(
       'content_date_join_users.id as content_date_join_users_id',
       'contents.id as id',
       'contents.name as name',
       'contents.country_area_id as country_area_id',
       'contents.service as service',
       'contents.stay as stay',
       'contents.price as price',
       'contents.pic as pic',
       'contents.recommend_number as recommend_number',
       'contents.recommend_point as recommend_point',
       'contents.good_number as good_number',
       'contents.bad_number as bad_number'
     )
    ->join('content_date', 'contents.id', '=', 'content_date.content_id')
    ->join('content_date_join_users', 'content_date.id', '=', 'content_date_join_users.content_date_id')
    ->where('content_date_join_users.user_id', Auth::user()->id)
    ->paginate(9);

  return $contents;

}

function ajaxGetRecommends(Request $request)
{
  $table_id = $request->get('table_id'); 
  $table_name = $request->get('table_name');

  if($table_name==='users'){
    if(!$table_id){
      $table_id = Auth::user()->id;
    }
    $recommends = Recommends::select(
         'recommend.id',
         'recommend.table_name',
         'recommend.table_id',
         'recommend.point',
         'recommend.recommend',
         'recommend.good_number',
         'recommend.bad_number',
         'recommend.created_at',
         'users.id as user_id',
         'users.pic as user_pic',
         'users.name as user_name'
      )
      ->join('users', 'users.id', '=', 'recommend.user_id')
      ->where('recommend.user_id', $table_id)
      ->paginate(9);
  }else{
    $recommends = Recommends::select(
         'recommend.id',
         'recommend.table_name',
         'recommend.table_id',
         'recommend.point',
         'recommend.recommend',
         'recommend.good_number',
         'recommend.bad_number',
         'recommend.created_at',
         'users.id as user_id',
         'users.pic as user_pic',
         'users.name as user_name'
      )
      ->join('users', 'users.id', '=', 'recommend.user_id')
      ->where('recommend.table_name', $table_name)
      ->where('recommend.table_id', $table_id)
      ->where('recommend.owner_open', 1)
      ->paginate(9);
  }
  foreach($recommends as $key=>$recommend){
    $pic = null;
    $tmp = Recommends_pics::select('pic')->where('recommend_id', $recommend['id'])->first();
    if($tmp){
      $pic = $tmp['pic'];
    }
    $recommends[$key]['pic400']=Util::getPic('recommend', false, $pic, $recommend['user_id'], 400, $recommend['id']);
    $recommends[$key]['user_pic']=Util::getPic('user', false, $recommend->user_pic, $recommend['user_id'], 400, null);

    $content_tmp = DB::table($recommend['table_name'])->select('id','name','pic','price','stay','country_area_id','service','recommend_number','recommend_point')->find($recommend['table_id']);
    $content = [];

    $content['name']=$content_tmp->name;
    $tmp = DB::table('country_area')->select('name')->find($content_tmp->country_area_id);
    $content['country_area']=$tmp->name;
    $content['price']=$content_tmp->price;
    $content['stay']=$content_tmp->stay;
    $content['recommend_point']=$content_tmp->recommend_point;
    $content['recommend_number']=$content_tmp->recommend_number;
    if($content_tmp->service){
      $content['service_name']=UtilYoyaku::getNewMenuSenMonTen($content_tmp->service);
    }else{
      $content['service_name'] = null;
    }
    $content['pic_path']=Util::getPic($recommend['table_name'], false, $content_tmp->pic, $content_tmp->id, 400, null);
    $recommends[$key]['content']=$content;
  }
  return $recommends;
}

public function getRecommendPics(Request $request)
{

  $recommend_id = $request->get('recommend_id');
  $pics = Recommends_pics::select('pic','updated_at')->where('recommend_id',$recommend_id)->take(200)->get();
  return $pics;

}


public function ajaxPostNice(Request $request)
{
  /*
    $table === content or recommend or users
    $id === id
    $type === good or bad
  */
  logger('request' . $request);
  $table = $request->get('table');
  $id = $request->get('id');
  $type = $request->get('type');
  if($table==='contents'){
    $key = 'content_id';
  }elseif($table==='recommends'){
    $key = 'recommend_id';
  }elseif($table==='owner'){
    $key = 'owner_id';
  }elseif($table==='license_question'){
    $key = 'license_question_id';
  }
  $user_id = Auth::user()->id;
  /* Check Niced */
  if(!$tmp = DB::table($table . '_' . $type)
    ->select('id','point')
    ->where('user_id', $user_id)
    ->where($key, $id)
    ->first())
  {
    DB::table($table . '_' . $type)
      ->insert( [$key=>$id, 'user_id' => $user_id, 'point' => 1] );
    //pointBonus($table, $id, $type)
    //return Util::pointBonus($table, $id, $type);
    $sum = DB::table($table . '_' . $type)->where($key,$id)->sum('point');
    if($table==='owner'){
      $table='users';
    }
    DB::table($table)->where('id',$id)->update([$type . '_number'=>$sum]);
    $respons = $sum;
    //logger('public user' . $respons);
    return $respons;
  }elseif($user_id === 1){
    DB::table($table . '_' . $type)
      ->where('user_id', $user_id)
      ->where($key, $id)
      ->update( [ 'point' => $tmp->point+1 ] );
    //return Util::pointBonus($table, $id, $type);
    //return 1;
    $sum = DB::table($table . '_' . $type)->where($key,$id)->sum('point');
    if($table==='owner'){
      $table='users';
    }
    DB::table($table)->where('id',$id)->update([$type . '_number'=>$sum]);
    $respons = $sum;
    //logger('admin user' . $respons);
    return $respons;
  }else{
    return 'doNo';
  }    
}

public function ajaxPostFavorite(Request $request)
{

  $table = $request->get('table');
  $id = $request->get('id');
  $type = $request->get('type');

  if($type === 'add'){
    if($favo = Favorite::select('id', $table)
      ->where('user_id', Auth::user()->id)
      ->first())
    {

      $favo_id = $favo['id'];
      $favo = json_decode($favo[$table], true);

      if(count($favo)>1000){
        return 'max';
      }
      if( ($favo) and in_array($id, $favo, true) ){
        return 'doNo';
      }

      $favo[] = (int)$id;
      
      DB::table('favorite')->where('id',$favo_id)
        ->update([$table=>json_encode($favo)]);

    }else{
      Favorite::insert(['user_id'=>Auth::user()->id, $table=>json_encode([$id])]);
    }
  }elseif($type === 'delete'){
    if($favo = Favorite::select('id', $table)
      ->where('user_id',Auth::user()->id)
      ->first()){

      $favo_id = $favo['id'];
      $favo = json_decode($favo[$table], true);
      $favo = array_diff($favo, array($id));
      $favo = array_values($favo);
      Favorite::where('id',$favo_id)
        ->update([$table=>json_encode($favo)]);
    }
  }

  return 'ok';

}



public function ajaxGetCountryAreas(Request $request)
{

  $country_id = $request->get('country_id');
  
  $country_areas = DB::table('country_area')
    ->select('ken_id','name')
    ->where('country_id',$country_id)
    ->get();
  return $country_areas;

}

public function ajaxGetCountryAreaOnes(Request $request)
{

  $country_area_id = $request->get('country_area_id');

  $country_area_address_ones = DB::table('city_address')
    ->select('city_id','city_name')
    ->where('ken_id',$country_area_id)
    ->get();
  return $country_area_address_ones;

}

public function ajaxGetCountryAreaTwos(Request $request)
{

  $country_area_address_one_id = $request->get('country_area_address_one_id');

  $country_area_address_twos = DB::table('town_address')
    ->select('town_id','town_name')
    ->where('city_id',$country_area_address_one_id)
    ->get();
  return $country_area_address_twos;

}


public function ajaxGetCountryAreaOnesCustom(Request $request)
{

  $country_area_id = $request->get('country_area_id');

  $city_address = DB::table('city_address')
    ->select('city_id', 'city_name')
    ->where('ken_id',$country_area_id)
    ->get();
  return $city_address;

}

public function ajaxGetCountryAreaTwosCustom(Request $request)
{

  $country_area_address_one_custom_id = $request->get('country_area_address_one_custom_id');

  //logger('country_area_address_one_custom_id: '.$country_area_address_one_custom_id);
  $town_address = DB::table('town_address')
    ->select('town_id', 'town_name')
    ->where('city_id',$country_area_address_one_custom_id)
    ->get();
    //logger($town_address);
  return $town_address;

}



public function ajaxGetYoyakuType(Request $request)
{
  
  return UtilYoyaku::getNewMenuSenMonTen(null);

}






public function ajaxGetFriends()
{
   
  $favo = Favorite::select('users')->where('user_id', Auth::user()->id)->first();
  if($favo and $favo->users){
    $data = json_decode($favo->users,true);
  }else{
    $data = [null];
  }
  $friends = User::select(
      'users.id',
      'users.bio',
      'users.pic',
      'users.back_pic',
      'users.name',
      'users.good_number',
      'users.bad_number'
    )
    ->whereIn('users.id',$data)
    ->where('users.owner',1)
    ->paginate(9);
  foreach($friends as $k=>$v ){
    $friends[$k]['pic650']=Util::getPic('user', false, $v['pic'], $v['id'], 400, null);
    $friends[$k]['pic80']=Util::getPic('user', false, $v['pic'], $v['id'], 400, null);
    $friends[$k]['back_pic650']=Util::getPic('user', true, $v['back_pic'], $v['id'], 400, null);
    $friends[$k]['url']='#/shops/' . $v->id . '/profile';
    $friends[$k]['favo_a_id_add']='favoOwner' . $v['id'] . 'aAdd';
    $friends[$k]['favo_a_id_delete']='favoOwner' . $v['id'] . 'aDelete';
  }
  return $friends;

}

























}


