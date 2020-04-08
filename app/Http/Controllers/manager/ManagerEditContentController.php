<?php namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\company;
use App\models\company_code;
use App\models\Country_area;

use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;
use App\models\Owner_pay;

use App\models\Contents;
use App\models\Content_date_users;
use App\models\Content_tags;
use App\models\Content_new_tags;
use App\models\Content_menu_tags;

use App\models\Content_menu_lesson_tags;
use App\models\Content_menu_tour_tags;
use App\models\Content_menu_ticket_tags;

use App\models\Content_menu_lesson;
use App\models\Content_menu_tour;
use App\models\Content_menu_ticket;

use App\models\Content_sell_month;
use App\models\Request_edit_content;

use App\models\Year_jp;


use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use UtilYoyaku;
use phpQuery;
use QR_Code\Types\QR_Url;



class ManagerEditContentController extends Controller {

public function __construct()
{

}






public function getCheckContentNew(Request $request)
{

  if($request->has('country_area_id')){
    $country_area_id = (int)$request->get('country_area_id');
  }else{
    $country_area_id = 13;
  }
  if($request->has('country_area_address_one_id')){
    $country_area_address_one_id = (int)$request->get('country_area_address_one_id');
  }
  if($request->has('yoyaku_type_id')){
    $yoyaku_type_id = (int)$request->get('yoyaku_type_id');
  }else{
    $yoyaku_type_id = 90;
  }
  
  if($request->has('country_area_address_one_id')){
    if($request->has('searchWords')){
      $searchWords = $request->get('searchWords');
      $contents = Contents::select(
        'contents.id',
        'contents.service',
        'contents.name',
        'contents.pic',
        'contents.admin_open',
        'contents.homepage',
        'contents.tell',
        'contents.country_area_id',
        'contents.country_area_address_one',
        'contents.country_area_address_two',
        'contents.recommend_point',
        'contents.recommend_number',
        'users.email',
        'users.csv'
      )
      ->join('contents_check', 'contents.id', '=', 'contents_check.content_id')
      ->join('users', 'users.id', '=', 'contents.user_id')
      ->where('contents_check.id','>=',1)
      ->where('contents.name', 'like', '%'.$searchWords.'%')
      ->where('contents.country_area_id',$country_area_id)
      ->where('contents.country_area_address_one',$country_area_address_one_id)
      ->where('contents.service',$yoyaku_type_id)
      ->where('contents.admin_open', 1)
      ->orderBy('contents.recommend_number', 'asc')
      ->orderBy('contents.updated_at', 'asc')
      ->paginate(25);
      $contents->appends([
        'searchWords' => $searchWords,
        'country_area_id' => $country_area_id,
        'country_area_address_one_id' => $country_area_address_one_id,
        'yoyaku_type_id' => $yoyaku_type_id
      ])->links();
  }else{
      $contents = Contents::select(
        'contents.id',
        'contents.service',
        'contents.name',
        'contents.pic',
        'contents.admin_open',
        'contents.homepage',
        'contents.tell',
        'contents.country_area_id',
        'contents.country_area_address_one',
        'contents.country_area_address_two',
        'contents.recommend_point',
        'contents.recommend_number',
        'users.email',
        'users.csv'
      )
      ->join('contents_check', 'contents.id', '=', 'contents_check.content_id')
      ->join('users', 'users.id', '=', 'contents.user_id')
      ->where('contents_check.id','>=',1)
      ->where('contents.country_area_id',$country_area_id)
      ->where('contents.country_area_address_one',$country_area_address_one_id)
      ->where('contents.service',$yoyaku_type_id)
      ->where('contents.admin_open', 1)
      ->orderBy('contents.updated_at', 'asc')
      ->paginate(25);
      $contents->appends([
        'country_area_id' => $country_area_id,
        'country_area_address_one_id' => $country_area_address_one_id,
        'yoyaku_type_id' => $yoyaku_type_id
      ])->links();
    }
  }else{
    if($request->has('searchWords')){
        $searchWords = $request->get('searchWords');
        $contents = Contents::select(
          'contents.id',
          'contents.service',
          'contents.name',
          'contents.pic',
          'contents.admin_open',
          'contents.homepage',
          'contents.tell',
          'contents.country_area_id',
          'contents.country_area_address_one',
          'contents.country_area_address_two',
          'contents.recommend_point',
          'contents.recommend_number',
          'users.email',
          'users.csv'
        )
        ->join('contents_check', 'contents.id', '=', 'contents_check.content_id')
        ->join('users', 'users.id', '=', 'contents.user_id')
        ->where('contents_check.id','>=',1)
        ->where('contents.name', 'like', '%'.$searchWords.'%')
        ->where('contents.country_area_id',$country_area_id)
        ->where('contents.service',$yoyaku_type_id)
        ->where('contents.admin_open', 1)
        ->orderBy('contents.updated_at', 'asc')
        ->paginate(25);
        $contents->appends([
          'searchWords' => $searchWords,
          'country_area_id' => $country_area_id,
          'yoyaku_type_id' => $yoyaku_type_id
        ])->links();
    }else{
        $contents = Contents::select(
          'contents.id',
          'contents.service',
          'contents.name',
          'contents.pic',
          'contents.admin_open',
          'contents.homepage',
          'contents.tell',
          'contents.country_area_id',
          'contents.country_area_address_one',
          'contents.country_area_address_two',
          'contents.recommend_point',
          'contents.recommend_number',
          'users.email',
          'users.csv'
        )
        ->join('contents_check', 'contents.id', '=', 'contents_check.content_id')
        ->join('users', 'users.id', '=', 'contents.user_id')
        ->where('contents_check.id','>=',1)
        ->where('contents.country_area_id',$country_area_id)
        ->where('contents.service',$yoyaku_type_id)
        ->where('contents.admin_open', 1)
        ->orderBy('contents.updated_at', 'asc')
        ->paginate(25);
        $contents->appends([
          'country_area_id' => $country_area_id,
          'yoyaku_type_id' => $yoyaku_type_id
        ])->links();
    }
  }


  //logger($contents);
  foreach($contents as $key=>$content){
    $contents[$key]['content_tags'] = DB::table('content_tags')->where('content_id',$content->id)->first();
  }

  if ($request->has('page') or $request->has('ajax')) {
    return json_encode(View::make('manager.include.check_contents', array('contents' => $contents))->render());
  }

  return View::make('manager.check_contents', compact('contents'));
  
}


public function getOpenClose(Request $request)
{

  return 'ok';
  
}

public function postOpenClose(Request $request)
{

  $content_id = (int)$request->get('content_id');
  $content = Contents::find($content_id);
  $content->admin_open = ( $content->admin_open ) ? 0 : 1;
  $content->save();
  return ($content->admin_open) ? 'オープン' : 'クローズ' ;
  
}





public function postCheckContentNew(Request $request)
{

  //logger($request->all());
  
  $content_id = (int)$request->get('content_id');
  $content = Contents::find($content_id);

  if($content_tags = Content_tags::where('content_id',$content_id)->first()){
    $content_tags->delete();
  }
  $content_tags = new Content_tags;
  $content_tags->content_id = $content_id;
  foreach($request->all() as $key=>$val){
    if(strpos($key,'contentTag')!==false){
      $column = 'tag' . $val;
      $content_tags->$val = 1;
    }
  }
  $content_tags->save();
  
  return 'ok';
  
}




public function postShopDown(Request $request)
{

  //logger($request->all());
  
  $content_id = (int)$request->get('content_id');
  $content = Contents::find($content_id);

  $content->shop_down = ($content->shop_down===1) ? 9 : 1;

  $content->save();
  
  if($content->shop_down){
    return '営業停止';
  }else{
    return '営業';
  }

}

















public function getCheckContentMenu(Request $request)
{

  $content_tags = [];
  $content_menus = [];

  //対象コンテンツのすべてのメニューをチェックする
  $content_id = null;
  if($request->has('content_id')){

    $content_id = (int)$request->get('content_id');
    $content = Contents::select('service','name')->find($content_id);
    switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
      case 'lesson': $menus = Content_menu_lesson::where('content_id',$content_id)->paginate(25); break;
      case 'tour': $menus = Content_menu_tour::where('content_id',$content_id)->paginate(25); break;
      case 'ticket': $menus = Content_menu_ticket::where('content_id',$content_id)->paginate(25); break;
    }
    $menus->appends(['content_id' => $content_id])->links();

    foreach($menus as $key=>$menu){
      $menus[$key]['content_name'] = $content->name;
      $menus[$key]['content_service'] = $content->service;
      switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
        case 'lesson': $menus[$key]['content_menu_tags'] = Content_menu_lesson_tags::where('content_menu_lesson_id',$menu->id)->first();
        case 'tour': $menus[$key]['content_menu_tags'] = Content_menu_tour_tags::where('content_menu_tour_id',$menu->id)->first();
        case 'ticket': $menus[$key]['content_menu_tags'] = Content_menu_ticket_tags::where('content_menu_ticket_id',$menu->id)->first();
      }
    }
    
    
    

