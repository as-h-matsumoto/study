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
use phpQuery;
use QR_Code\Types\QR_Url;



class ManagerKijiController extends Controller {

public function __construct()
{

}









public function index(Request $request)
{

  $feed = \Feeds::make('http://ascii.jp/rss.xml');
  //print_r($feed);
  //echo $feed->get_title();
  //exit;
  $data = array(
    'title'     => $feed->get_title(),
    'permalink' => $feed->get_permalink(),
    'items'     => $feed->get_items(),
  );
  
}













































public function getCheckRecommends(Request $request)
{

  $recommends_number = Recommends::where('table_name','contents')
  ->where('admin_open',0)
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
    'recommends.pic',
    'recommends.good_number',
    'recommends.bad_number',
    'recommends.created_at',
    'recommends.updated_at',
    'users.name as user_name',
    'users.pic as user_pic'
  )
  ->join('users', 'users.id', '=', 'recommends.user_id')
  ->where('recommends.table_name','contents')
  ->where('recommends.admin_open',0)
  ->orderBy('recommends.updated_at', 'desc')
  ->paginate(25);

  foreach($recommends as $key=>$val){
    $recommends[$key]['content'] = DB::table($val->table_name)->select('id','name')->find($val->table_id);
  }
  
  if ($request->has('page')) {
    return json_encode(View::make('manager.include.recommend_more', array('recommends'=>$recommends))->render());
  }
  
  return View::make('manager.check_recommends', compact('recommends'));
  
}






public function postCheckRecommends(Request $request)
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
  

  $recommend_id = $request->get('recommend_id');
  $recommend = Recommends::find($recommend_id);
  $recommend->admin_open = 1;
  $recommend->save();

  $content = Contents::find($recommend->table_id);
  $content->recommend_number= Recommends::where('table_name','contents')
    ->where('table_id',$content->id)
    ->where('admin_open',1)
    ->count();
  $reco_point_sum = Recommends::where('table_name','contents')
    ->where('table_id',$content->id)
    ->where('admin_open',1)
    ->sum('point');
  $content->recommend_point= $reco_point_sum/$content->recommend_number;
  $content->save();

  return 'ok';
  
}













}
