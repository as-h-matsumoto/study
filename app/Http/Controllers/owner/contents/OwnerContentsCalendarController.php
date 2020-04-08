<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Contents;
use App\models\company;
use App\models\Company_calendar;
use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;

use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsCalendarController extends Controller {

public function __construct()
{

}



public function getCalendar(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  return View('owner.contents.capacity.calendar', compact('content','company'));

}



public function getCalendarEdit(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  return View('owner.contents.capacity.calendarEdit', compact('content','company'));

}



public function postCalendarEdit(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  return redirect('/owner/contents/' . $content->id . '/calendar')->with('success', '正常に登録されました。');

}









}