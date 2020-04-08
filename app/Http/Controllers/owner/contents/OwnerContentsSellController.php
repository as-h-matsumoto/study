<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Contents;
use App\models\Content_date_users;
use App\models\Content_sell_month;
use App\models\company;
use App\models\Owners_users;
use App\models\Owners_users_used_content;





use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsSellController extends Controller {


public function __construct()
{

}








public function index(Request $request, $id)
{

  $content = Contents::find($id);

  
  $to_month_farst = date("Y-m") . '-01';
  $to_month_end = date("Y-m-d", strtotime('-1 day'));
  $sellAlltime = Content_sell_month::where('content_id',$id)->sum('sell');
  $sellAlltime += Content_date_users::where('content_id',$id)
    ->where('end','>=',$to_month_farst . ' 00:00:00')
    ->where('end','<=',$to_month_end . ' 23:59:59')
    ->sum('payment_sum');

  $customerAll = Owners_users_used_content::where('content_id',$content->id)->count();

  $month = date("Y-m", strtotime('-1 month')) . '-01';
  if($content_sell_month = Content_sell_month::select('send_bank')
      ->where('content_id', $id)
      ->where('date', '=', $month . ' 00:00:00')
      ->first())
  {
    $send_bank = $content_sell_month->send_bank;
  }else{
    $send_bank = 0;
  }

  $month_before = date("Y-m", strtotime('-2 month')) . '-01';
  if($content_sell_month_before = Content_sell_month::select('send_bank')
      ->where('content_id', $id)
      ->where('date', '=', $month_before . ' 00:00:00')
      ->first())
  {
    $send_bank_before = $content_sell_month_before->send_bank;
  }else{
    $send_bank_before = 0;
  }
  
  return View('owner.contents.sell.index', compact('content','sellAlltime','customerAll','send_bank','send_bank_before'));

}










public function ajaxGetCustomerMonth(Request $request, $id)
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
      ->where('content_id', $id)
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

public function ajaxGetCustomerWeek(Request $request, $id)
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
      ->where('content_id', $id)
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






























public function ajaxGetSellNumberMonth(Request $request, $id)
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
      ->where('content_id', $id)
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

public function ajaxGetSellNumberWeek(Request $request, $id)
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
      ->where('content_id', $id)
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






















public function ajaxGetSellMonth(Request $request, $id)
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
      ->where('content_id', $id)
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

public function ajaxGetSellWeek(Request $request, $id)
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
      ->where('content_id', $id)
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
























public function getSell(Request $request, $id)
{

  if($content_date_users = Content_date_users::where('content_id',$id)->whereIn('goin',[1,2,9])->orderBy('start','desc')->paginate(25)){
    foreach($content_date_users as $key=>$content_date_user){
      $user = User::select('name')->find($content_date_user->user_id);
      $content_date_users[$key]['name'] = $user->name;
      $content_date_users[$key]['start_jp'] = date('Y年m月d日 H:i', strtotime($content_date_user->start));
      $content_date_users[$key]['price_sum_cunm'] = number_format($content_date_user->price_sum);
      $status = '';
      switch ($content_date_user->goin) {
        case 1:
            $status = '直接支払い';
            break;
        case 2:
            $status = 'ネット決済';
            break;
        case 9:
            $status = 'キャンセル';
            break;
      }
      $content_date_users[$key]['status_jp'] = $status;
    }
  }else{
    $content_date_users = [];
  }

  return $content_date_users;

}











}