    if ($request->has('page') or $request->has('ajax')) {
      return json_encode(View::make('manager.include.check_menus', array('menus' => $menus))->render());
    }
  
    return View::make('manager.check_menus', compact('menus'));

  }


  $service = 4;
  if($request->has('service')){
    $service = (int)$request->get('service');
  }
  
  
  
  switch (UtilYoyaku::getNewMenuSenMonTenSummary($service)){
    case 'lesson': $table_menu = 'content_menu_lesson'; $table_check = 'content_menu_lesson_check';
        $menus = Content_menu_lesson::select(
          $table_menu.'.id as id',
          $table_menu.'.name as name',
          $table_menu.'.pic as pic',
          'contents.id as content_id',
          'contents.service as content_service',
          'contents.name as content_name'
        )
        ->join($table_check, $table_menu.'.id', '=', $table_check.'.'.$table_menu.'_id')
        ->join('contents', 'contents.id', '=', $table_menu.'.content_id')
        ->where($table_check.'.id','>=',1)
        ->paginate(25);
        break;
    case 'tour': $table_menu = 'content_menu_tour';   $table_check = 'content_menu_tour_check';
        $menus = Content_menu_tour::select(
          $table_menu.'.id as id',
          $table_menu.'.name as name',
          $table_menu.'.pic as pic',
          'contents.id as content_id',
          'contents.service as content_service',
          'contents.name as content_name'
        )
        ->join($table_check, $table_menu.'.id', '=', $table_check.'.'.$table_menu.'_id')
        ->join('contents', 'contents.id', '=', $table_menu.'.content_id')
        ->where($table_check.'.id','>=',1)
        ->paginate(25);
        break;
    case 'ticket': $table_menu = 'content_menu_ticket'; $table_check = 'content_menu_ticket_check';
        $menus = Content_menu_ticket::select(
          $table_menu.'.id as id',
          $table_menu.'.name as name',
          $table_menu.'.pic as pic',
          'contents.id as content_id',
          'contents.service as content_service',
          'contents.name as content_name'
        )
        ->join($table_check, $table_menu.'.id', '=', $table_check.'.'.$table_menu.'_id')
        ->join('contents', 'contents.id', '=', $table_menu.'.content_id')
        ->where($table_check.'.id','>=',1)
        ->paginate(25);
        break;
  }
  $menus->appends(['service' => $service])->links();

  foreach($menus as $key=>$menu){
    switch (UtilYoyaku::getNewMenuSenMonTenSummary($menu->content_service)){
      case 'lesson': $menus[$key]['content_menu_tags'] = Content_menu_lesson_tags::where('content_menu_lesson_id',$menu->id)->first(); break;
      case 'tour': $menus[$key]['content_menu_tags'] = Content_menu_tour_tags::where('content_menu_tour_id',$menu->id)->first();     break;
      case 'ticket': $menus[$key]['content_menu_tags'] = Content_menu_ticket_tags::where('content_menu_ticket_id',$menu->id)->first(); break;
    }
  }

  if ($request->has('page') or $request->has('ajax')) {
    return json_encode(View::make('manager.include.check_menus', array('menus' => $menus))->render());
  }

  return View::make('manager.check_menus', compact('menus','service'));
  
}







