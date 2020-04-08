<?php namespace App\Http\Controllers\owner\license;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\models\Messages;
use App\models\Messages_notread;

use App\models\Contents;
use App\models\Content_date;
use App\models\Content_date_users;
use App\models\Content_sell_month;
use App\models\Content_tags;

use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;

use App\models\company;
use App\models\company_code;
use App\models\Company_calendar;
use App\models\User_bank;

use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;
use App\models\Owners_users;
use App\models\Owners_users_used_content;
use App\models\Owner_pay;

use App\models\License;



use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerLicenseController extends Controller {

public function __construct()
{

}












public function getCustomerIndex(Request $request)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  return View::make('owner.customer.index', compact('company'));

}

public function getCustomerData(Request $request)
{

  //$content = Contents::find($id);
  if(
    $owners_users = Owners_users::where('owner_id',Utilowner::getOwnerId())
      ->paginate(50)
  ){
    $content_ids = [];
    $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->take(100)->get();
    foreach($contents as $val){
      $content_ids[] = $val->id;
    }
    foreach($owners_users as $key=>$owners_user){
      $owners_users[$key]['usedContents'] = Owners_users_used_content::select(
          'contents.name'
        )
        ->join('contents', 'contents.id', '=', 'owners_users_used_content.content_id')
        ->where('owners_user_id',$owners_user->id)
        ->take(100)
        ->get();
      $owners_users[$key]['updated_at_jp'] = Util::getOverTimeJp($owners_user->updated_at);
      $owners_users[$key]['payAll'] = number_format(Content_date_users::whereIn('content_id',$content_ids)->whereIn('goin',[1,2])->where('owners_user_id',$owners_user->id)->sum('price_sum'));
      $owners_users[$key]['usedAll'] = Content_date_users::whereIn('content_id',$content_ids)->whereIn('goin',[1,2])->where('owners_user_id',$owners_user->id)->count();
    }
  }else{
    $owners_users = [];
  }

  return $owners_users;

}










public function postSupportContact(Request $request){

  //validation
  if(Auth::user()->owner!==1) return ['err'=>1, 'message'=>'オーナー問い合わせできないアカウントです。'];
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
  Mail::send('emails.owner.support.contact.toAdmin', $data, function ($m) use ($to_user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($to_user->email, $to_user->name);
    $m->subject('[Coordiy予約]オーナー様からお問合せが届いています。');
  });
  Mail::send('emails.owner.support.contact.toOwner', $data, function ($m) use ($auth_user) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($auth_user->email, $auth_user->name);
    $m->subject('[Coordiy予約]お問合せを承りました。');
  });

  return ['err'=>0, 'message'=>'メッセージを送信しました。'];

}





public function ajaxGetCustomerMonth()
{

  $today = date('Y-m', strtotime('today'));
  $end_day = date('d', strtotime('today'));
  $end_day = (int)$end_day;
  $day = $today . '-01';
  $start_day = 1;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $data = [];
  $customer = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    $mens = [];
    $content_date_users = Content_date_users::select('user_id')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->get();
    foreach($content_date_users as $content_date_user){
      $mens[] = $content_date_user->user_id;
    }
    $mens = array_count_values($mens);
    $customer += count($mens);
    $data[] = ['x'=>$start_day,'y'=>$customer];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $data;

}

public function ajaxGetCustomerWeek()
{
  
  $day = date('Y-m-d', strtotime('last Monday')); // 前の月曜日
  $start_day = date('d', strtotime($day));
  $start_day = (int)$start_day;
  $today = date('d', strtotime('today'));
  $today = (int)$today;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $week = [];
  $customer = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    $mens = [];
    $content_date_users = Content_date_users::select('user_id')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->get();
    foreach($content_date_users as $content_date_user){
      $mens[] = $content_date_user->user_id;
    }
    $mens = array_count_values($mens);
    $customer += count($mens);
    $week[] = ['x'=>$start_day,'y'=>$customer];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $week;

}






























public function ajaxGetSellNumberMonth()
{

  $today = date('Y-m', strtotime('today'));
  $end_day = date('d', strtotime('today'));
  $end_day = (int)$end_day;
  $day = $today . '-01';
  $start_day = 1;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $data = [];
  $sellNumber = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    $sellNumber += Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->count();
    $data[] = ['x'=>$start_day,'y'=>$sellNumber];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $data;

}

