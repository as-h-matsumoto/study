<?php namespace App\Http\Controllers\owner\license\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

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
use App\models\License_question_theme;
use App\models\License_schedule;
use App\models\License_schedule_examination_subject;
use App\models\License_schedule_pass_rate;
use App\models\License_schedule_statistics;
use App\models\Literature;

use App\models\License_question_try_master;
use App\models\License_question_try_answer;
use App\models\License_question_try_score;

use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;
use App\models\Owners_users;

use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use Utilowner;
use UtilYoyaku;
use DateTime;

class OwnerLicenseQuestionController extends Controller {

public function __construct()
{

}












public function indexLicenseQuestion(Request $request, $license_id)
{

  $license = License::find($license_id);
  $license_examination_subjects = License_examination_subject::select('id','license_phase','step','name')->where('license_id',$license_id)->get();

  if( ($request->has('year') and $request->get('year')) and ($request->has('subject') and $request->get('subject')) ){
    $license_questions = License_question::select('license.name as license_name','license_question.id','license_question.number','license_question.user_id','license_question.license_id','license_question.license_schedule_id','license_question.license_examination_subject_id','license_question.question','license_question.figure1','license_question.figure2','license_question.note','license_question.commentary','license_question.recommend_number','license_question.recommend_point','license_question.good_number','license_question.bad_number','license_question.created_at','license_question.updated_at','license_schedule.license_year','license_schedule.license_phase','license_schedule.name as schedule_name','license_schedule.start as schedule_start','license_schedule.end as schedule_end','license_examination_subject.name as subject_name','license_examination_subject.about as subject_about')
    ->leftJoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftJoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftJoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('license_question.license_id',$license_id)
    ->where('license_question.user_id',Auth::user()->id)
    ->where('license_schedule.license_year',$request->get('year'))
    ->where('license_question.license_examination_subject_id',$request->get('subject'))
    ->orderBy('license_schedule.license_year', 'desc')
    ->orderBy('license_examination_subject.step', 'asc')
    ->orderBy('license_question.number', 'asc')
    ->paginate(25);
  }elseif( ($request->has('year') and $request->get('year')) ){
    $license_questions = License_question::select('license.name as license_name','license_question.id','license_question.number','license_question.user_id','license_question.license_id','license_question.license_schedule_id','license_question.license_examination_subject_id','license_question.question','license_question.figure1','license_question.figure2','license_question.note','license_question.commentary','license_question.recommend_number','license_question.recommend_point','license_question.good_number','license_question.bad_number','license_question.created_at','license_question.updated_at','license_schedule.license_year','license_schedule.license_phase','license_schedule.name as schedule_name','license_schedule.start as schedule_start','license_schedule.end as schedule_end','license_examination_subject.name as subject_name','license_examination_subject.about as subject_about')
    ->leftJoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftJoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftJoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('license_question.user_id',Auth::user()->id)
    ->where('license_schedule.license_year',$request->get('year'))
    ->orderBy('license_schedule.license_year', 'desc')
    ->orderBy('license_examination_subject.step', 'asc')
    ->orderBy('license_question.number', 'asc')
    ->paginate(25);
  }elseif( ($request->has('subject') and $request->get('subject')) ){
    $license_questions = License_question::select('license.name as license_name','license_question.id','license_question.number','license_question.user_id','license_question.license_id','license_question.license_schedule_id','license_question.license_examination_subject_id','license_question.question','license_question.figure1','license_question.figure2','license_question.note','license_question.commentary','license_question.recommend_number','license_question.recommend_point','license_question.good_number','license_question.bad_number','license_question.created_at','license_question.updated_at','license_schedule.license_year','license_schedule.license_phase','license_schedule.name as schedule_name','license_schedule.start as schedule_start','license_schedule.end as schedule_end','license_examination_subject.name as subject_name','license_examination_subject.about as subject_about')
    ->leftJoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftJoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftJoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('license_question.user_id',Auth::user()->id)
    ->where('license_question.license_examination_subject_id',$request->get('subject'))
    ->orderBy('license_schedule.license_year', 'desc')
    ->orderBy('license_examination_subject.step', 'asc')
    ->orderBy('license_question.number', 'asc')
    ->paginate(25);
  }else{
    $license_questions = License_question::select('license.name as license_name','license_question.id','license_question.number','license_question.user_id','license_question.license_id','license_question.license_schedule_id','license_question.license_examination_subject_id','license_question.question','license_question.figure1','license_question.figure2','license_question.note','license_question.commentary','license_question.recommend_number','license_question.recommend_point','license_question.good_number','license_question.bad_number','license_question.created_at','license_question.updated_at','license_schedule.license_year','license_schedule.license_phase','license_schedule.name as schedule_name','license_schedule.start as schedule_start','license_schedule.end as schedule_end','license_examination_subject.name as subject_name','license_examination_subject.about as subject_about')
    ->leftJoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftJoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftJoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('license_question.user_id',Auth::user()->id)
    ->orderBy('license_schedule.license_year', 'desc')
    ->orderBy('license_examination_subject.step', 'asc')
    ->orderBy('license_question.number', 'asc')
    ->paginate(25);
  }

  
  $favo = Util::getFavo('license_question');
  if ($request->has('page')) {
    return json_encode(View::make('include.search_license_questions', array('license' => $license, 'license_questions' => $license_questions, 'favo'=>$favo))->render());
  }
  
  return View('owner.license.question.index', compact('license','license_questions','favo','license_examination_subjects'));

}














public function getCreateLicenseQuestionTheme(Request $request, $license_id)
{

  $license = License::find($license_id);
  $license_question = new License_question;
  $license_examination_subject = License_examination_subject::where('license_id',1)->where('license_phase',2)->get();
  return View('owner.license.question.theme.create', compact('license','license_examination_subject','license_question'));

}


public function postCreateLicenseQuestionTheme(Request $request, $license_id)
{

  $this->validate($request, [
    'year'         => 'required|min:4|max:4',
    'subject'      => 'required|min:1|max:3',
    'question'     => 'required'
  ]);

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',2)
    ->first();

  $license_question_theme = License_question_theme::select('id')
    ->where('license_id',$license_id)
    ->where('license_schedule_id',$license_schedule->id)
    ->where('license_examination_subject_id',$request->get('subject'))
    ->first();
  if($license_question_theme){
    return redirect('/owner/license/' . $license_id . '/question/theme/' . $license_question_theme->id . '/createedit')->with('warning', 'すでにこの問題テーマは作成済みです。こちらから編集してください。');
  }

  $license_question_theme = new License_question_theme;
  $license_question_theme->user_id = Auth::user()->id;
  $license_question_theme->license_id = $license_id;
  $license_question_theme->license_schedule_id = $license_schedule->id;
  $license_question_theme->license_examination_subject_id = $request->get('subject');
  $license_question_theme->number = 1;
  $license_question_theme->question = $request->get('question');
  $license_question_theme->save();

  $figure1 = $request->file('figure1');
  if($figure1){
    $pic_size = filesize($figure1);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/theme/' . $license_question_theme->id . '/';
    $pic_name = 'figure1_' . $license_question_theme->id . '_' . uniqid() . '.' . $figure1->extension();
    $license_question_theme->figure1 = Util::formFileToImageLicenseQuestion($figure1, $pic_path, $license_question_theme->figure1, $pic_name );  
  }

  $figure2 = $request->file('figure2');
  if($figure2){
    $pic_size = filesize($figure2);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/theme/' . $license_question_theme->id . '/';
    $pic_name = 'figure2_' . $license_question_theme->id . '_' . uniqid() . '.' . $figure2->extension(); 
    $license_question_theme->figure2 = Util::formFileToImageLicenseQuestion($figure2, $pic_path, $license_question_theme->figure2, $pic_name );  
  }

  $license_question_theme->save();
  
  return redirect('/owner/license/' . $license_id . '/question/create')->with('success', '問題を登録しましょう。');

}





public function getCreateEditLicenseQuestionTheme(Request $request, $license_id, $license_question_theme_id)
{

  $license = License::find($license_id);
  $license_examination_subject = License_examination_subject::where('license_id',1)->where('license_phase',2)->get();
  $license_question_theme = License_question_theme::find($license_question_theme_id);
  $license_schedule = License_schedule::find($license_question_theme->license_schedule_id);

  return View('owner.license.question.theme.create_edit', compact('license','license_examination_subject','license_question_theme','license_schedule'));

}




public function postCreateEditLicenseQuestionTheme(Request $request, $license_id, $license_question_theme_id)
{

  $this->validate($request, [
    'year'         => 'required|min:4|max:4',
    'subject'      => 'required|min:1|max:3',
    'question'     => 'required'
  ]);

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',$request->get('phase'))
    ->first();

  $license_question_theme = License_question_theme::find($license_question_theme_id);
  $license_question_theme->license_schedule_id = $license_schedule->id;
  $license_question_theme->license_examination_subject_id = $request->get('subject');
  $license_question_theme->question = $request->get('question');

  $figure1 = $request->file('figure1');
  if($figure1){
    $pic_size = filesize($figure1);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/theme/' . $license_question_theme->id . '/';
    $pic_name = 'figure1_' . $license_question_theme->id . '_' . uniqid() . '.' . $figure1->extension();
    $license_question_theme->figure1 = Util::formFileToImageLicenseQuestion($figure1, $pic_path, $license_question_theme->figure1, $pic_name );  
  }

  $figure2 = $request->file('figure2');
  if($figure2){
    $pic_size = filesize($figure2);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/theme/' . $license_question_theme->id . '/';
    $pic_name = 'figure2_' . $license_question_theme->id . '_' . uniqid() . '.' . $figure2->extension(); 
    $license_question_theme->figure2 = Util::formFileToImageLicenseQuestion($figure2, $pic_path, $license_question_theme->figure2, $pic_name );  
  }

  $license_question_theme->save();
  
  return redirect('/owner/license/' . $license_id . '/question/create')->with('success', '次は問題を登録しましょう。');

}

















public function getCreateLicenseQuestion(Request $request, $license_id)
{

  $license = License::find($license_id);
  $license_question = new License_question;
  $license_examination_subject = License_examination_subject::where('license_id',1)->get();
  return View('owner.license.question.create', compact('license','license_examination_subject','license_question'));

}


public function postCreateLicenseQuestion(Request $request, $license_id)
{

  $this->validate($request, [
    'year'         => 'required|min:4|max:4',
    'phase'        => 'required|min:1|max:1',
    'subject'      => 'required|min:1|max:3',
    'number'       => 'required|min:1|max:3'
  ]);

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',$request->get('phase'))
    ->first();

  $license_question = License_question::select('id')
    ->where('license_id',$license_id)
    ->where('license_schedule_id',$license_schedule->id)
    ->where('license_examination_subject_id',$request->get('subject'))
    ->where('number',$request->get('number'))
    ->first();
  if($license_question){
    return redirect('/owner/license/' . $license_id . '/question/' . $license_question->id . '/createedit')->with('warning', 'すでに問題'.$license_question->number.'は作成済みです。こちらから編集してください。');
  }

  $license_question = new License_question;
  $license_question->user_id = Auth::user()->id;
  $license_question->license_id = $license_id;
  $license_question->license_schedule_id = $license_schedule->id;
  $license_question->license_examination_subject_id = $request->get('subject');
  $license_question->number = $request->get('number');
  $license_question->save();
  
  return redirect('/owner/license/' . $license_id . '/question/' . $license_question->id . '/edit')->with('success', '問題の詳細を登録しましょう。');

}






public function getCreateEditLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $license = License::find($license_id);
  $license_examination_subject = License_examination_subject::where('license_id',1)->get();
  $license_question = License_question::find($license_question_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);