public function postCheckContentMenu(Request $request)
{

  //logger($request->all());
  
  $content_id = (int)$request->get('content_id');
  $content_menu_id = (int)$request->get('content_menu_id');
  $content = Contents::find($content_id);


  if($content->service===62){
    $table  = 'content_menu_lesson_check';
    $clomun = 'content_menu_lesson_id';
    if($content_menu_tags = Content_menu_lesson_tags::where('content_menu_lesson_id',$content_menu_id)->first()){
      $content_menu_tags->delete();
    }
    $content_menu_tags = new Content_menu_lesson_tags;
    $content_menu_tags->content_id = $content_id;
    $content_menu_tags->content_menu_lesson_id = $content_menu_id;
  }elseif($content->service===69){
    $table  = 'content_menu_tour_check';
    $clomun = 'content_menu_tour_id';
    if($content_menu_tags = Content_menu_tour_tags::where('content_menu_tour_id',$content_menu_id)->first()){
      $content_menu_tags->delete();
    }
    $content_menu_tags = new Content_menu_tour_tags;
    $content_menu_tags->content_id = $content_id;
    $content_menu_tags->content_menu_tour_id = $content_menu_id;
  }elseif($content->service===101){
    $table  = 'content_menu_ticket_check';
    $clomun = 'content_menu_ticket_id';
    if($content_menu_tags = Content_menu_ticket_tags::where('content_menu_ticket_id',$content_menu_id)->first()){
      $content_menu_tags->delete();
    }
    $content_menu_tags = new Content_menu_ticket_tags;
    $content_menu_tags->content_id = $content_id;
    $content_menu_tags->content_menu_ticket_id = $content_menu_id;
  }

  foreach($request->all() as $key=>$val){
    if(strpos($key,'contentTag')!==false){
      $column = 'tag' . $val;
      $content_menu_tags->$val = 1;
    }
  }
  $content_menu_tags->save();

  DB::table($table)->where($clomun,$content_menu_id)->delete();

  return 'ok';
  
}