public function ajaxGetSellNumberWeek()
{
  
  $day = date('Y-m-d', strtotime('last Monday')); // 前の月曜日
  $start_day = date('d', strtotime($day));
  $start_day = (int)$start_day;
  $today = date('d', strtotime('today'));
  $today = (int)$today;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $week = [];
  $sellNumber = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    $sellNumber += Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->count();
    $week[] = ['x'=>$start_day,'y'=>$sellNumber];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $week;

}






















public function ajaxGetSellMonth()
{

  $today = date('Y-m', strtotime('today'));
  $end_day = date('d', strtotime('today'));
  $end_day = (int)$end_day;
  $day = $today . '-01';
  $start_day = 1;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $data = [];
  $sell = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    if(
      $content_date_users = Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->get()
      )
    {
      //logger('count: ' . count($content_date_users));
      foreach($content_date_users as $content_date_user){
        switch ($content_date_user->goin) {
          case 1:
              $sell += $content_date_user->payment_sum;
              break;
          case 2:
              $sell += $content_date_user->payment_sum;
              break;
          case 9:
              $sell += $content_date_user->cancel_price;
              break;
        }
      }
    }
    $data[] = ['x'=>$start_day,'y'=>$sell];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $data;

}

public function ajaxGetSellWeek()
{
  
  $day = date('Y-m-d', strtotime('last Monday')); // 前の月曜日
  $start_day = date('d', strtotime($day));
  $start_day = (int)$start_day;
  $today = date('d', strtotime('today'));
  $today = (int)$today;
  //$next_sunday = date('Y-m-d', strtotime('next Sunday')); // 次の日曜日
  
  $week = [];
  $sell = 0;
  $contents = Contents::select('id')->where('user_id',Utilowner::getOwnerId())->get();
  $content_ids = [];
  foreach($contents as $content){
    $content_ids[] = $content->id;
  }
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    if(
      $content_date_users = Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
      ->whereIn('content_id',$content_ids)
      ->whereIn('goin',[1,2,9])
      ->where('created_at', '>=', $day . ' 00:00:00')
      ->where('created_at', '<=', $day . ' 23:59:59')
      ->get()
      )
    {

      //logger('count: ' . count($content_date_users));
      foreach($content_date_users as $content_date_user){
        switch ($content_date_user->goin) {
          case 1:
              $sell += $content_date_user->payment_sum;
              break;
          case 2:
              $sell += $content_date_user->payment_sum;
              break;
          case 9:
              $sell += $content_date_user->cancel_price*0.92;
              break;
        }
      }
    }
    $week[] = ['x'=>$start_day,'y'=>$sell];
    $start_day++;
    $day = date('Y-m-d', strtotime('1 day ' . $day));
  }

  return $week;

}








public function question(Request $request)
{

  return redirect('/owner/license/1/question');

  $licenses = License::paginate(20);;
  if ($request->has('page')) {
    return json_encode(View::make('include.search_licenses', array('licenses' => $licenses))->render());
  }
  return View::make('owner.license.question', compact('licenses'));

}

public function index(Request $request)
{

  $licenses = License::paginate(20);;
  if ($request->has('page')) {
    return json_encode(View::make('include.search_licenses', array('licenses' => $licenses))->render());
  }
  return View::make('owner.license.question', compact('licenses'));

}





