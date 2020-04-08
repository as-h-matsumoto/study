<?php namespace App\Http\Controllers\license;

use App\Http\Controllers\Controller;

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
use App\models\License_schedule;
use App\models\License_schedule_examination_subject;
use App\models\License_schedule_pass_rate;
use App\models\License_schedule_statistics;
use App\models\Literature;

use App\models\License_question_try_master;
use App\models\License_question_try_answer;
use App\models\License_question_try_score;

use App\models\License_question_desc_parts;
use App\models\License_examination_subject_desc_parts_literature;
use App\models\License_examination_subject_desc_parts_learning;
use App\models\License_examination_subject_desc_parts;
use App\models\License_examination_subject_desc_parts_memo;


use App\models\Recommends;
use App\models\Recommends_pics;

use Auth;
use DB;
use Redirect;
use Util;
use UtilYoyaku;
use Utilowner;
use UtilLicense;
use DateTime;
use View;

use Illuminate\Http\Request;

class LicenseController extends Controller {


public function __construct()
{
}




public function getTryChoiceLicense(Request $request)
{

  #
  # 中小企業診断士の試験内容を選択
  # 

  $license = License::find(1);

  $license_id = $license->id;

  $license_examination_subject = License_examination_subject::where('license_id',$license->id)->get();

  return View('license.try.choice.license.desc', compact('license','license_examination_subject','license_id'));

}



public function postSubPartsMemo(Request $request)
{

  $this->validate($request, [
    'desc_parts_id' => 'required',
    'memo'          => 'required|max:2000'
  ]);

  $license_examination_subject_desc_parts_memo = License_examination_subject_desc_parts_memo::where('user_id',Auth::user()->id)
    ->where('license_examination_subject_desc_parts_id',$request->get('desc_parts_id'))
    ->first();
  if(!$license_examination_subject_desc_parts_memo){
    $license_examination_subject_desc_parts_memo = new License_examination_subject_desc_parts_memo;
    $license_examination_subject_desc_parts_memo->license_examination_subject_desc_parts_id = $request->get('desc_parts_id');
    $license_examination_subject_desc_parts_memo->license_examination_subject_id = $request->get('subject_id');
    $license_examination_subject_desc_parts_memo->user_id = Auth::user()->id;
  }
  $license_examination_subject_desc_parts_memo->memo  = $request->get('memo');
  $license_examination_subject_desc_parts_memo->save();

  $user = User::find(Auth::user()->id);
  $user->study_area_history_page_url = $license_examination_subject_desc_parts_memo->license_examination_subject_id;
  $user->study_area_history_page_id = $license_examination_subject_desc_parts_memo->license_examination_subject_desc_parts_id;
  $user->save();

  return $license_examination_subject_desc_parts_memo->memo;

}



public function postSubPartsLiterature(Request $request)
{

  $this->validate($request, [
    'desc_parts_id' => 'required',
    'name'          => 'required|max:191',
    'url'           => 'required|url'
  ]);

  $license_examination_subject_desc_parts = license_examination_subject_desc_parts::find($request->get('desc_parts_id'));
  $license_examination_subject_desc_parts->literature_name = $request->get('name');
  $license_examination_subject_desc_parts->literature_url  = $request->get('url');
  $license_examination_subject_desc_parts->save();

  return '<a class"pr-2" target="_blank" href="'.$request->get('url').'">'.$request->get('name').'(引用)</a>';

}

public function postSubPartsSummary(Request $request)
{

  $this->validate($request, [
    'desc_parts_id' => 'required',
    'summary'       => 'required'
  ]);

  $license_examination_subject_desc_parts = license_examination_subject_desc_parts::find($request->get('desc_parts_id'));
  $license_examination_subject_desc_parts->summary = $request->get('summary');
  $license_examination_subject_desc_parts->save();

  $user = User::find(Auth::user()->id);
  $user->study_area_history_page_url = $license_examination_subject_desc_parts->license_examination_subject_id;
  $user->study_area_history_page_id = $license_examination_subject_desc_parts->id;
  $user->save();
  
  return nl2br($request->get('summary'));

}












public function index(Request $request)
{

  #
  # 今は中小企業診断士しかないのでそのままリダイレクト
  #

  return redirect('/license/1/top');

  $licenses = License::paginate(10);
  if ($request->has('page')) {
    return json_encode(View::make('license/include.search_license', array('licenses' => $licenses))->render());
  }
  return View('license.index', compact('licenses'));

}







###
###
### license_id
###
###

public function redirect(Request $request, $license_id)
{

  return redirect('/license/'.$license_id.'/top');

}

public function top(Request $request, $license_id)
{

  $license = License::find($license_id);
  $license_examination_subject = License_examination_subject::where('license_id',$license_id)->where('id','<',99990000)->get();
  $license_schedule_examination_subject = [];
  foreach($license_examination_subject as $sub){
    $license_schedule_examination_subject[$sub->id] = License_schedule_examination_subject::where('license_examination_subject_id',$sub->id)->get();
  }

  return View('license.top', compact('license_id','license','license_examination_subject','license_schedule_examination_subject'));

}




public function getLicenseStudyMap(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.study_map', compact('license_id','license'));

}

public function getLicensestudyArea(Request $request, $license_id)
{

  $license = License::find($license_id);

  $license_examination_subject = License_examination_subject::where('license_id',$license_id)->where('id','<',99990000)->get();

  $license_examination_subject_id = ( $request->has('license_examination_subject_id') ) ? $request->get('license_examination_subject_id') : 1 ;
  $license_examination_subject_desc_parts = License_examination_subject_desc_parts::where('number','like',$license_examination_subject_id.'%')
    ->where('view_flag',1)
    ->get();
  $memo = [];
  if(Auth::check()){
    foreach($license_examination_subject_desc_parts as $parts){
      if($license_examination_subject_desc_parts_memo = License_examination_subject_desc_parts_memo::where('user_id',Auth::user()->id)
        ->where('license_examination_subject_desc_parts_id',$parts->id) #表示の変更はこの行をすべてコメントアウトして、修正する。
        ->first())
      {
        $memo[$license_examination_subject_desc_parts_memo->license_examination_subject_desc_parts_id] = $license_examination_subject_desc_parts_memo->memo;
      }
    }
  }
  //print_r(count($license_examination_subject_desc_parts));exit;
  return View('license.study_area', compact('license_id','license','license_examination_subject','license_examination_subject_id','license_examination_subject_desc_parts','memo'));

}

public function getLicenseMustReadList(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.read_list', compact('license_id','license'));

}

public function getLicenseHotWords(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.hot_words', compact('license_id','license'));

}


public function getLicenseStatistics(Request $request, $license_id)
{

  $license = License::find($license_id);
  $license_schedule_statistics = License_schedule_statistics::orderBy('license_year','desc')->get();
  return View('license.statistics', compact('license_id','license','license_schedule_statistics'));

}


public function getLicenseData(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.data', compact('license_id','license'));

}


public function getLicenseSchedule(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.schedule', compact('license_id','license'));

}


public function getLicenseTest(Request $request, $license_id)
{

  $license = License::find($license_id);
  return View('license.test', compact('license_id','license'));

}



public function getLicenseQuestion(Request $request, $license_id, $license_question_id)
{

  if(Auth::check()){
    $user_id = Auth::user()->id;
  }else{
    $user_id = 1;
  }
  
  $license_question = License_question::select(
    'license.id as license_id', #試験ＩＤ
    'license.name as license_name', #試験名
    'license_schedule.id as license_schedule_id', #試験スケジュールＩＤ
    'license_schedule.license_year', #試験年度
    'license_schedule.license_phase', #試験フェーズ（１か２）
    'license_schedule.name as schedule_name', #（一次試験、か、二次試験）
    'license_examination_subject.id as license_examination_subject_id', #試験科目ＩＤ、全科目は「9999999」
    'license_examination_subject.name as subject_name', #試験科目名、全科目は「全科目」
    'license_examination_subject.step as subject_step', #試験科目番号、全科目は「」
    'license_examination_subject.time as subject_time', #試験時間、全科目は「全科目」
    'license_question.id',
    'license_question.question',
    'license_question.number',
    'license_question.figure1',
    'license_question.figure2',
    'license_question.note',
    'license_question.commentary',
    'license_question.recommend_number'
    )
    ->leftjoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftjoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftjoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('license_question.id',$license_question_id)
    ->first();

  $license_question_theme = null;
  if($license_question->license_phase === 2){
    $license_question_theme = License_question_theme::where('license_id',$license_question->license_id)
      ->where('license_schedule_id',$license_question->license_schedule_id)
      ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
      ->first();
  }

  $recommends = Recommends::select(
      'recommends.id',
      'recommends.user_id',
      'recommends.table_name',
      'recommends.table_id',
      'recommends.owner_open',
      'recommends.admin_open',
      'recommends.recommend',
      'recommends.point',
      'recommends.sub_name',
      'recommends.sub_url',
      'recommends.pic',
      'recommends.good_number',
      'recommends.bad_number',
      'recommends.created_at',
      'recommends.updated_at',
      'users.name as user_name',
      'users.pic as user_pic'
    )
    ->join('users', 'users.id', '=', 'recommends.user_id')
    ->where('recommends.table_name','license_question')
    ->where('recommends.table_id',$license_question_id)
    ->where('recommends.admin_open',1)
    ->where('recommends.user_id',$user_id)
    ->orderBy('recommends.updated_at', 'desc')
    ->paginate(6);
   
  foreach($recommends as $key=>$val){
    if($val->table_name == 'learning')
    {
      $temp = Learning::select('title','url')->where('id',$val->table_id)->first();
      $recommends[$key]['title'] = $learning->name;
      $recommends[$key]['url'] = $learning->url;
    }
    elseif($val->table_name == 'license_question')
    {
      $temp = License_question::select(
        'license.id as license_id', #試験ＩＤ
        'license.name as license_name', #試験名
        'license_schedule.license_year', #試験年度
        'license_examination_subject.name as subject_name', #試験科目名、全科目は「全科目」
        'license_question.id',
        'license_question.number'
        )
        ->leftjoin('license', 'license.id', '=', 'license_question.license_id')
        ->leftjoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
        ->leftjoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
        ->where('license_question.id',$val->table_id)
        ->first();
      $recommends[$key]['title'] = $license_question->subject_name . ' 第' . $license_question->number . '問('.$license_question->license_year.')';
      $recommends[$key]['url'] = '/license/'.$license_question->license_id.'/question/'.$license_question->id;
    }
  }

  if ($request->has('page')) {
    return json_encode(View::make('include.recommend_more', array('recommends'=>$recommends,'license_question'=>$license_question))->render());
  }

  #################
  #この問題のすべてのquestion_contentsとその解答群を取得
  #################
  $license_question_contents = License_question_contents::where('license_question_id',$license_question_id)
    ->get();
  $license_question_contents_answers = [];
  foreach($license_question_contents as $key=>$val){
    $license_question_contents_answers[$val->id] = License_question_contents_answer::where('license_question_contents_id',$val->id)->get();
  }


  #################
  #対象科目のすべてのquestionとquestion_contentsとその正解を取得
  #################
  $license_questions = License_question::select(
      'id',
      'number'
    )
    ->where('license_id',$license_question->license_id)
    ->where('license_schedule_id',$license_question->license_schedule_id)
    ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
    ->orderBy('number')
    ->get();


  #################
  #learnings
  #################
  $learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
    ->leftjoin('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->where('license_question_learning.user_id',$user_id)
    ->get();

  #################
  #literature
  #################
  $literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_literature', 'literature.id', '=', 'license_question_literature.literature_id')
    ->where('license_question_literature.license_question_id',$license_question_id)
    ->where('license_question_literature.user_id',$user_id)
    ->get();

  $favo = Util::getFavo('license_question');
  $license_question['favo'] = Util::checkFavo($favo, $license_question->id);

  #################
  #License_examination_subject
  #################
  $license_examination_subjects_questions = [];
  $license_examination_subjects = License_examination_subject::select('id','step','name','time')
    ->where('license_id',$license_id)
    ->where('license_phase',$license_question->license_phase)
    ->where('id','<',99990000)
    ->get();
  foreach($license_examination_subjects as $subj){
    $sub_question_first = License_question::select(
        'id'
      )
      ->where('license_id',$license_question->license_id)
      ->where('license_schedule_id',$license_question->license_schedule_id)
      ->where('license_examination_subject_id',$subj->id)
      ->orderBy('number')
      ->first();
    $license_examination_subjects_questions[$subj->id] = $sub_question_first->id;
  }

  return View('license.question', compact(
      'license_question_try_master',
      'license_question',
      'license_questions',
      'learnings',
      'literature',
      'license_question_contents',
      'license_question_contents_answers',
      'license_examination_subjects',
      'license_examination_subjects_questions',
      'recommends',
      'license_id',
      'license_question_theme'
  ));

}






###
###
### Learning
###
###

public function getSerachLearning(Request $request)
{

  /*
  if(!$request->has('searchWord')){
    return '';
  }
  */
  $search_words = 'エマ・ワトソン';
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&list=search';
  //$url_parameter_search_word = '&srsearch=' . urlencode($request->get('searchWord'));
  $url_parameter_search_word = '&srsearch=' . urlencode($search_words);

  $url = $url . $url_parameter . $url_parameter_search_word;

  //return file_get_contents($url, true);
  
  $wiki = file_get_contents($url, true);

  $wiki = json_decode($wiki,true);

  $count = 1;
  foreach($wiki as $val){
    if($count===3){
      print_r($val);
      print_r('total: ' . $val['searchinfo']['totalhits']);
      #print_r($val['search']);
      foreach($val['search'] as $a){
        print_r($a);
      }
    }
    $count++;
  }
  exit;

}





public function postLicenseQuestionLearning(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'pageid'    => 'required',
    'title'     => 'required'
  ]);