public function getAddressEdit_01(Request $request)
{

  $contents = Contents::select('id')->get();
  
  foreach($contents as $tmp){

    $content = Contents::find($tmp->id);
    if($content->id<=860579) continue;
    $ad_address = DB::table('ad_address')
          ->where('town_id', $content->country_area_address_two)
          ->first();
    $original = $ad_address->ken_name . $ad_address->city_name . $ad_address->town_name;
    //logger($cut);
    $cut = mb_substr($original, 1, mb_strlen($original));
    //logger($original);
    //logger($cut);

    $ans = str_replace($cut, '', $content->country_area_address_other);
    $content->country_area_address_other = $ans;
    $content->address = $original . $ans;
    $content->save();

  }

  return 'ok';
  //return View::make('manager.latlon_contents', compact('test'));

}





public function getLatlon(Request $request)
{

  $contents = Contents::where('id','<=',100)->get();
  return 'ok';
  //return View::make('manager.latlon_contents', compact('test'));

}






public function postLatlon(Request $request)
{

  $google_leapis_url = "https://maps.googleapis.com/maps/api/geocode/json";
  $contents = DB::table('contents')
    ->select('id','user_id','country_area_id','country_area_address_one','country_area_address_two','country_area_address_other')
    ->whereNull('latitude')
    ->orderBy('id')
    ->take(2000000)
    ->get();

  foreach($contents as $key => $content){

    $url_encode = rawurlencode($content->country_area_address_other);

    $googleMapsApiData = json_decode(file_get_contents($google_leapis_url."?address=".$url_encode."&key=AIzaSyA6D8nAecIr1cvbbd-iqf2ctxk4RODCyJk", false), true);
    // 緯度経度を取得
    //logger($googleMapsApiData);

    $status = $googleMapsApiData["status"];
    //logger('content: ' . $content->id . ' status: ' . $status);
    if($status=='OK'){
    }elseif($status=='ZERO_RESULTS'){
      continue;
    }else{
      //logger('end id: ' . $content->id);
      exit;
    }

    $lat    = $googleMapsApiData["results"][0]["geometry"]["location"]["lat"];
    $lng    = $googleMapsApiData["results"][0]["geometry"]["location"]["lng"];

    DB::table('contents')->where('id',$content->id)->update(['latitude'=>$lat,'longitude'=>$lng]);

  }

  echo 'end';

}