  return View('owner.license.question.create_edit', compact('license','license_examination_subject','license_question','license_schedule'));

}




public function postCreateEditLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'year'         => 'required|min:4|max:4',
    'phase'        => 'required|min:1|max:1',
    'subject'      => 'required|min:1|max:3',
    'number'       => 'required|min:1|max:3'
  ]);

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',$request->get('phase'))
    ->first();

  $license_question = License_question::find($license_question_id);
  $license_question->user_id = Auth::user()->id;
  $license_question->license_schedule_id = $license_schedule->id;
  $license_question->license_examination_subject_id = $request->get('subject');
  $license_question->number = $request->get('number');
  $license_question->save();
  
  return redirect('/owner/license/' . $license_id . '/question/create')->with('success', '問題概要の編集が完了しました。');

}





public function showLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $license = License::find($license_id);

  $next_license_question_id = null;
  $before_license_question_id = null;
  $next_subject_id = null;
  $before_subject_id = null;
  $next_year_id = null;
  $before_year_id = null;

  #################
  #License_question
  #################
  $license_question = License_question::find($license_question_id);
  $license_examination_subject = License_examination_subject::find($license_question->license_examination_subject_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);

  if($next = License_question::select('id')
    ->where('license_id',$license_id)
    ->where('license_schedule_id',$license_question->license_schedule_id)
    ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
    ->where('number','>',$license_question->number)
    ->orderBy('number','asc')
    ->first())
  {
    $next_license_question_id = $next->id;
  }

  if(!$next_license_question_id){

    if($next_license_examination_subject = License_examination_subject::select('id')
      ->where('license_id',$license->id)
      ->where('step','>',$license_examination_subject->step)
      ->orderBy('step','asc')
      ->first())
    {
      if($next_subject_id = License_question::select('id')
        ->where('license_id',$license_id)
        ->where('license_schedule_id',$license_question->license_schedule_id)
        ->where('license_examination_subject_id',$next_license_examination_subject->id)
        ->orderBy('number','asc')
        ->first())
      {
        $next_subject_id = $next_subject_id->id;
      }
    }
    
    if(!$next_subject_id){
      if( $next_license_schedule = License_schedule::select('id')
        ->where('license_id',$license_id)
        ->where('license_year','>',$license_schedule->license_year)
        ->where('license_phase',1)
        ->orderBy('license_year','asc')
        ->first())
      {
        $next_year_license_examination_subject = License_examination_subject::select('id')
          ->where('license_id',$license->id)
          ->where('license_phase',1)
          ->where('step',1)
          ->first();
        if( $next_year_id = License_question::select('id')
          ->where('license_id',$license_id)
          ->where('license_schedule_id',$next_license_schedule->id)
          ->where('license_examination_subject_id',$next_year_license_examination_subject->id)
          ->where('number',1)
          ->first())
        {
          $next_year_id = $next_year_id->id;
        }
      }
    }

  }

  $before_license_question_id = null;
  if($before = License_question::select('id')
    ->where('license_id',$license_id)
    ->where('license_schedule_id',$license_schedule->id)
    ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
    ->where('number','<',$license_question->number)
    ->orderBy('number','desc')
    ->first())
  {
    $before_license_question_id = $before->id;
  }
  if(!$before_license_question_id){
    if( $before_license_examination_subject = License_examination_subject::where('license_id',$license->id)
      ->where('step','<',$license_examination_subject->step)
      ->orderBy('step','desc')
      ->first())
    {
      if( $before_subject_id = License_question::select('id')
        ->where('license_id',$license_id)
        ->where('license_schedule_id',$license_question->license_schedule_id)
        ->where('license_examination_subject_id',$before_license_examination_subject->id)
        ->orderBy('number','asc')
        ->first())
      {
        $before_subject_id = $before_subject_id->id;
      }
    }
    if(!$before_subject_id){
      if($before_license_schedule = License_schedule::select('id')
        ->where('license_id',$license_id)
        ->where('license_year','<',$license_schedule->license_year)
        ->where('license_phase',1)
        ->orderBy('license_year','desc')
        ->first())
      {
        $before_year_license_examination_subject = License_examination_subject::select('id')
          ->where('license_id',$license->id)
          ->where('license_phase',1)
          ->where('step',1)
          ->first();
        if( $before_year_id = License_question::select('id')
          ->where('license_id',$license_id)
          ->where('license_schedule_id',$before_license_schedule->id)
          ->where('license_examination_subject_id',$before_year_license_examination_subject->id)
          ->where('number',1)
          ->first())
        {
          $before_year_id = $before_year_id->id;
        }
      }
    }
  }

  $learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
    ->leftjoin('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->get();

  $literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_literature', 'literature.id', '=', 'license_question_literature.literature_id')
    ->where('license_question_literature.license_question_id',$license_question_id)
    ->get();


  #################
  #license_question_contents
  #################
  $license_question_contents = License_question_contents::where('license_question_id',$license_question_id)->orderBy('number','asc')->get();
  $answers = [];
  foreach($license_question_contents as $value){
    $answers[$value->id] = License_question_contents_answer::where('license_question_contents_id',$value->id)->get();
  }

  return View('owner.license.question.show', compact(
      'license',
      'license_question',
      'license_examination_subject',
      'license_schedule',
      'license_question_answer',
      'learnings',
      'literature',
      'next_license_question_id',
      'before_license_question_id',
      'next_subject_id',
      'before_subject_id',
      'next_year_id',
      'before_year_id',
      'license_question_contents',
      'answers'
  ));

}