  $learning = Learning::where( 'pageid', $request->get('pageid') )->first();
  if(!$learning){
    $learning = new Learning;
    $learning->pageid = $request->get('pageid');
    $learning->name = $request->get('title');
    $learning->save();
  }

  $license_question_learning = License_question_learning::where( 'user_id', Auth::user()->id )
    ->where( 'license_question_id', $license_question_id )
    ->where( 'learning_id', $learning->id )
    ->first();
  if($license_question_learning){
  }else{
    $license_question_learning = new License_question_learning;
    $license_question_learning->license_question_id = $license_question_id;
    $license_question_learning->learning_id = $learning->id;
    $license_question_learning->save();

  }

  return $learning;

}



public function postLicenseQuestionLearningDelete(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'learning_id'    => 'required'
  ]);

  License_question_learning::where( 'user_id', Auth::user()->id )
    ->where( 'license_question_id', $license_question_id )
    ->where( 'learning_id', $request->get('learning_id') )
    ->delete();

  return 'ok';

}



public function postLicenseQuestionCommentary(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'commentary'    => 'required'
  ]);

  $license_question = License_question::find($license_question_id);

  $license_question->commentary = $request->get('commentary');

  $license_question->save();

  return $request->get('commentary');

}




public function postLicenseQuestionLogic(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'logic'    => 'required'
  ]);

  $license_question = License_question::find($license_question_id);

  $license_question->commentary = $request->get('logic');

  $license_question->save();

  return $request->get('logic');

}