public function postLatlonReverce(Request $request)
{

  $google_leapis_url = "https://maps.googleapis.com/maps/api/geocode/json";
  $contents = DB::table('contents')
    ->select('id','user_id','country_area_id','country_area_address_one','country_area_address_two')
    ->where('id','<=',712101)
    ->whereNull('latitude')
    ->orderBy('id','desc')
    ->take(2000000)
    ->get();

  foreach($contents as $key => $content){

    $country_area = Util::getCountryAreaName($content->country_area_id);
    $country_area_address_one = Util::getCountryAreaOneName($content->country_area_address_one);
    $country_area_address_two = Util::getCountryAreaTwoName($content->country_area_address_two);
    $other = DB::table('company')->where('user_id',$content->user_id)->first();
    $url_encode = rawurlencode($country_area . $country_area_address_one . $country_area_address_two . $other->country_area_address_other);

    $googleMapsApiData = json_decode(file_get_contents($google_leapis_url."?address=".$url_encode."&key=AIzaSyA6D8nAecIr1cvbbd-iqf2ctxk4RODCyJk", false), true);
    // 緯度経度を取得
    //logger($googleMapsApiData);

    $status = $googleMapsApiData["status"];
   //'content: ' . $content->id . ' status: ' . $status);
    if($status=='OK'){
    }elseif($status=='ZERO_RESULTS'){
      continue;
    }else{
      //logger('end id: ' . $content->id);
      exit;
    }

    $lat    = $googleMapsApiData["results"][0]["geometry"]["location"]["lat"];
    $lng    = $googleMapsApiData["results"][0]["geometry"]["location"]["lng"];

    DB::table('contents')->where('id',$content->id)->update(['latitude'=>$lat,'longitude'=>$lng]);

  }

  echo 'end';

}






public function getAddressOther(Request $request)
{

  return View::make('manager.getAddressOther', compact('test'));

}


public function getAddressOtherPut(Request $request)
{

  $contents = DB::table('contents')
    ->select('id','user_id')
    ->take(2000000)
    ->get();

  foreach($contents as $content){
    $company = DB::table('company')->select('country_area_address_other')->where('user_id',$content->user_id)->first();
    DB::table('contents')->where('id',$content->id)->update(['country_area_address_other'=>$company->country_area_address_other]);
  }

  echo 'ok';

}






public function getImportStations()
{

  return View::make('manager.station.import');
  
}



