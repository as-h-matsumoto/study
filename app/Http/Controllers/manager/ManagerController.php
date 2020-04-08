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
use UtilYoyaku;
use phpQuery;
use QR_Code\Types\QR_Url;



class ManagerController extends Controller {

public function __construct()
{

}



public function createImage400(Request $request)
{

  $pic_path = '/global/img/';

  
  foreach(Util::getContentServices(null,'key',null) as $key=>$val){

    //main
    if(Storage::disk('public')->exists($pic_path . $val . '1_1600.jpeg')){
      logger('exists: ' . $pic_path . $val . '1_1600.jpeg');
      $pic1600 = Storage::disk('public')->get($pic_path . $val . '1_1600.jpeg');
      $pic400 = $val . '1_400.jpeg';
      Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
    }else{
      logger('none exists' . $pic_path . $val . '1_1600.jpeg');
    }

    //back
    if(Storage::disk('public')->exists($pic_path . $val . '1_back_1600.jpeg')){
      logger('exists: ' . $pic_path . $val . '1_back_1600.jpeg');
      $pic1600 = Storage::disk('public')->get($pic_path . $val . '1_back_1600.jpeg');
      $pic400 = $val . '1_back_400.jpeg';
      Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
    }else{
      logger('none exists' . $pic_path . $val . '1_back_1600.jpeg');
    }

    //capa
    if(Storage::disk('public')->exists($pic_path . 'capa_' . $val . '1_1600.jpeg')){
      logger('exists: ' . $pic_path . 'capa_' . $val . '1_1600.jpeg');
      $pic1600 = Storage::disk('public')->get($pic_path . 'capa_' . $val . '1_1600.jpeg');
      $pic400 = 'capa_' . $val . '1_400.jpeg';
      Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
    }else{
      logger('none exists' . $pic_path . $val . '1_1600.jpeg');
    }


  }


  //main
  if(Storage::disk('public')->exists($pic_path . 'company1_1600.jpeg')){
    logger('exists: ' . $pic_path . 'company1_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'company1_1600.jpeg');
    $pic400 = 'company1_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'company1_1600.jpeg');
  }

  //back
  if(Storage::disk('public')->exists($pic_path . 'company1_back_1600.jpeg')){
    logger('exists: ' . $pic_path . 'company1_back_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'company1_back_1600.jpeg');
    $pic400 = 'company1_back_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'company1_back_1600.jpeg');
  }


  //main
  if(Storage::disk('public')->exists($pic_path . 'content1_1600.jpeg')){
    logger('exists: ' . $pic_path . 'content1_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'content1_1600.jpeg');
    $pic400 = 'content1_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'content1_1600.jpeg');
  }

  //back
  if(Storage::disk('public')->exists($pic_path . 'content1_back_1600.jpeg')){
    logger('exists: ' . $pic_path . 'content1_back_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'content1_back_1600.jpeg');
    $pic400 = 'content1_back_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'content1_back_1600.jpeg');
  }


  //main
  if(Storage::disk('public')->exists($pic_path . 'user1_1600.jpeg')){
    logger('exists: ' . $pic_path . 'user1_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'user1_1600.jpeg');
    $pic400 = 'user1_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'user1_1600.jpeg');
  }

  //back
  if(Storage::disk('public')->exists($pic_path . 'user1_back_1600.jpeg')){
    logger('exists: ' . $pic_path . 'user1_back_1600.jpeg');
    $pic1600 = Storage::disk('public')->get($pic_path . 'user1_back_1600.jpeg');
    $pic400 = 'user1_back_400.jpeg';
    Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
  }else{
    logger('none exists' . $pic_path . 'user1_back_1600.jpeg');
  }

  

  for($i = 1; $i <= 10; $i++) {
    //main
    if(Storage::disk('public')->exists($pic_path . 'uranai'.$i.'_1600.jpeg')){
      logger('exists: ' . $pic_path . 'uranai'.$i.'_1600.jpeg');
      $pic1600 = Storage::disk('public')->get($pic_path . 'uranai'.$i.'_1600.jpeg');
      $pic400 = 'uranai'.$i.'_400.jpeg';
      Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
    }else{
      logger('none exists' . $pic_path . 'uranai'.$i.'_1600.jpeg');
    }
  }

  for($i = 2; $i <= 6; $i++) {
    //main
    if(Storage::disk('public')->exists($pic_path . 'user'.$i.'_1600.jpeg')){
      logger('exists: ' . $pic_path . 'user'.$i.'_1600.jpeg');
      $pic1600 = Storage::disk('public')->get($pic_path . 'user'.$i.'_1600.jpeg');
      $pic400 = 'user'.$i.'_400.jpeg';
      Util::managerFormFileToImage($pic1600, $pic_path, $pic400 );
    }else{
      logger('none exists' . $pic_path . 'user'.$i.'_1600.jpeg');
    }
  }

  
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


























public function createSitemap()
{

  return View::make('manager.sitemap');
  
}




public function createYoyakuSitemap2()
{

  echo 'start';
  $insert = '';
  $insert .= '<?xml version="1.0" encoding="UTF-8"?>';
  $insert .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  Storage::disk('public')->put('sitemap.xml', $insert);

  $yoyaku_type = UtilYoyaku::getNewMenuSenMonTenKey(null);

  $urls = '<url>';
  $urls .= '<loc>https://www.coordiy.com</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '<priority>1.0</priority>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/yoyaku/introduce</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '<priority>0.9</priority>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/yoyaku/introduce/owner</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '<priority>1.0</priority>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  foreach($yoyaku_type as $yoyaku_id=>$type){
    $urls = '';
    $urls .= '<url>';
    $urls .= '<loc>https://www.coordiy.com/yoyaku/introduce/owner/'.$type.'</loc>';
    $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
    $urls .= '<changefreq>monthly</changefreq>';
    $urls .= '<priority>1.0</priority>';
    $urls .= '</url>';
    Storage::disk('public')->append('sitemap.xml', $urls);
  }

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/terms</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/terms/customer</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/terms/owner</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);
  
  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/buy</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/photo_credit</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/update</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/privacy</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/cmn/isms</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>yearly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/yoyaku/map</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>daily</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/home</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code/email</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code/latlon</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code/tell</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code/sms</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/qr_code/wifi</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/confirm_character_count</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/confirm_latitude_longitude</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/confirm_year</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $urls = '';
  $urls .= '<url>';
  $urls .= '<loc>https://www.coordiy.com/benri/confirm_nearest_station</loc>';
  $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
  $urls .= '<changefreq>monthly</changefreq>';
  $urls .= '</url>';
  Storage::disk('public')->append('sitemap.xml', $urls);

  $country_area = DB::table('country_area')->select('ken_id')->where('country_id',392)->take(50)->get();
  foreach($country_area as $area){
    foreach($yoyaku_type as $yoyaku_id=>$type){
      $parameter = '?country_area_id=' . $area->ken_id . '&amp;yoyaku_type_id=' . $yoyaku_id;
      $urls = '';
      $urls .= '<url>';
      $urls .= '<loc>https://www.coordiy.com/yoyaku'.$parameter.'</loc>';
      $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
      $urls .= '<changefreq>daily</changefreq>';
      $urls .= '<priority>0.8</priority>';
      $urls .= '</url>';
      Storage::disk('public')->append('sitemap.xml', $urls);
      $yoyaku_type_tags = Util::getNewContentTag($yoyaku_id,null);
      foreach($yoyaku_type_tags as $yoyaku_tag_id=>$yoyaku_tag_name){
        $parameter = '?country_area_id=' . $area->ken_id . '&amp;yoyaku_type_id=' . $yoyaku_id . '&amp;yoyaku_type_tag_id=' . $yoyaku_tag_id;
        $urls = '';
        $urls .= '<url>';
        $urls .= '<loc>https://www.coordiy.com/yoyaku'.$parameter.'</loc>';
        $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
        $urls .= '<changefreq>daily</changefreq>';
        $urls .= '<priority>0.8</priority>';
        $urls .= '</url>';
        Storage::disk('public')->append('sitemap.xml', $urls);
      }
    }
  }
  
  Storage::disk('public')->append('sitemap.xml', '</urlset>');
  
  return back()->with('info', 'サイトマップを更新しました。');

}


public function createCoordSitemap()
{

  $insert = '';
  $insert .= '<?xml version="1.0" encoding="UTF-8"?>';
  $insert .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
  Storage::disk('public')->put('sitemap_coord.xml', $insert);

  $services = [
    '/',
    '/license/1/top',
    '/license/try/question',
    '/license/1/getLicensestudyArea',
    '/license/1/question/1/',
    '/license/1/getLicenseMustReadList',
    '/license/1/getLicenseHotWords',
    '/license/1/getLicenseStatistics',
    '/license/1/getLicenseTest',
    '/license/1/getLicenseSchedule',
    '/license/1/getLicenseData'
  ];

  foreach($services as $service){

    $urls = '';
    $urls .= '<url>';
    $urls .= '<loc>https://coord.coordiy.com'.$service.'</loc>';
    $urls .= '<lastmod>'.date('Y-m-d').'</lastmod>';
    $urls .= '<changefreq>daily</changefreq>';
    $urls .= '<priority>1.0</priority>';
    $urls .= '</url>';
    Storage::disk('public')->append('sitemap_coord.xml', $urls);

  }
  
  Storage::disk('public')->append('sitemap_coord.xml', '</urlset>');
  
  echo 'Update sitemap_coord.xml';

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
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    $mens = [];
    $content_date_users = Content_date_users::select('user_id')
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
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    $mens = [];
    $content_date_users = Content_date_users::select('user_id')
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
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    $sellNumber += Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
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
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    $sellNumber += Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
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
  for ($i = 1; $i <= 31; $i++) {
    if($start_day > $end_day){
      break;
    }
    if(
      $content_date_users = Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
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
              $sell += $content_date_user->price_sum;
              break;
          case 2:
              $sell += $content_date_user->price_sum;
              break;
          case 9:
              $sell += $content_date_user->cancel_price*0.92;
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
  for ($i = 1; $i <= 7; $i++) {
    if($start_day > $today){
      break;
    }
    if(
      $content_date_users = Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
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
              $sell += $content_date_user->price_sum;
              break;
          case 2:
              $sell += $content_date_user->price_sum;
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









public function dashboard()
{

 

  


  $sellAlltime = Content_sell_month::sum('payjp_sell');
  $customerAll = User::where('id','>',100)->count();
  $ownerAll = User::where('id','>',100)->where('owner',1)->count();

  $month = date("Y-m", strtotime('-1 month')) . '-01';
  $yoyaku_sell = 0;
  if($yoyaku_sell = Content_sell_month::where('date', '=', $month . ' 00:00:00')->sum('yoyaku_sell'))
  {
    $yoyaku_sell = $yoyaku_sell*(4/7);
  }

  $month_before = date("Y-m", strtotime('-2 month')) . '-01';
  $yoyaku_sell_before = 0;
  if($yoyaku_sell_before = Content_sell_month::where('date', '=', $month_before . ' 00:00:00')->sum('yoyaku_sell'))
  {
    $yoyaku_sell_before = $yoyaku_sell_before*(4/7);
  }
  
  return View('manager.dashboard', compact('company','sellAlltime','customerAll','ownerAll','yoyaku_sell','yoyaku_sell_before'));

}





























public function getCreateContentsSellMonth()
{
  return View::make('manager.owner.createContentsSellMonth', compact(''));
}

public function postCreateContentsSellMonth(Request $request)
{
 
  $contents = Contents::select('id','user_id')->where('admin_open',1)->where('delete_flug',0)->get();

  $date_start = date("Y-m", strtotime('-1 month')) . '-01';
  $date_end = date('Y-m-d', mktime(0, 0, 0, date('m'), 0, date('Y')));
  //logger($date_start);
  //logger($date_end);
  if($check = Content_sell_month::select('id')->where('date','=',$date_start)->first()){
    return back()->with('warning', '先月分は作成されています。');
  }
  $this->funcContentsSells($contents, $date_start, $date_end);

  $date_start = date("Y-m", strtotime('-2 month')) . '-01';
  $date_end = date('Y-m-d', mktime(0, 0, 0, date('m') - 1, 0, date('Y')));
  //logger($date_start);
  //logger($date_end);
  if($check = Content_sell_month::select('id')->where('date','=',$date_start)->first()){
    return back()->with('warning', '先月分は処理が完了しました。先々月分は作成されています。');
  }
  $this->funcContentsSells($contents, $date_start, $date_end);

  return back()->with('success', '処理が完了しました。');
  
}


function funcContentsSells($contents, $date_start, $date_end)
{
  
  foreach($contents as $content){
    $content_sell_month = new Content_sell_month;
    $content_sell_month->owner_id = $content->user_id;
    $content_sell_month->content_id = $content->id;
    $content_sell_month->date = $date_start;

    $sell = 0;
    $payjp_sell = 0;
    $send_bank = 0;
    $yoyaku_sell = 0;
    if(
      $content_date_users = Content_date_users::select('goin','price_sum','payment_sum','cancel_price')
      ->where('content_id', $content->id)
      ->whereIn('goin',[1,2,9])
      ->where('end', '>=', $date_start . ' 00:00:00')
      ->where('end', '<=', $date_end . ' 23:59:59')
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
              $payjp_sell += $content_date_user->payment_sum;
              break;
          case 9:
              $sell += $content_date_user->cancel_price;
              $payjp_sell += $content_date_user->cancel_price;
              break;
        }
      }
      $send_bank = $payjp_sell*0.92;
      $yoyaku_sell = $payjp_sell*0.08;
    }

    //logger('sell: ' . $sell);
    //logger('payjp_sell: ' . $payjp_sell);
    //logger('send_bank: ' . $send_bank);
    //logger('yoyaku_sell: ' . $yoyaku_sell);
    $content_sell_month->sell = $sell;
    $content_sell_month->payjp_sell = $payjp_sell;
    $content_sell_month->send_bank = $send_bank;
    $content_sell_month->yoyaku_sell = $yoyaku_sell;
    $content_sell_month->save();

  }

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










public function getPayOwner(Request $request)
{

  $companies =[];

  if($tmp = Owner_pay::where('status',0)->get()){
    foreach($tmp as $val){
      $companies[$val->user_id]['first'] = $val->first;
      $companies[$val->user_id]['company'] = Company::where('user_id', $val->user_id)->first();
      $companies[$val->user_id]['user'] = User::find($val->user_id);
    }
  }
  return View::make('manager.owner.pay', compact('companies'));
  
}



public function postPayOwner(Request $request)
{

  foreach($request->all() as $key => $val){
    
    if(strstr($key,'companyRequest')){
      $temp=explode('|',$val);
      $action = (int)$temp[0];
      $company_id = (int)$temp[1];
      $user_id = (int)$temp[2];

      $company = company::find($company_id);
      $owner_pay = Owner_pay::where('user_id',$user_id)->first();
      /*
      何もしない $action === 255
      非承認 $action === 0
      承認 $action === 1
      */
      if($action===255){
        continue;
      }elseif($action===0){
          $owner_pay->status=9;
          $owner_pay->save();
          $data = array(
            'company' => $company
          );
          Mail::send('emails.manager.owner.pay.deny', $data, function ($m) use ($company) {
            $m->from('admin@coordiy.com', '[Coordiy予約]');
            $m->to($company->email, $company->name);
            $m->bcc('admin@coordiy.com', '[Coordiy予約]');
            $m->subject('[Coordiy予約]ネット決済申請の結果について');
          });
      }elseif($action===1){

        $owner_pay->status=1;
        $owner_pay->save();
        $data = array(
          'company' => $company
        );
        Mail::send('emails.manager.owner.pay.permit', $data, function ($m) use ($company) {
          $m->from('admin@coordiy.com', '[Coordiy予約]');
          $m->to($company->email, $company->name);
          $m->bcc('admin@coordiy.com', '[Coordiy予約]');
          $m->subject('[Coordiy予約]ネット決済申請の結果について');
        });

      }

    }
  }

  return back()->with('success', '処理が終了しました。');

}

































public function getRequestOwner(Request $request)
{

  $companies =[];

  if($tmp = Owner_request::get()){
    foreach($tmp as $val){
      $companies[$val->user_id]['request_services'] = json_decode($val->services);
      $companies[$val->user_id]['first'] = $val->first;
      $companies[$val->user_id]['company'] = Company::where('user_id', $val->user_id)->first();
      $companies[$val->user_id]['user'] = User::find($val->user_id);
    }
  }
  return View::make('manager.owner.request', compact('companies'));
  
}



public function postRequestOwner(Request $request)
{

  foreach($request->all() as $key => $val){
    
    if(strstr($key,'companyRequest')){
      $temp=explode('|',$val);
      $action = (int)$temp[0];
      $company_id = (int)$temp[1];
      $user_id = (int)$temp[2];

      $company = company::find($company_id);
      $owner_request = Owner_request::where('user_id',$user_id)->first();
      /*
      何もしない $action === 255
      非承認 $action === 0
      承認 $action === 1
      */
      if($action===255){
        continue;
      }elseif($action===0){
        if($owner_request->first){
          //初期登録のDENY
        }else{
          //新しいコンテンツの利用はDENY
          $data = array(
            'company' => $company
          );
          Mail::send('emails.manager.owner.request.deny', $data, function ($m) use ($company) {
            $m->from('admin@coordiy.com', '[Coordiy予約]');
            $m->to($company->email, $company->name);
            $m->bcc('admin@coordiy.com', '[Coordiy予約]');
            $m->subject('[Coordiy予約]オーナーリクエストありがとうございます。');
          });
        }
      }elseif($action===1){

        $owner_request = Owner_request::where('user_id',$user_id)->first();
        if($owner_services = owner_service::where('user_id', $user_id)->first()){
          $owner_services->delete();
        }

        $owner_services = new owner_service;
        $owner_services->user_id = $user_id;
        $services = json_decode($owner_request->services);
        foreach(UtilYoyaku::getNewMenuSenMonTenKey(null) as $key=>$val){
          $owner_services->$val = (in_array($key, $services, true)) ? 1 : 0 ;
        }
        $owner_services->save();

        if($owner_request->first){
          //初期登録のみ実施
          $owner_super = User::find($user_id);
          $owner_super->owner = 1;
          $owner_super->owner_super_id = 0;
          $owner_super->save();
          
          $password = mt_rand();
          $owner_public = User::create([
              'name' => '[一般オーナー]' . $owner_super->name,
              'email' => 'public_' . $owner_super->email,
              'password' => bcrypt($password)
          ]);
          $owner_public->owner = 1;
          $owner_public->owner_super_id = $owner_super->id;
          $owner_public->verified = 1;
          $owner_public->status = 1;
          $owner_public->save();

          $data = array(
            'company' => $company,
            'owner_public' => $owner_public,
            'password' => $password
          );
          Mail::send('emails.manager.owner.request.permit', $data, function ($m) use ($company) {
            $m->from('admin@coordiy.com', '[Coordiy予約]');
            $m->to($company->email, $company->name);
            $m->bcc('admin@coordiy.com', '[Coordiy予約]');
            $m->subject('[Coordiy予約]オーナー登録が完了しました。');
          });
        }
      }
      $owner_request->delete();

    }
  }

  return back()->with('success', '処理が終了しました。');

}






public function getDeleteTrushOfContent()
{
  return View::make('manager.delete.content', compact(''));
}
public function postDeleteTrushOfContent(Request $request)
{
  $id = $request->get('id');
  $service = $request->get('service');
  $this->deleteContentValue($id, $service);
  return back()->with('success', '処理が終了しました。');
}

function deleteContentValue($id,$service)
{
  DB::table('company_calendar')->where('content_id',$id)->delete();
  DB::table('content_date')->where('content_id',$id)->delete();
  
  Util::deleteContentMenu(null, $id, UtilYoyaku::getNewMenuSenMonTenSummary($service), null, true);
  Util::deleteContentCapacity(null, $id, UtilYoyaku::getNewMenuSenMonTenSummary($service), null, true);
  
  DB::table('content_cancel_calendar')->where('content_id',$id)->delete();
  DB::table('contents_good')->where('content_id',$id)->delete();
  DB::table('contents_bad')->where('content_id',$id)->delete();
  return 1;
}
































public function getImportOwnerList(Request $request)
{

  if( $request->has('searchWords') ){
    $owners = User::where('csv',1)
      ->where('users.name', 'like', '%'.$request->get('searchWords').'%')
      ->take(25)->get();
  }else{
    $owners = User::where('csv',1)->take(25)->get();
  }
  
  foreach($owners as $key=>$owner){
    $owners[$key]['company'] = Company::where('user_id',$owner->id)->first();
    $owners[$key]['owner_services'] = owner_service::where('user_id',$owner->id)->first();
  }

  return View::make('manager.owner.import_list', compact('owners'));

}





public function postImportOwnerList(Request $request)
{

  exit;
  foreach($request->all() as $key => $val){
    
    if(strstr($key,'companyRequest')){
      $temp=explode('|',$val);
      $action = (int)$temp[0];
      $user_id = (int)$temp[1];

      $user = User::find($user_id);
      /*
      何もしない $action === 255
      非承認 $action === 0
      承認 $action === 1
      */
      if($action===255){
        continue;
      }elseif($action===0){
        if($owner_request->first){
          //初期登録のDENY
        }else{
          //新しいコンテンツの利用はDENY
        }
      }elseif($action===1){

        $company = company::where('user_id',$user->id)->first();

        $content = Contents::select('id','service')->where('user_id',$user->id)->first();
        $service = UtilYoyaku::getNewMenuSenMonTenKey($content->service);

        $address = [];
        $address[] = Util::getCountryAreaOneName($company->country_area_address_one);
        $address[] = Util::getCountryAreaTwoName($company->country_area_address_two);

        $data = array(
          'owner' => $user,
          'content' => $content,
          'address' => $address,
          'service' => $service
        );
        Mail::send('emails.manager.owner.import_done', $data, function ($m) use ($user) {
          $m->from('admin@coordiy.com', '[Coordiy予約]');
          $m->to($user->email, $user->name);
          $m->bcc('admin@coordiy.com', '[Coordiy予約]');
          $m->subject('[Coordiy予約]'.$user->name.'様の掲載がスタートしましたのでご連絡です。');
        });

        //$user->csv = 2;
        //$user->csv_password = '';
        //$user->save();

      }

    }
  }

  return back()->with('success', '処理が終了しました。');

}

























public function getRequestEditContent()
{

  $request_edit_contents = Request_edit_content::take(100)->get();
  foreach($request_edit_contents as $key=>$request_edit_content){
    $request_edit_contents[$key]['content'] = Contents::find($request_edit_content->content_id);
    $request_edit_contents[$key]['user'] = User::find($request_edit_content->user_id);
  }
  return View::make('manager.request.edit.content', compact('request_edit_contents'));
  
}



public function getGengoYearAdd()
{

  $years = Year_jp::get();
  $year_count = 1;
  $year_count_all = '';
  foreach($years as $year){

    if($year->gengo_change){
      $year_count_all = '';
      $gchenges = explode('/',$year->gengo_change);
      foreach($gchenges as $gchenge){
        if($year_count_all){
          $year_count_all .= '/' . $year_count;
        }else{
          $year_count_all = $year_count . '/1';
        }
        $year_count = 1;
      }
      Year_jp::where('id',$year->id)->update(['gengo_year'=>$year_count_all]);
    }else{
      Year_jp::where('id',$year->id)->update(['gengo_year'=>$year_count]);
    }

    $year_count++;

  }

  echo 'ok';
  
}



public function getGengoMasterAdd()
{

  $years = Year_jp::get();
  $year_count = 1;
  $year_count_all = '';
  foreach($years as $year){

    if($year->gengo_change){
      $gyears = explode('/',$year->gengo_year);
      $gengos = explode('/',$year->gengo);
      //print_r($gyears);
      //print_r($gengos);
      //print_r($gyears[0]);
      //print_r($gengos[0]);
      //exit;
      foreach($gyears as $key=>$gyear){
          //print_r($gengos[0]);
          //print_r($gyears[0]);
          print_r($year->id);
          
          //exit;

          DB::table('gengo_year')->insert([
            'gengo'=>$gengos[$key],
            'gengo_year'=>$gyears[$key],
            'year'=>$year->id,
            'updated_at' => date("Y-m-d H:i:s")
          ]);

      }

    }else{
      
      DB::table('gengo_year')->insert([
        'gengo'=>$year->gengo,
        'gengo_year'=>$year->gengo_year,
        'year'=>$year->id,
        'updated_at' => date("Y-m-d H:i:s")
      ]);
      
    }

  }

  echo 'ok';
  
}




}