public function postDescPartLearning(Request $request)
{

  $this->validate($request, [
    'descPartId' => 'required',
    'pageid'     => 'required',
    'title'      => 'required'
  ]);

  $license_examination_subject_desc_parts = License_examination_subject_desc_parts::find($request->get('descPartId'));

  $license_examination_subject_desc_parts->wiki_url = $request->get('pageid');
  $license_examination_subject_desc_parts->wiki_name = $request->get('title');

  $license_examination_subject_desc_parts->save();

  $user = User::find(Auth::user()->id);
  $user->study_area_history_page_url = $license_examination_subject_desc_parts->license_examination_subject_id;
  $user->study_area_history_page_id = $license_examination_subject_desc_parts->id;
  $user->save();

  return $request->get('pageid');

}





public function postSubPartsView(Request $request)
{

  if(Auth::user()->id !== 1){
    return 'ng';
  }
  $this->validate($request, [
    'desc_parts_id' => 'required'
  ]);

  $license_examination_subject_desc_parts = License_examination_subject_desc_parts::find($request->get('desc_parts_id'));

  $return_message = ( $license_examination_subject_desc_parts->view_flag ) ? 'off' : 'on' ;
  $license_examination_subject_desc_parts->view_flag = ( $license_examination_subject_desc_parts->view_flag ) ? 0 : 1 ;

  $license_examination_subject_desc_parts->save();

  return $return_message;

}







}