public function getEditLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $license = License::find($license_id);
  $license_question = License_question::find($license_question_id);
  $license_examination_subject = License_examination_subject::find($license_question->license_examination_subject_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  $learnings = Learning::join('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->take(10)
    ->get();
  
  return View('owner.license.question.edit', compact('license','license_question','license_examination_subject','license_schedule','learnings'));

}




public function postEditLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'question'     => 'required|min:14|max:3000'
  ]);

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',$request->get('phase'))
    ->first();

  $license_question = License_question::find($license_question_id);
  
  $license_question->question = $request->get('question');
  $license_question->note = $request->get('note');

  $figure1 = $request->file('figure1');
  if($figure1){
    $pic_size = filesize($figure1);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question->id . '/';
    $pic_name = 'figure1_' . $license_question->id . '_' . uniqid() . '.' . $figure1->extension();
    $license_question->figure1 = Util::formFileToImageLicenseQuestion($figure1, $pic_path, $license_question->figure1, $pic_name );  
  }

  $figure2 = $request->file('figure2');
  if($figure2){
    $pic_size = filesize($figure2);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question->id . '/';
    $pic_name = 'figure2_' . $license_question->id . '_' . uniqid() . '.' . $figure2->extension(); 
    $license_question->figure2 = Util::formFileToImageLicenseQuestion($figure2, $pic_path, $license_question->figure2, $pic_name );  
  }

  $license_question->commentary = $request->get('commentary');

  $license_question->save();
  
  return redirect('/owner/license/' . $license_id . '/question/' . $license_question->id . '/show')->with('success', '登録しました。');

}



public function openCloseLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  $license_question = License_question::find($license_question_id);
  $license_question->owner_open = ($license_question->owner_open===1) ? 0 : 1;
  $license_question->save();

  return ['err'=>0, 'owner_open'=>$license_question->owner_open];

}



public function deleteLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  License_question_learning::where('license_question_id',$license_question_id)->delete();
  License_question_answer::where('license_question_id',$license_question_id)->delete();

  $license_question = License_question::find($license_question_id);
  $pic_path = '/uploads/license/' . $license_question_id . '/';

  Util::deleteImage($pic_path,$license_question->figure1);
  Util::deleteImage($pic_path,$license_question->figure2);

  $license_question->delete();

}












}