public function getRegister(Request $request)
{

  if(!$company = company::where('user_id', Auth::user()->id)->first()){
    $company = new company;
  }

  if($owner_request = Owner_request::where('user_id',Auth::user()->id)->first()){
    $owner_services = json_decode($owner_request->services, true);
  }else{
    $owner_services = [];
  }

  $company_code = [];
  $company_code_tmp = company_code::get();
  foreach($company_code_tmp as $val){
    $company_code[$val->id] = $val->name;
  }

  $contents = Contents::select(
    'contents.id',
    'contents.service',
    'contents.country_area_id',
    'contents.country_area_address_one',
    'contents.country_area_address_two',
    'contents.country_area_address_other',
    'contents.station_name',
    'contents.station_distance',
    'contents.tell',
    'contents.name',
    'contents.price',
    'contents.pic',
    'contents.shop_down',
    'contents.description',
    'contents.recommend_number',
    'contents.recommend_point',
    'contents.good_number',
    'contents.bad_number',
    'contents.user_id'
  )
  ->whereIn('contents.id',[860578,52,6,41,40,33,50,19,48,46,45])
  ->paginate(20);

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  $favo = Util::getFavo('contents');
  foreach($contents as $key=>$content){
    
    $contents[$key]['favo'] = Util::checkFavo($favo, $content->id);

    if($content->service===62 or $content->service===69 or $content->service===101){
      $content_date = Content_date::where('content_id',$content->id)
        ->where('menu_ids', '=', '['.$content->menu_id.']')
        ->where('start', '>=', date('Y-m-d 00:00:00'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first();
    }else{
      $content_date = Content_date::where('content_id',$content->id)
        ->where('start', '>=', date('Y-m-d 00:00:00'))
        ->where('start', '<=', $last_day)
        ->whereIn('status', [1,2,3])
        ->orderBy('start', 'asc')
        ->first();
    }

    if($content_date)
    {
      $content_date['title'] = Util::getContentDateStatus($content_date->status,'name',null);
      $content_date['color'] = Util::getContentDateStatus($content_date->status,'color',null);
      if($content_date->percent and $content_date->percent<100){
        $content_date['title'] = '割引' . $content_date['title'];
        $content_date['color'] = '#FF5722';
      }
    }
    $contents[$key]['content_date'] = $content_date;

    if($content->service===91){
      $contents[$key]['content_recruit_types'] = Content_recruit_type::where('content_id',$content->id)->first();
      $contents[$key]['menu']    = Content_menu_recruit::select('recruit_type_1','recruit_type_2','recruit_type_3')->where('content_id',$content->id)->first();
    }

    $contents[$key]['company'] = company::select('name')->where('user_id',$content->user_id)->first();
    if(!$contents[$key]['content_tags'] = Content_tags::where('content_id',$content->id)->first()){
      $contents[$key]['content_tags'] = [];
    }
    
  }

  return View::make('owner.profile.register', compact('company','company_code','owner_services','contents'));

}

public function postRegister(Request $request)
{

  $this->validate($request, [
    'name'                      => 'required|min:1|max:255',
    'company_code'              => 'required|exists:company_code,id',
    'company_type_first'        => 'required|exists:company_type_first,id',
    'company_type_second'       => 'exists:company_type_second,id',
    'country-area'              => 'required|exists:country_area,ken_id',
    'country-area-address-one'  => 'required|exists:city_address,city_id',
    'country-area-address-two'  => 'required|exists:town_address,town_id',
    'country-area-address-other'=> 'required|min:1|max:500',
    'homepage'                  => 'url',
    'email'                     => 'required|email',
    'in_charge_of_staff_name'   => 'required|min:1|max:255'
  ]);

  $tell = $request->get('tell');
  $tell = str_replace('-','',$tell);
  if( !ctype_digit($tell) ) return back()->with('warning', '電話番号は半角の数字とハイフンのみ有効です。')->withInput();
  if( !(strlen($tell)>=10 and strlen($tell)<=11) ) return back()->with('warning', '電話番号は10-11桁で登録してください。')->withInput();

  if(!$company = Company::where('user_id',Auth::user()->id)->first()){
    $company = new Company;
    $company->user_id = Auth::user()->id;
  }

  $company->grand_country_area_id = Util::areaUtil($request->get('country-area'));

  $company->name = $request->get('name');
  $company->company_code = $request->get('company_code');
  $company->company_type_first = $request->get('company_type_first');
  $company->company_type_second = $request->get('company_type_second');
  $company->country = 392;
  $company->country_area = $request->get('country-area');
  $company->country_area_address_one = $request->get('country-area-address-one');
  $company->country_area_address_two = $request->get('country-area-address-two');
  $company->country_area_address_other = $request->get('country-area-address-other');
  $company->address =
      Util::getCountryAreaName($company->country_area) .
      Util::getCountryAreaOneName($company->country_area_address_one) . 
      Util::getCountryAreaTwoName($company->country_area_address_two) . 
      $company->country_area_address_other;
  $company->homepage = $request->get('homepage');

  $company->tell = $tell;
  $company->email = $request->get('email');
  $company->in_charge_of_staff_name = $request->get('in_charge_of_staff_name');
  $company->save();

  $plan_serivce = [];
  foreach($request->all() as $key=>$val){
    if(strpos($key,'plan_')!==false){
      $plan_serivce[] = (int)$val;
    }
  }
  $plan_serivce[] = 91;

  if(!$owner_request = Owner_request::where('user_id',Auth::user()->id)->first()){
    $owner_request = new Owner_request;
    $owner_request->user_id = Auth::user()->id;
  }
  $owner_request->services = json_encode($plan_serivce);
  $owner_request->save();

  $data = array(
    'company' => $company,
  );
  Mail::send('emails.owner.request', $data, function ($m) use ($company) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to($company->email, $company->name);
    //$m->cc($company->email, $company->name);
    $m->subject('[Coordiy予約]オーナーリクエストを承りました。');
  });
  Mail::send('emails.owner.receive', $data, function ($m) use ($company) {
    $m->from('admin@coordiy.com', '[Coordiy予約]');
    $m->to('admin@coordiy.com', '[Coordiy予約]');
    $m->subject('[Coordiy予約]オーナーリクエストがあります。');
  });
  return redirect('/owner/register/done')->with('success', 'オーナーリクエスト承りました。');

}


public function ajaxGetCompanyTypeFirst(Request $request)
{
  
  $company_type_first = DB::table('company_type_first')->select('id','name')->get();
  return json_encode($company_type_first);

}

public function ajaxGetCompanyTypeSecond(Request $request)
{

  $company_type_first_id = $request->get('company_type_first');
  $company_type_second = DB::table('company_type_second')->where('company_type_first_id', $company_type_first_id)->get();
  return json_encode($company_type_second);

}



public function getProfile(Request $request)
{
  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  if(!$owner_services = owner_service::where('user_id', Utilowner::getOwnerId())->first()){
    $owner_services = new owner_service;
  }
  return View::make('owner.profile.profile', compact('company','owner_services'));
}

public function getProfileEdit(Request $request)
{
  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $owner_services = owner_service::where('user_id', Utilowner::getOwnerId())->first();
  $company_code = [];
  $company_code_tmp = company_code::get();
  foreach($company_code_tmp as $val){
    $company_code[$val->id] = $val->name;
  }
  return View::make('owner.profile.profileEdit', compact('company','company_code','owner_services'));
}

public function postProfileEdit(Request $request)
{

  $this->validate($request, [
    'name'                      => 'required|min:1|max:255',
    'company_code'              => 'exists:company_code,id',
    'country-area'              => 'required|exists:country_area,ken_id',
    'country-area-address-one'  => 'required|exists:city_address,city_id',
    'country-area-address-two'  => 'required|exists:town_address,town_id',
    'country-area-address-other'=> 'required|min:1|max:500',
    'homepage'                  => 'url',
    'description'               => 'max:2000'
  ]);

  if(!$company = Company::where('user_id',Utilowner::getOwnerId())->first()){
    return redirect('/owner/register')->with('success', '先にオーナーリクエストしてください。');
  }

  $tell = $request->get('tell');
  $tell = str_replace('-','',$tell);
  if( !ctype_digit($tell) ) return back()->with('warning', '電話番号は半角の数字とハイフンのみ有効です。')->withInput();
  if( !(strlen($tell)>=10 and strlen($tell)<=11) ) return back()->with('warning', '電話番号は10-11桁で登録してください。')->withInput();

  $company->grand_country_area_id = Util::areaUtil($request->get('country-area'));
  $company->name = $request->get('name');
  $company->company_code = $request->get('company_code');
  $company->company_type_first = $request->get('company_type_first');
  $company->company_type_second = $request->get('company_type_second');
  $company->country = 392;
  $company->country_area = $request->get('country-area');
  $company->country_area_address_one = $request->get('country-area-address-one');
  $company->country_area_address_two = $request->get('country-area-address-two');
  $company->country_area_address_other = $request->get('country-area-address-other');
  $company->address =
      Util::getCountryAreaName($company->country_area) .
      Util::getCountryAreaOneName($company->country_area_address_one) . 
      Util::getCountryAreaTwoName($company->country_area_address_two) . 
      $company->country_area_address_other;
  $company->homepage = $request->get('homepage');
  $company->tell = $tell;
  $company->description = $request->get('description');

  $mainPic = $request->file('mainPic');
  if($mainPic){
    $pic_size = filesize($mainPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/users/' . Utilowner::getOwnerId() . '/company/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $mainPic->extension();
    $company->pic = Util::formFileToImage($mainPic, $pic_path, $company->pic, $pic_name, $pic_type );  
  }

  $backPic = $request->file('backPic');
  if($backPic){
    $pic_size = filesize($backPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/users/' . Utilowner::getOwnerId() . '/company/';
    $pic_type = 'back_pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $backPic->extension();
    $company->back_pic = Util::formFileToImage($backPic, $pic_path, $company->back_pic, $pic_name, $pic_type );  
  }

  $company->save();

  //$plan_serivce = [];
  //foreach($request->all() as $key=>$val){
  //  if(strpos($key,'plan_')!==false){
  //    $plan_serivce[] = (int)$val;
  //  }
  //}
//
  //
  //if(!$owner_request = Owner_request::where('user_id',Utilowner::getOwnerId())->first()){
  //  $owner_request = new Owner_request;
  //  $owner_request->user_id = Utilowner::getOwnerId();
  //}
  //$owner_request->first = 0;
  //$owner_request->services = json_encode($plan_serivce);
  //$owner_request->save();

  return redirect('/owner/profile')->with('success', '変更しました。利用コンテンツの反映は少々お待ちください。');

}





public function getApi(Request $request)
{

  $company = Company::where('user_id',Utilowner::getOwnerId())->first();
  return View::make('owner.api.index', compact('company'));
  
}



public function getCalendar(Request $request)
{

  $company = Company::where('user_id',Utilowner::getOwnerId())->first();
  if(!$company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first()){
    $company_calendar = new Company_calendar;
    $company_calendar->company_id = $company->id;
  }
  return View::make('owner.profile.calendar', compact('company','company_calendar'));
  
}

public function getCalendarEdit(Request $request)
{

  $company = Company::where('user_id',Utilowner::getOwnerId())->first();
  if(!$company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first()){
    $company_calendar = new Company_calendar;
    $company_calendar->company_id = $company->id;
  }
  return View::make('owner.profile.calendarEdit', compact('company','company_calendar'));

}

public function postCalendarEdit(Request $request)
{
  
  $company = Company::select('id')->where('user_id',Utilowner::getOwnerId())->first();
  if(!$company_calendar = Company_calendar::where('company_id',$company->id)->whereNull('content_id')->first()){
    $company_calendar = new Company_calendar;
    $company_calendar->company_id = $company->id;
  }

  $ans = Utilowner::checkPublicClalendar($request);
  if($ans['err']){
    //return $ans;
    return back()->with('warning', $ans['message'])->withInput();
  }

  $company_calendar->open_24 = $request->get('open-24');

  $company_calendar->mon_end = $request->get('mon-end');
  $company_calendar->tue_end = $request->get('tue-end');
  $company_calendar->wed_end = $request->get('wed-end');
  $company_calendar->thu_end = $request->get('thu-end');
  $company_calendar->fri_end = $request->get('fri-end');
  $company_calendar->sat_end = $request->get('sat-end');
  $company_calendar->sun_end = $request->get('sun-end');
  $company_calendar->public_holiday_end = $request->get('public-holiday-end');
  $company_calendar->New_Year_Holiday_end = $request->get('New-Year-Holiday-end');

  $company_calendar->mon_end_junbi = $request->get('mon-end-junbi');
  $company_calendar->tue_end_junbi = $request->get('tue-end-junbi');
  $company_calendar->wed_end_junbi = $request->get('wed-end-junbi');
  $company_calendar->thu_end_junbi = $request->get('thu-end-junbi');
  $company_calendar->fri_end_junbi = $request->get('fri-end-junbi');
  $company_calendar->sat_end_junbi = $request->get('sat-end-junbi');
  $company_calendar->sun_end_junbi = $request->get('sun-end-junbi');
  $company_calendar->public_holiday_end_junbi = $request->get('public-holiday-end-junbi');
  $company_calendar->New_Year_Holiday_end_junbi = $request->get('New-Year-Holiday-end-junbi');

  $company_calendar->mon_start = $request->get('mon-start');
  $company_calendar->tue_start = $request->get('tue-start');
  $company_calendar->wed_start = $request->get('wed-start');
  $company_calendar->thu_start = $request->get('thu-start');
  $company_calendar->fri_start = $request->get('fri-start');
  $company_calendar->sat_start = $request->get('sat-start');
  $company_calendar->sun_start = $request->get('sun-start');
  $company_calendar->public_holiday_start = $request->get('public-holiday-start');
  $company_calendar->New_Year_Holiday_start = $request->get('New-Year-Holiday-start');

  $company_calendar->mon_start_junbi = $request->get('mon-start-junbi');
  $company_calendar->tue_start_junbi = $request->get('tue-start-junbi');
  $company_calendar->wed_start_junbi = $request->get('wed-start-junbi');
  $company_calendar->thu_start_junbi = $request->get('thu-start-junbi');
  $company_calendar->fri_start_junbi = $request->get('fri-start-junbi');
  $company_calendar->sat_start_junbi = $request->get('sat-start-junbi');
  $company_calendar->sun_start_junbi = $request->get('sun-start-junbi');
  $company_calendar->public_holiday_start_junbi = $request->get('public-holiday-start-junbi');
  $company_calendar->New_Year_Holiday_start_junbi = $request->get('New-Year-Holiday-start-junbi');
  
  $company_calendar->non_off = $request->get('non-off');
  $company_calendar->mon_off = $request->get('mon-off');
  $company_calendar->tue_off = $request->get('tue-off');
  $company_calendar->wed_off = $request->get('wed-off');
  $company_calendar->thu_off = $request->get('thu-off');
  $company_calendar->fri_off = $request->get('fri-off');
  $company_calendar->sat_off = $request->get('sat-off');
  $company_calendar->sun_off = $request->get('sun-off');
  $company_calendar->public_holiday_off = $request->get('public-holiday-off');
  $company_calendar->New_Year_Holiday_off = $request->get('New-Year-Holiday-off');

  $company_calendar->mon_end_nextday = $request->get('mon-end-nextday');
  $company_calendar->tue_end_nextday = $request->get('tue-end-nextday');
  $company_calendar->wed_end_nextday = $request->get('wed-end-nextday');
  $company_calendar->thu_end_nextday = $request->get('thu-end-nextday');
  $company_calendar->fri_end_nextday = $request->get('fri-end-nextday');
  $company_calendar->sat_end_nextday = $request->get('sat-end-nextday');
  $company_calendar->sun_end_nextday = $request->get('sun-end-nextday');
  $company_calendar->public_holiday_end_nextday = $request->get('public-holiday-end-nextday');
  $company_calendar->New_Year_Holiday_end_nextday = $request->get('New-Year-Holiday-end-nextday');

  $company_calendar->save();

  $contents = Contents::where('user_id',Utilowner::getOwnerId())->first();
  if(empty($contents)){
    return redirect('/owner/contents/create/first')->with('success', '次にコンテンツ(お店)を登録しましょう。');
  }else{
    return redirect('/owner/calendar')->with('success', '会社カレンダーを編集しました。');
  }
  
}
















public function getBank()
{
  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  if(!$user_bank = User_bank::where('user_id',Utilowner::getOwnerId())->first())
  {
    $user_bank = new User_bank;
  }
  return View::make('owner.profile.bank', compact('company','user_bank') );
}

public function getBankEdit()
{
  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $tmp = DB::table('bank')
    ->select('id','number','name')
    ->get();
  foreach($tmp as $v){
    $bank[$v->id] = $v->name . '(' . $v->number . ')';
  }
  if(!$user_bank = User_bank::where('user_id',Utilowner::getOwnerId())->first())
  {
    $user_bank = new User_bank;
  }
  return View::make('owner.profile.bankEdit', compact('company','bank','user_bank') );
}

public function postBankEdit(Request $request)
{

  $this->validate($request, [
    'bank_id'        => 'required|exists:bank,id',
      'shop_number'    => 'required|numeric|digits:3',
      'main_number'    => 'required|numeric|digits:7',
      'meigi'          => 'required|min:2|max:255'
  ]);

  if(!$user_bank = User_bank::where('user_id',Utilowner::getOwnerId())->first())
  {
    $user_bank = new User_bank;
    $user_bank->user_id = Utilowner::getOwnerId();
  }

  $user_bank->bank_id = $request->get('bank_id');
  $user_bank->shop_number = $request->get('shop_number');
  $user_bank->main_number = $request->get('main_number');
  $user_bank->meigi = $request->get('meigi');
  $user_bank->save();

  return redirect('/owner/bank')->with('success', '銀行の登録が完了しました。');
  
}




















}