public function postImportStations(Request $request)
{

  //[0] => 門仲はりきゅう整骨院 
  //[1] => 135-0041
  //[2] => ２丁 naniti 4F
  //[3] => 03-3820-1234
  //[4] => tour
  //[5] => https://test40.com
  //[6] => test40@coordiy.ssee

  //logger($request->all());
  
  // CSVファイルをサーバーに保存
  $temporary_csv_file = $request->file('csv')->store('csv');

  //$fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');
  $file = new \SplFileObject(storage_path('app/') . $temporary_csv_file, 'r');
  $file->setFlags(\SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $count = 1;
  $errors = [];

  foreach ($file as $n => $row) {
      //logger('in');
      if(!$row){
        //logger('empty');
        break;
      }
      if($count===1){
        $count++;
        continue;
      }
      $ans = explode(',',$row);
      
      //logger($ans);
      $count++;
      //if($count>10) return 'ok';
      //continue;

      DB::table('stations')->insert([
        'id'=>$ans[0],
        'station_g_cd'=>$ans[1],
        'station_name'=>$ans[2],
        'station_name_k'=>$ans[3],
        'station_name_r'=>$ans[4],
        'line_cd'=>$ans[5],
        'pref_cd'=>$ans[6],
        'post'=>$ans[7],
        'add'=>$ans[8],
        'lon'=>$ans[9],
        'lat'=>$ans[10],
        'open_ymd'=>$ans[11],
        'close_ymd'=>$ans[12],
        'e_status'=>$ans[13],
        'e_sort'=>$ans[14],
        //'created_at' => null,
        'updated_at' => date("Y-m-d H:i:s")
      ]);
  }

  echo '
    end
  ';
  echo '
  
  ';
  echo '<a href="/manager/station/list">駅リスト</a>';
  echo '

  ';
  echo '<a href="/manager/station/import">駅インポート</a>';
  
  
}

public function getStationList()
{

  $stations = DB::table('stations')->take(100)->get();
  return View::make('manager.station.list', compact('stations'));
  
}



public function getStationsDistance()
{


  function location_distance($lat1, $lon1, $lat2, $lon2){
    $lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );//２点の緯度の平均
    $lat_difference = deg2rad( $lat1 - $lat2 );//２点の緯度差
    $lon_difference = deg2rad( $lon1 - $lon2 );//２点の経度差
    $curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
    $meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
    $prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径

    //２点間の距離
    $distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
    $distance = sqrt($distance);

    $distance_unit = round($distance);
    if($distance_unit < 1000){//1000m以下ならメートル表記
      $distance_unit = $distance_unit."m";
    }else{//1000m以上ならkm表記
      $distance_unit = round($distance_unit / 100);
      $distance_unit = ($distance_unit / 10)."km";
    }

    //$hoge['distance']で小数点付きの直線距離を返す（メートル）
    //$hoge['distance_unit']で整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以下は小数点第一位以上の数をkmで記述 例：2.8km）
    return array("distance" => $distance, "distance_unit" => $distance_unit);

  }

  
  $contents = DB::table('contents')
    ->select('id','latitude','longitude','country_area_address_two')
    ->get();

  foreach($contents as $content){

    //logger('content_id: ' .$content->id);
    
    if( !($content->latitude and $content->longitude and $content->country_area_address_two ) ){
      continue;
    }

    $ad_address = DB::table('ad_address')->select('zip')->where('town_id',$content->country_area_address_two)->first();
    //logger($ad_address->zip);
    $stations = DB::table('stations')->select('id','station_name','lon','lat')->where('post','=',$ad_address->zip)->where('e_status',0)->take(3)->get();
    if( empty($stations) ){
      $zip_edit = substr($ad_address->zip, 0, 3);
      //logger($zip_edit);
      $stations = DB::table('stations')->where('post','like',$zip_edit.'%')->where('e_status',0)->take(3)->get();
      if( empty($stations) ){
        $zip_edit = substr($ad_address->zip, 0, 2);
        //logger($zip_edit);
        $stations = DB::table('stations')->where('post','like',$zip_edit.'%')->where('e_status',0)->take(3)->get();
      }
    }

    if( empty($stations) ) continue;

    $lat1 = $content->latitude;
    $lon1 = $content->longitude;
    $ans = null;
    $station_id = null;
    $station_name = null;
    $mostleast = 99999999999999;
    foreach($stations as $k => $v){
      $lat2 = $v->lat;
      $lon2 = $v->lon;
      $long=location_distance($lat1, $lon1, $lat2, $lon2);
      DB::table('contents_stations')->insert(['content_id'=>$content->id, 'station_id'=>$v->id, 'station_name'=>$v->station_name, 'station_distance'=>$long['distance']]);
      if($long['distance'] < $mostleast){
        $mostleast = $long['distance'];
        $station_id = $v->id;
        $station_name = $v->station_name;
      }
      
    }

    DB::table('contents')->where('id',$content->id)->update([
      'station_id'=>$station_id,
      'station_name'=>$station_name,
      'station_distance'=>$mostleast
    ]);

  }

  echo 'ok';
  
}








public function getImportStationLine()
{

  return View::make('manager.station_line.import');
  
}



public function postImportStationLine(Request $request)
{
  
  // CSVファイルをサーバーに保存
  $temporary_csv_file = $request->file('csv')->store('csv');

  //$fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');
  $file = new \SplFileObject(storage_path('app/') . $temporary_csv_file, 'r');
  $file->setFlags(\SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $count = 1;
  $errors = [];

  foreach ($file as $n => $row) {
      //logger('in');
      if(!$row){
        //logger('empty');
        break;
      }
      if($count===1){
        $count++;
        continue;
      }
      $ans = explode(',',$row);
      
      //logger($ans);
      //$count++;
      //if($count>10) return 'ok';
      //continue;

      DB::table('station_line')->insert([
        'id'=>$ans[0],
        'company_cd'=>$ans[1],
        'line_name'=>$ans[2],
        'line_name_k'=>$ans[3],
        'line_name_k'=>$ans[4],
        'line_color_c'=>$ans[5],
        'line_color_t'=>$ans[6],
        'line_type'=>$ans[7],
        'lon'=>$ans[8],
        'lat'=>$ans[9],
        'zoom'=>$ans[10],
        'e_status'=>$ans[11],
        'e_sort'=>$ans[12],
        'updated_at' => date("Y-m-d H:i:s")
      ]);
  }

  echo '
    end
  ';
  echo '
  
  ';
  echo '<a href="/manager/station_line/list">路線リスト</a>';
  echo '

  ';
  echo '<a href="/manager/station_line/import">路線インポート</a>';
  
  
}

public function getStationLineList()
{

  $station_lines = DB::table('station_line')->take(100)->get();
  return View::make('manager.station_line.list', compact('station_lines'));
  
}











}
