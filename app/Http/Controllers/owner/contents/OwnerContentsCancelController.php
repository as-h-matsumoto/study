<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


use App\models\Contents;
use App\models\Content_discount;
use App\models\Content_date_users;

use App\models\Content_cancel_calendar;
use App\models\company;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsCancelController extends Controller {

public function __construct()
{

}




public function getCancelEdit(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);

  if($content->service===85 or $content->service===89 or $content->service===39){
    if(!$content_discount = Content_discount::where('content_id',$content->id)->first()){
      $to='/owner/contents/' . $id . '/discount/edit';
      return redirect($to)->with('warning', '先に「割引」を設定してください。');
    }
  }else{
    if(!Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null)){
      $to = '/owner/contents/' . $content->id . '/menu/edit';
      return redirect($to)->with('warning', '先に「メニュー」を登録してください。');
    }
  }

  if($content->service===91){
    $to = '/owner/contents/' . $content->id . '/menu/edit';
    return redirect($to)->with('warning', 'このサービスは設定できません。');
  }

  if(!$content_cancel_calendar = Content_cancel_calendar::where('content_id',$id)->first()){
    $content_cancel_calendar = new Content_cancel_calendar;
  }

  return View('owner.contents.cancel.cancelEdit', compact('content','company','content_cancel_calendar'));

}



public function postCancelEdit(Request $request, $id)
{

  $this->validate($request, [
    'day1'   => 'min:0|max:100',
    'day2'   => 'min:0|max:100',
    'day3'   => 'min:0|max:100',
    'day4'   => 'min:0|max:100',
    'day5'   => 'min:0|max:100',
    'day6'   => 'min:0|max:100',
    'day7'   => 'min:0|max:100',
    'day8'   => 'min:0|max:100',
    'day9'   => 'min:0|max:100',
    'day10'   => 'min:0|max:100',
    'day11'   => 'min:0|max:100',
    'day12'   => 'min:0|max:100',
    'day13'   => 'min:0|max:100',
    'day14'   => 'min:0|max:100',
    'day15'   => 'min:0|max:100'
  ]);

  $ans = ['err'=>0, 'message'=>''];

  if(!$content_cancel_calendar = Content_cancel_calendar::where('content_id',$id)->first()){
    $content_cancel_calendar = new Content_cancel_calendar;
    $content_cancel_calendar->content_id = $id;
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
    return back()->with('warning', 'ご予約者様がいるので変更できません。');
  }
  
  $content_cancel_calendar->day1 =  ($request->get('day1'))  ? $request->get('day1')  : 0;
  $content_cancel_calendar->day2 =  ($request->get('day2'))  ? $request->get('day2')  : 0;
  $content_cancel_calendar->day3 =  ($request->get('day3'))  ? $request->get('day3')  : 0;
  $content_cancel_calendar->day4 =  ($request->get('day4'))  ? $request->get('day4')  : 0;
  $content_cancel_calendar->day5 =  ($request->get('day5'))  ? $request->get('day5')  : 0;
  $content_cancel_calendar->day6 =  ($request->get('day6'))  ? $request->get('day6')  : 0;
  $content_cancel_calendar->day7 =  ($request->get('day7'))  ? $request->get('day7')  : 0;
  $content_cancel_calendar->day8 =  ($request->get('day8'))  ? $request->get('day8')  : 0;
  $content_cancel_calendar->day9 =  ($request->get('day9'))  ? $request->get('day9')  : 0;
  $content_cancel_calendar->day10 = ($request->get('day10')) ? $request->get('day10') : 0;
  $content_cancel_calendar->day11 = ($request->get('day11')) ? $request->get('day11') : 0;
  $content_cancel_calendar->day12 = ($request->get('day12')) ? $request->get('day12') : 0;
  $content_cancel_calendar->day13 = ($request->get('day13')) ? $request->get('day13') : 0;
  $content_cancel_calendar->day14 = ($request->get('day14')) ? $request->get('day14') : 0;
  $content_cancel_calendar->day15 = ($request->get('day15')) ? $request->get('day15') : 0;

  $content_cancel_calendar->save();

  return redirect('/owner/contents/' . $id . '/date/edit')->with('success', '編集しました。');

}









}