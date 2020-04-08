<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\Contents;
use App\models\content_date_users;
use App\models\Content_cancel_calendar;
use App\models\Content_discount;
use App\models\company;
use App\models\Place;

use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsDiscountController extends Controller {

public function __construct()
{

}




public function getDiscountEdit(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);

  if($content->service===85 or $content->service===89 or $content->service===39){
    if(!Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null)){
      $to = '/owner/contents/' . $content->id . '/capacity/edit';
      return redirect($to)->with('warning', '先に「' . UtilYoyaku::getNewContentCapacity($content->service) . '」を登録してください。');
    }
  }else{
    $to = '/owner/contents/' . $content->id . '/menu/edit';
    return redirect($to);
  }

  if(!$content_discount = Content_discount::where('content_id',$id)->first()){
    $content_discount = new Content_discount;
  }

  return View('owner.contents.discount.discountEdit', compact('content','content_discount'));

}



public function postDiscountEdit(Request $request, $id)
{

  $this->validate($request, [
    'hour1'   => 'min:0|max:100',
    'hour2'   => 'min:0|max:100',
    'hour3'   => 'min:0|max:100',
    'hour4'   => 'min:0|max:100',
    'hour5'   => 'min:0|max:100',
    'hour6'   => 'min:0|max:100',
    'hour7'   => 'min:0|max:100',
    'hour8'   => 'min:0|max:100',
    'hour9'   => 'min:0|max:100',
    'hour10'  => 'min:0|max:100',
    'hour11'  => 'min:0|max:100',
    'hour12'  => 'min:0|max:100',
    'day2'    => 'min:0|max:100',
    'day3'    => 'min:0|max:100'
  ]);

  $ans = ['err'=>0, 'message'=>''];

  if(!$content_discount = Content_discount::where('content_id',$id)->first()){
    $content_discount = new Content_discount;
    $content_discount->content_id = $id;
  }

  $last_day = date('Y-m-d', mktime(0, 0, 0, date('m') + 3, 0, date('Y')));
  if(
    $content_date_users = Content_date_users::where('content_id', $id)
    ->whereIn('goin',[1,2])
    ->where('start', '>=', date('Y-m-d H:i:s'))
    ->where('start', '<=', $last_day)
    ->first()
    )
  {
    $message = '編集しました。今予約している方は変更前の割引率が適用されます。';
  }else{
    $message = '編集しました。';
  }
  
  $content_discount->hour1  = ($request->get('hour1'))  ? $request->get('hour1')  : 0;
  $content_discount->hour2  = ($request->get('hour2'))  ? $request->get('hour2')  : 0;
  $content_discount->hour3  = ($request->get('hour3'))  ? $request->get('hour3')  : 0;
  $content_discount->hour4  = ($request->get('hour4'))  ? $request->get('hour4')  : 0;
  $content_discount->hour5  = ($request->get('hour5'))  ? $request->get('hour5')  : 0;
  $content_discount->hour6  = ($request->get('hour6'))  ? $request->get('hour6')  : 0;
  $content_discount->hour7  = ($request->get('hour7'))  ? $request->get('hour7')  : 0;
  $content_discount->hour8  = ($request->get('hour8'))  ? $request->get('hour8')  : 0;
  $content_discount->hour9  = ($request->get('hour9'))  ? $request->get('hour9')  : 0;
  $content_discount->hour10 = ($request->get('hour10')) ? $request->get('hour10') : 0;
  $content_discount->hour11 = ($request->get('hour11')) ? $request->get('hour11') : 0;
  $content_discount->hour12 = ($request->get('hour12')) ? $request->get('hour12') : 0;
  $content_discount->day2   = ($request->get('day2')) ? $request->get('day2') : 0;
  $content_discount->day3   = ($request->get('day3')) ? $request->get('day3') : 0;
  $content_discount->save();

  return redirect('/owner/contents/' . $id . '/cancel/edit')->with('success', $message);

}









}