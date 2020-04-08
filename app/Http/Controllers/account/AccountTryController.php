<?php namespace App\Http\Controllers\account;

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

class AccountTryController extends Controller {


public function __construct()
{
}






###
###
### Learning
###
###

public function getSerachLearning(Request $request)
{

  
  if(!$request->has('searchWord')){
    return '';
  }
  #$search_words = 'エマ・ワトソン';
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&list=search';
  $url_parameter_search_word = '&srsearch=' . urlencode($request->get('searchWord'));

  $url = $url . $url_parameter . $url_parameter_search_word;

  return file_get_contents($url, true);
  /*
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
  return ;
  */
  

}





public function postLicenseQuestionLearning(Request $request, $try_master_id, $license_id, $license_question_id)
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

  $license_question_learning = License_question_learning::where( 'license_question_id', $license_question_id )
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









public function postLicenseQuestionLearningRegion(Request $request, $try_master_id, $license_id, $license_question_id)
{

  $this->validate($request, [
    'pageid'       => 'required',
    'title'        => 'required',
    'up_down'      => 'required',
  ]);

  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&list=search&srlimit=1';
  $url_parameter_search_word = '&srsearch=' . urlencode($request->get('title'));
  $url = $url . $url_parameter . $url_parameter_search_word;

  $wiki = file_get_contents($url, true);
  $wiki = json_decode($wiki,true);

  $count = 1;
  foreach($wiki as $val){
    if($count===3){
      print_r('total: ' . $val['searchinfo']['totalhits']);
      #print_r($val['search']);
      foreach($val['search'] as $a){
        $getcontent = $a;
      }
    }
    $count++;
  }

  $learning = Learning::where( 'pageid', $getcontent['pageid'] )->first();
  if(!$license_question_learning){
    $learning = new Learning;
    $learning->pageid = $getcontent['pageid'];
    $learning->name = $getcontent['title'];
    $learning->description = $getcontent['snippet'];
    $learning->save();
  }

  $learning_region = Learning_region::where( 'learning_id', $request->get('learning_id') )
    ->where('up_under_learning_id', $learning->id)
    ->first();
  if($learning_region){
    return 'doNo';
  }

  $learning_region = new Learning_region;
  $learning_region->learning_id = $request->get('learning_id');
  $learning_region->up_under = $request->get('up_down');
  $learning_region->up_under_learning_id = $learning->id;
  $learning_region->save();

  return 'ok';
  
}





###
###
### HISTORY
###
###

//Route::get('history', 'AccountTryController@getTryHistory');
public function getTryHistory(Request $request)
{

  $license_question_try_masters = License_question_try_master::select(
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
    'license_question_try_master.id as try_master_id', #問題トライマスターＩＤ
    'license_question_try_master.type as master_type', #'１：練習、２：模擬'
    'license_question_try_master.rate as rate',        #科目平均点数
    'license_question_try_master.active as active', ##99：試験終了、1：試験前、2：試験中（time_limitを超えていたら終了、もしくは、終了ボタンを押した場合）
    'license_question_try_master.start_question_id as start_question_id', #開始の問題ＩＤ
    'license_question_try_master.time_limit as master_time_limit', #試験終了時間
    'license_question_try_master.updated_at as updated_at' #最終アクセス
    )
    ->leftjoin('license', 'license.id', '=', 'license_question_try_master.license_id')
    ->leftjoin('license_schedule', 'license_schedule.id', '=', 'license_question_try_master.license_schedule_id')
    ->leftjoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question_try_master.license_examination_subject_id')
    ->where('license_question_try_master.user_id',Auth::user()->id)
    ->orderBy('license_question_try_master.active')
    ->paginate(20);
  
  if ($request->has('page')) {
    return json_encode(View::make('include.search_try_history', array('license_question_try_masters' => $license_question_try_masters))->render());
  }

  return View('account.try.history.index', compact('license_question_try_masters'));

}




public function getTryHistoryScore(Request $request, $try_master_id)
{

  $license_question_try_master = UtilLicense::getTryMasterAll($try_master_id);
  $license_id = $license_question_try_master->license_id;
  $license_schedule = License_schedule::find($license_question_try_master->license_schedule_id);

  #すべての科目の問題を取得
  $all_question = [];
  if($license_question_try_master->license_examination_subject_id > 99990000)
  {
    $license_examination_subjects = License_examination_subject::select('id','step','name','time')
      ->where('license_id',$license_question_try_master->license_id)
      ->where('license_phase',$license_schedule->license_phase)
      ->where('id','<',99990000)
      ->orderBy('step')
      ->get();
  }else{
    $license_examination_subjects = License_examination_subject::select('id','step','name','time')
      ->where('id',$license_question_try_master->license_examination_subject_id)
      ->orderBy('step')
      ->get();
  }

  $subject_score = [];
  foreach($license_examination_subjects as $sub){
    $subject_score[$sub->id] = License_question_try_score::where('license_question_try_master_id',$try_master_id)
      ->where('license_examination_subject_id',$sub->id)
      ->get();
  }
  
  return View('account.try.history.master.score', compact(
    'license_question_try_master',
    'license_examination_subjects',
    'subject_score',
    'license_id'
  ));

}





public function getTryHistoryLicenseQuestion(Request $request, $try_master_id, $license_id, $license_question_id)
{

  $license_question_try_master = License_question_try_master::find($try_master_id);
  $license_id = $license_question_try_master->license_id;

  if($license_question_try_master->active !== 99){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はまだ終了していません。');
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
    ->where('recommends.user_id',Auth::user()->id)
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
      $recommends[$key]['url'] = '/license/'.$license_question->license_id.'/license_question/'.$license_question->id;
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
  #この問題に対するユーザの解答を取得
  #################
  $temp = License_question_try_answer::where('license_question_try_master_id',$try_master_id)
    ->where('license_question_id',$license_question_id)
    ->get();

  $license_question_try_answers = [];
  foreach($temp as $tmp){
    if($license_question->license_phase === 1){
      $license_question_try_answers[$tmp->license_question_contents_id] = $tmp->license_question_contents_answer_id;
    }elseif($license_question->license_phase === 2){
      $license_question_try_answers[$tmp->license_question_contents_id] = $tmp->answer;
    }
  }

  #################
  #対象科目のすべての解答を取得
  #################
  $license_questions_try_answers = [];
  $temp = License_question_try_answer::select('license_question_id','license_question_contents_id','license_question_contents_answer_id')
    ->where('license_question_try_master_id',$try_master_id)
    ->get();

  foreach($temp as $tmp){
    if($license_question->license_phase === 1){
      $license_questions_try_answers[$tmp->license_question_id][$tmp->license_question_contents_id] = $tmp->license_question_contents_answer_id;
    }elseif($license_question->license_phase === 2){
      $license_questions_try_answers[$tmp->license_question_id][$tmp->license_question_contents_id] = $tmp->license_question_contents_id;
    }
  }
  

  #################
  #対象科目のすべてのquestionとquestion_contentsとその正解を取得
  #################
  $question_all = [];
  $license_questions = License_question::select(
      'id',
      'number'
    )
    ->where('license_id',$license_question->license_id)
    ->where('license_schedule_id',$license_question->license_schedule_id)
    ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
    ->orderBy('number')
    ->get();
  foreach($license_questions as $que){

    $quecons = License_question_contents::select('id','license_question_contents_answer_id')
      ->where('license_question_id',$que->id)
      ->get();
    $cont_number = count($quecons);
    $correct = 0;
    # 1: １回チェックで正解か不正解か判定
    # 1: ２回チェックで１回だけ正解であれば△にする
    # 0不正解, 1正解, 2△
    foreach($quecons as $quecon){
      if( isset($license_questions_try_answers[$que->id][$quecon->id]) and ($license_questions_try_answers[$que->id][$quecon->id] === $quecon->license_question_contents_answer_id) ){
        $correct++;
      }
    }

    if($correct===0){
      $question_all[$que->id] = 0;
    }elseif($correct===$cont_number){
      $question_all[$que->id] = 1;
    }else{
      $question_all[$que->id] = 2;
    }

  }

  #################
  #learnings
  #################
  $learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
    ->leftjoin('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->get();

  #################
  #literature
  #################
  $literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_literature', 'literature.id', '=', 'license_question_literature.literature_id')
    ->where('license_question_literature.license_question_id',$license_question_id)
    ->get();

  #################
  #License_examination_subject
  #################
  $license_examination_subjects = [];
  $license_examination_subjects_questions = [];
  if($license_question_try_master->license_examination_subject_id > 99990000)
  {
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
  }

  $favo = Util::getFavo('license_question');
  $license_question['favo'] = Util::checkFavo($favo, $license_question->id);

  return View('account.try.history.master.question', compact(
      'license_question_try_master',
      'license_question',
      'license_questions',
      'license_question_try_answers',
      'license_questions_try_answers',
      'question_all',
      'license_examination_subjects',
      'license_examination_subjects_questions',
      'learnings',
      'literature',
      'license_question_contents',
      'license_question_contents_answers',
      'recommends',
      'license_id',
      'license_question_theme'
  ));

}







#Route::get('license', 'AccountTryController@getTryChoiceLicense');
public function getTryChoiceLicense(Request $request)
{

  #
  # 資格
  # を選択する。
  # 中小企業診断士しかないので、いまはそのままリダイレクト
  # 
  
  return redirect('/account/try/choice/license/1/desc');
  
  $licenses = License::paginate(20);

  return View('account.try.choice.license', compact('licenses'));

}



//Route::get('desc', 'AccountTryController@getTryChoiceLicenseDesc');
public function getTryChoiceLicenseDesc(Request $request, $license_id)
{

  #
  # 試験を選択
  # 

  $license = License::find($license_id);

  $license_examination_subject = License_examination_subject::where('license_id',$license_id)->get();

  return View('account.try.choice.license.desc', compact('license','license_examination_subject','license_id'));

}








//Route::post('desc', 'AccountTryController@postTryChoiceLicenseDesc');
public function postTryChoiceLicenseDesc(Request $request, $license_id)
{

  /*
  99990001 = 中小企業診断士全科目
  99990001 ~ 99999999 = 全科目に予約
  模擬試験の科目は以下で取得
  $license_examination_subject = License_examination_subject::where('license_id',$license_id)->where('step',9999)->get();
  */

  $this->validate($request, [
    'year'      => 'required|integer|min:1900|max:'.date("Y"),
    'subject'   => 'required|integer|min:1|max:99999999',
    'type'      => 'required|integer|min:1|max:2' #1:練習、2:模擬（時間制限）
  ]);

  
  $license_examination_subject = License_examination_subject::find($request->get('subject'));
  if(!$license_examination_subject){
    return back()->with('warning', '科目を確認できません。')->withInput();
  }

  $license_schedule = License_schedule::select('id')
    ->where('license_id',$license_id)
    ->where('license_year',$request->get('year'))
    ->where('license_phase',$license_examination_subject->license_phase)
    ->first();
  if(!$license_schedule){
    return back()->with('warning', '試験年度を確認できません。')->withInput();
  }

  if($license_question_try_master = License_question_try_master::where('license_id',$license_id)
    ->where('license_schedule_id',$license_schedule->id)
    ->where('license_examination_subject_id',$license_examination_subject->id)
    ->where('active',1)
    ->where('active',2)
    ->first()
  ){
    if($license_question_try_master->active === 1){
      return redirect('/account/try/master/'.$license_question_try_master->id.'/start')->with('info', '試験を開始できます。');
    }elseif($license_question_try_master->active === 2){
      return redirect('/account/try/master/'.$license_question_try_master->id.'/license/'.$license_id.'/question/'.$license_question_try_master->start_question_id)->with('info', 'この試験はすでに開始しています。');
    }
  }

  if( $license_examination_subject->step === 9999 )
  {
    $sub = License_examination_subject::where('license_id',$license_id)
      ->where('license_phase',$license_examination_subject->license_phase)
      ->where('step',1)
      ->first();
    $license_question = License_question::where('license_id',$license_id)
      ->where('license_schedule_id',$license_schedule->id)
      ->where('license_examination_subject_id',$sub->id)
      ->orderBy('number')
      ->first();
    $start_question_id = $license_question->id;
  }else{
    $license_question = License_question::where('license_id',$license_id)
      ->where('license_schedule_id',$license_schedule->id)
      ->where('license_examination_subject_id',$license_examination_subject->id)
      ->orderBy('number')
      ->first();
    $start_question_id = $license_question->id;
  }

  $license_question_try_master = new License_question_try_master;
  $license_question_try_master->user_id = Auth::user()->id;
  $license_question_try_master->license_id = $license_id;
  $license_question_try_master->license_schedule_id = $license_schedule->id;
  $license_question_try_master->license_examination_subject_id = $license_examination_subject->id;
  $license_question_try_master->type = $request->get('type');
  $license_question_try_master->active = 1;
  $license_question_try_master->start_question_id = $start_question_id;
  $license_question_try_master->save();

  return redirect('/account/try/master/'.$license_question_try_master->id.'/start');
  
}






#Route::get('start', 'AccountTryController@getTryStart');
public function getTryStart(Request $request, $try_master_id){

  $license_question_try_master = UtilLicense::getTryMasterAll($try_master_id);
  $license_id = $license_question_try_master->license_id;

  if($license_question_try_master->active === 99){
    return redirect('/account/try/history/master/'.$try_master_id)->with('info', 'この試験はすでに採点済みです。');
  }elseif($license_question_try_master->active === 2){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はすでに開始しています。');
  }

  UtilLicense::checkTryStart($license_question_try_master);
  return View('account.try.start', compact('license_question_try_master','license_id'));

}



#Route::post('start', 'AccountTryController@postTryStart');
public function postTryStart(Request $request, $try_master_id)
{

  $license_question_try_master = License_question_try_master::find($try_master_id);

  if($license_question_try_master->active === 99){
    return redirect('/account/try/history/master/'.$try_master_id)->with('info', 'この試験はすでに採点済みです。');
  }elseif($license_question_try_master->active === 2){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はすでに開始しています。');
  }


  $license_question_try_master->active = 2;

  $license_examination_subject = License_examination_subject::select('time')->where('id',$license_question_try_master->license_examination_subject_id)->first();
  $license_question_try_master->time_limit = date("Y-m-d H:i:s",strtotime($license_examination_subject->time." minute"));

  $license_question_try_master->save();

  return redirect('/account/try/master/'.$try_master_id.'/license/'.$license_question_try_master->license_id.'/question/'.$license_question_try_master->start_question_id)->with('success', '試験を開始しました。');

}




#Route::get('done', 'AccountTryController@getTryDone');
public function getTryDone(Request $request, $try_master_id){

  $license_question_try_master = UtilLicense::getTryMasterAll($try_master_id);
  $license_id = $license_question_try_master->license_id;

  if($license_question_try_master->active === 99){
    return redirect('/account/try/history/master/'.$try_master_id)->with('info', 'この試験はすでに採点済みです。');
  }elseif($license_question_try_master->active === 1){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はまだ開始していません。');
  }

  $license_question_try_answers = License_question_try_answer::where('license_question_try_master_id',$try_master_id)->get();
  $all_answer = [];
  foreach($license_question_try_answers as $ans){
    $all_answer[$ans->license_question_id][$ans->license_question_contents_id] = $ans->license_question_contents_answer_id;
  }
  #################
  #科目単位ですべての問題を取得する。
  #################
  $all_question = [];
  $all_subject = [];
  if($license_question_try_master->license_examination_subject_id > 99990000)
  {

    $license_examination_subjects = License_examination_subject::select('id','step','name','time')
      ->where('license_id',$license_question_try_master->license_id)
      ->where('license_phase',$license_question_try_master->license_phase)
      ->where('id','<',99990000)
      ->orderBy('step')
      ->get();
    foreach($license_examination_subjects as $subj)
    {
      $all_subject[$subj->id] = $subj;
      $qess = License_question::select(
          'id',
          'number'
        )
        ->where('license_id',$license_question_try_master->license_id)
        ->where('license_schedule_id',$license_question_try_master->license_schedule_id)
        ->where('license_examination_subject_id',$subj->id)
        ->orderBy('number')
        ->get();
      foreach($qess as $q){
        $all_question[$subj->id][$q->id] = $q->number;
      }
    }
  }else{
    $qess = License_question::select(
        'id',
        'number'
      )
      ->where('license_id',$license_question_try_master->license_id)
      ->where('license_schedule_id',$license_question_try_master->license_schedule_id)
      ->where('license_examination_subject_id',$license_question_try_master->license_examination_subject_id)
      ->orderBy('number')
      ->get();
    foreach($qess as $q){
      $all_question[$license_question_try_master->license_examination_subject_id][$q->id] = $q->number;
    }
  }

  return View('account.try.done', compact('license_question_try_master','all_answer','all_question','all_subject','license_id'));

}








#Route::post('done', 'AccountTryController@postTryDone');
public function postTryDone(Request $request, $try_master_id)
{

  $license_question_try_master = License_question_try_master::find($try_master_id);
  $license_schedule = License_schedule::find($license_question_try_master->license_schedule_id);

  if($license_question_try_master->active === 99){
    return redirect('/account/try/history/master/'.$try_master_id)->with('info', 'この試験はすでに採点済みです。');
  }elseif($license_question_try_master->active === 1){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はまだ開始していません。');
  }
  
  #すべての解答を取得
  $license_question_try_answers = License_question_try_answer::where('license_question_try_master_id',$try_master_id)->get();
  $all_answer = [];
  foreach($license_question_try_answers as $ans){
    $all_answer[$ans->license_question_id][$ans->license_question_contents_id] = $ans->license_question_contents_answer_id;
  }

  #すべての科目の問題を取得
  $all_question = [];
  if($license_question_try_master->license_examination_subject_id > 99990000)
  {
    $license_examination_subjects = License_examination_subject::select('id','step','name','time')
      ->where('license_id',$license_question_try_master->license_id)
      ->where('license_phase',$license_schedule->license_phase)
      ->where('id','<',99990000)
      ->orderBy('step')
      ->get();
  }else{
    $license_examination_subjects = License_examination_subject::select('id','step','name','time')
      ->where('id',$license_question_try_master->license_examination_subject_id)
      ->orderBy('step')
      ->get();
  }

  #
  #採点処理
  #科目ごとにトライスコアテーブルに追加
  #
  foreach($license_examination_subjects as $subj)
  {
    
    $license_question_try_score = new License_question_try_score;
    $license_question_try_score->license_question_try_master_id = $try_master_id;
    $license_question_try_score->license_examination_subject_id = $subj->id;

    $total_question_contents = 0;
    $total_score = 0;
    $correct_number  = 0;
    $correct_score   = 0;
    $correct_rate    = 0;
    $rates = [];

    $first_question_id = null;

    $qess = License_question::select(
        'id'
      )
      ->where('license_id',$license_question_try_master->license_id)
      ->where('license_schedule_id',$license_question_try_master->license_schedule_id)
      ->where('license_examination_subject_id',$subj->id)
      ->orderBy('number')
      ->get();
    foreach($qess as $q){
      if(!$first_question_id) $first_question_id = $q->id;
      $contents = License_question_contents::select('id','license_question_contents_answer_id','points')
        ->where('license_question_id',$q->id)
        ->get();
      foreach($contents as $cont){
        $total_question_contents++;
        $total_score = $total_score + $cont->points;

        #$all_answer[$ans->license_question_id][$ans->license_question_contents_id] = $ans->license_question_contents_answer_id;
        if(
            isset($all_answer[$q->id][$cont->id]) and (
            $cont->license_question_contents_answer_id
             === 
            $all_answer[$q->id][$cont->id]
            )
          )
        {
          $correct_number++;
          $correct_score = $correct_score + $cont->points;
        }
      }
    }

    $license_question_try_score->total_question_contents = $total_question_contents;
    $license_question_try_score->total_score = $total_score;
    $license_question_try_score->correct_number  = $correct_number;
    $license_question_try_score->correct_score   = $correct_score;
    $rate = $correct_score / $total_score * 100;
    $license_question_try_score->correct_rate  = round( $rate, 2 );
    $rates[] = round( $rate, 2 );
    $license_question_try_score->save();

  }

  $license_question_try_master->start_question_id = $first_question_id;
  $license_question_try_master->active = 99;
  $rates_count = count($rates);
  $rate_sum = 0;
  foreach($rates as $ra){
    $rate_sum = $rate_sum + $ra;
  }
  $license_question_try_master->rate = round( $rate_sum/$rates_count, 2 );
  $license_question_try_master->save();

  return redirect('/account/try/history/master/'.$try_master_id.'/score');

}







public function getTryLicenseQuestion(Request $request, $try_master_id, $license_id, $license_question_id)
{

  
  $license_question_try_master = License_question_try_master::find($try_master_id);

  if($license_question_try_master->active === 99){
    return redirect('/account/try/history/master/'.$try_master_id)->with('info', 'この試験はすでに採点済みです。');
  }elseif($license_question_try_master->active === 1){
    return redirect('/account/try/master/'.$try_master_id.'/start')->with('info', 'この試験はまだ開始していません。');
  }
  if(!UtilLicense::checkTimeLimit($license_question_try_master)){
    return redirect('/account/try/master/'.$try_master_id.'/done')->with('warning', '試験の終了時間になりました。');
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

  $license_question_contents = License_question_contents::where('license_question_id',$license_question_id)
    ->get();
  $license_question_contents_answers = [];
  foreach($license_question_contents as $key=>$val){
    $license_question_contents_answers[$val->id] = License_question_contents_answer::where('license_question_contents_id',$val->id)->get();
  }
  
  #################
  #この問題のすべてのコンテンツとその解答内容を取得
  #################
  $temp = License_question_try_answer::where('license_question_try_master_id',$try_master_id)
    ->where('license_question_id',$license_question_id)
    ->get();
  $license_question_try_answers = [];
  foreach($temp as $tmp){
    if($license_question->license_phase === 1){
      $license_question_try_answers[$tmp->license_question_contents_id] = $tmp->license_question_contents_answer_id;
    }elseif($license_question->license_phase === 2){
      $license_question_try_answers[$tmp->license_question_contents_id] = $tmp->answer;
    }
  }

  #################
  #対象科目のすべての問題とその解答内容を取得
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
  $license_questions_try_answers = [];
  $temp = License_question_try_answer::select('license_question_id','license_question_contents_answer_id')
    ->where('license_question_try_master_id',$try_master_id)
    ->get();
  foreach($temp as $tmp){
    if($license_question->license_phase === 1){
      $license_questions_try_answers[$tmp->license_question_id] = $tmp->license_question_contents_answer_id;
    }elseif($license_question->license_phase === 2){
      $license_questions_try_answers[$tmp->license_question_id] = $tmp->license_question_id;
    }
    
  }

  #################
  #learnings
  #################
  $learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
    ->leftjoin('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->get();

  #################
  #literature
  #################
  $literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_literature', 'literature.id', '=', 'license_question_literature.literature_id')
    ->where('license_question_literature.license_question_id',$license_question_id)
    ->get();

  #################
  #License_examination_subject
  #################
  $license_examination_subjects = [];
  $license_examination_subjects_questions = [];
  if($license_question_try_master->license_examination_subject_id > 99990000)
  {
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
  }

  return View('account.try.license.question', compact(
      'license_question_try_master',
      'license_question',
      'license_questions',
      'license_question_try_answers',
      'license_questions_try_answers',
      'license_examination_subjects',
      'license_examination_subjects_questions',
      'learnings',
      'literature',
      'license_question_contents',
      'license_question_contents_answers',
      'license_id',
      'license_question_theme'
  ));

}





public function postTryLicenseQuestion(Request $request, $try_master_id, $license_id, $license_question_id)
{

  $contents_id = null;
  $answer_id = null;

  #いろいろ検索用にＦｉｎｄ
  $license_question = License_question::find($license_question_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  
  #毎回start_question_idを次の問題ＩＤに更新するためにＦＩＮＤ。
  $license_question_try_master = License_question_try_master::find($try_master_id);


  $contents_ids = [];
  if($license_schedule->license_phase === 1){
    foreach($request->all() as $key => $val){
      if(strstr($key,'answer_')){
        $temp=explode('_',$key);
        $contents_ids[(int)$temp[1]][] = (int)$temp[2];
      }
    }
    foreach($contents_ids as $val){
      if(count($val) > 1){
        return back()->with('warning', '解答は一つだけ選んでください。')->withInput();
      }
    }
    foreach($request->all() as $key => $val){
      if(strstr($key,'answer_')){
        $temp=explode('_',$key);
        $contents_id = (int)$temp[1];
        $answer_id = (int)$temp[2];
  
        if($license_question_try_answer = License_question_try_answer::where('license_question_try_master_id',$try_master_id)
          ->where('license_question_id',$license_question_id)
          ->where('license_question_contents_id',$contents_id)
          ->first())
        {
          $license_question_try_answer->license_question_contents_answer_id = $answer_id;
          $license_question_try_answer->save();
        }
        else
        {
          $license_question_try_answer = new License_question_try_answer;
          $license_question_try_answer->license_question_try_master_id = $try_master_id;
          $license_question_try_answer->license_examination_subject_id = $license_question->license_examination_subject_id;
          $license_question_try_answer->license_question_id = $license_question->id;
          $license_question_try_answer->license_question_contents_id = $contents_id;
          $license_question_try_answer->license_question_contents_answer_id = $answer_id;
          $license_question_try_answer->save();
        }
      }
    }
    if(!$contents_id){
      return back()->with('warning', '解答にチェックを入れてください。')->withInput();
    }
  }elseif($license_schedule->license_phase === 2){
    foreach($request->all() as $key => $val){
      if(strstr($key,'answer_')){
        $temp=explode('_',$key);
        $contents_ids[(int)$temp[1]] = $val;
      }
    }
    if(!$contents_ids){
      return back()->with('warning', '解答を入力してください。')->withInput();
    }
    foreach($contents_ids as $val){
      if(!$val){
        return back()->with('warning', '解答を入力してください。')->withInput();
      }
    }
    foreach($contents_ids as $contents_id => $answer){
        if($license_question_try_answer = License_question_try_answer::where('license_question_try_master_id',$try_master_id)
          ->where('license_question_id',$license_question_id)
          ->where('license_question_contents_id',$contents_id)
          ->first())
        {
          $license_question_try_answer->answer = $answer;
          $license_question_try_answer->save();
        }
        else
        {
          $license_question_try_answer = new License_question_try_answer;
          $license_question_try_answer->license_question_try_master_id = $try_master_id;
          $license_question_try_answer->license_examination_subject_id = $license_question->license_examination_subject_id;
          $license_question_try_answer->license_question_id = $license_question->id;
          $license_question_try_answer->license_question_contents_id = $contents_id;
          $license_question_try_answer->answer = $answer;
          $license_question_try_answer->save();
        }
    }
  }



  #
  #対象科目の全問題を抽出
  #
  $license_questions = License_question::select(
      'id',
      'number',
      'license_examination_subject_id'
    )
    ->where('license_id',$license_id)
    ->where('license_schedule_id',$license_question->license_schedule_id)
    ->where('license_examination_subject_id',$license_question->license_examination_subject_id)
    ->orderBy('number')
    ->get();
  
  #
  #次の問題判定
  #next_question_id
  #
  $on = false;
  $next_question_id = null;
  foreach($license_questions as $k=>$a){

    if($on and !$next_question_id){
      $next_question_id = $a->id;
    }
    if( $a->id === $license_question_try_answer->license_question_id ){
      $on = true;
    }

  }

  
  #
  #次の科目の問題判定
  #next_question_idがない場合で、次の科目がある場合、次の科目の最初の問題ＩＤを取得する。
  #
  $next_subject_question_id = null;
  if($next_question_id)
  {
    $license_question_try_master->start_question_id = $next_question_id;
    $license_question_try_master->save();
  }
  else
  {
    $license_examination_subject = License_examination_subject::find($license_question_try_master->license_examination_subject_id);
    if($license_examination_subject->step === 9999 ){
      $license_examination_subject_next = License_examination_subject::where('license_id',$license_examination_subject->license_id)
        ->where('license_phase',$license_examination_subject->license_phase)
        ->where('step','>',$license_examination_subject->step)
        ->orderBy('step')
        ->first();
      if(count($license_examination_subject_next)){
        $next_subject_question = License_question::where('license_id',$license_id)
          ->where('license_schedule_id',$license_question->license_schedule_id)
          ->where('license_examination_subject_id',$license_examination_subject_next->id)
          ->orderBy('number')
          ->first();
        $next_subject_question_id = $next_subject_question->id;
        $license_question_try_master->start_question_id = $next_subject_question->id;
        $license_question_try_master->save();
      }
    }
  }

  if(!$next_question_id and !$next_subject_question_id){
    return redirect('/account/try/master/'.$try_master_id.'/done');
  }

  return redirect('/account/try/master/'.$try_master_id.'/license/'.$license_id.'/question/'.$license_question_try_master->start_question_id);

}













}


