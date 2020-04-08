<?php namespace App\Http\Controllers\owner\license\question\contents;

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
use App\models\License_schedule;
use App\models\License_schedule_examination_subject;
use App\models\License_schedule_pass_rate;
use App\models\License_schedule_statistics;
use App\models\Literature;

use App\models\License_question_try_master;
use App\models\License_question_try_answer;
use App\models\License_question_try_score;

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

class OwnerLicenseQuestionContentsController extends Controller {

public function __construct()
{

}












public function indexLicenseQuestionContents(Request $request, $license_id, $license_question_id)
{

  $license = License::find($license_id);
  $license_questions = License_question::select('license.name as license_name','license_question.id','license_question.number','license_question.user_id','license_question.license_id','license_question.license_schedule_id','license_question.license_question_answer_id','license_question.license_examination_subject_id','license_question.level','license_question.question','license_question.figure1','license_question.figure2','license_question.note','license_question.commentary','license_question.recommend_number','license_question.recommend_point','license_question.good_number','license_question.bad_number','license_question.created_at','license_question.updated_at','license_schedule.license_year','license_schedule.license_phase','license_schedule.name as schedule_name','license_schedule.start as schedule_start','license_schedule.end as schedule_end','license_examination_subject.name as subject_name','license_examination_subject.about as subject_about')
    ->leftJoin('license', 'license.id', '=', 'license_question.license_id')
    ->leftJoin('license_schedule', 'license_schedule.id', '=', 'license_question.license_schedule_id')
    ->leftJoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question.license_examination_subject_id')
    ->where('id.license_question_id',$license_question_id)
    ->first();
  $license_question_contents = License_question_contents::where('license_question_id',$license_question_id)->take(6)->get();
  $favo = Util::getFavo('license_question');

  return View('owner.license.question.contents.index', compact('license','license_questions','license_question_contents','favo'));

}




public function getCreateLicenseQuestionContents(Request $request, $license_id, $license_question_id)
{

  $license = License::find($license_id);
  $license_question = License_question::find($license_question_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  $license_examination_subject = License_examination_subject::find($license_question->license_examination_subject_id);
  $license_question_contents = new License_question_contents;

  return View('owner.license.question.contents.create', compact('license','license_examination_subject','license_schedule','license_question','License_question_contents'));

}




public function postCreateLicenseQuestionContents(Request $request, $license_id, $license_question_id)
{

  $this->validate($request, [
    'number'       => 'required'
  ]);

  $license_question = License_question::find($license_question_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  
  $license_question_contents = License_question_contents::where('license_question_id',$license_question_id)->where('number',$request->get('number'))->first();
  if($license_question_contents){
    return redirect('/owner/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/edit')->with('warning', 'すでに設問'.$license_question_contents->number.'は作成済みです。こちらから編集してください。');
  }
  $license_question_contents = new License_question_contents;
  $license_question_contents->license_question_id = $license_question_id;
  $license_question_contents->question = $request->get('question');
  $license_question_contents->level = 3;
  $license_question_contents->number = $request->get('number');
  $license_question_contents->note = $request->get('note');
  $license_question_contents->commentary = $request->get('commentary');
  if($request->get('points')){
    $license_question_contents->points = $request->get('points');
  }else{
    $license_question_contents->points = 4;
  }
  $license_question_contents->save();
  //$license_question_contents->commentary = $request->get('commentary');

  $figure1 = $request->file('figure1');
  if($figure1){
    $pic_size = filesize($figure1);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/';
    $pic_name = 'figure1_' . $license_question_contents->id . '_' . uniqid() . '.' . $figure1->extension();
    $license_question_contents->figure1 = Util::formFileToImageLicenseQuestion($figure1, $pic_path, $license_question_contents->figure1, $pic_name );    
  }

  $figure2 = $request->file('figure2');
  if($figure2){
    $pic_size = filesize($figure2);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/';
    $pic_name = 'figure2_' . $license_question_contents->id . '_' . uniqid() . '.' . $mainPic->extension(); 
    $license_question_contents->figure2 = Util::formFileToImageLicenseQuestion($figure2, $pic_path, $license_question_contents->figure2, $pic_name );
  }

  if($license_schedule->license_phase === 1){
    for($i = 0; $i < 8; $i++) {
      if($request->get('answer'.$i)){
        $license_question_contents_answer = new License_question_contents_answer;
        $license_question_contents_answer->license_question_contents_id = $license_question_contents->id;
        $license_question_contents_answer->answer = $request->get('answer'.$i);
        $license_question_contents_answer->save();
      }
      if($request->has('license_answer'.$i)){
        $license_question_contents->license_question_contents_answer_id = $license_question_contents_answer->id;
      }
    }
    if(!$license_question_contents->license_question_contents_answer_id) return back()->with('warning', '答えにチェックを入れてください。')->withInput();
  }

  $license_question_contents->save();
  
  return redirect('/owner/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/show')->with('success', '登録しました。');

}









public function getEditLicenseQuestionContents(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $license = License::find($license_id);
  $license_question = License_question::find($license_question_id);
  $license_examination_subject = License_examination_subject::find($license_question->license_examination_subject_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  $license_question_contents = License_question_contents::find($license_question_contents_id);
  $license_question_contents_answer = License_question_contents_answer::where('license_question_contents_id',$license_question_contents_id)->get();
  
  return View('owner.license.question.contents.edit', compact('license','license_question','license_examination_subject','license_schedule','license_question_contents','license_question_contents_answer'));

}




public function postEditLicenseQuestionContents(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $this->validate($request, [
    'number'       => 'required'
  ]);

  $license_question = License_question::find($license_question_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);

  $license_question_contents = License_question_contents::find($license_question_contents_id);
  $license_question_contents->question = $request->get('question');
  $license_question_contents->note = $request->get('note');
  $license_question_contents->number = $request->get('number');
  if($request->get('points')){
    $license_question_contents->points = $request->get('points');
  }else{
    $license_question_contents->points = 4;
  }
  $license_question_contents->commentary = $request->get('commentary');

  $figure1 = $request->file('figure1');
  if($figure1){
    $pic_size = filesize($figure1);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/';
    $pic_name = 'figure1_' . $license_question_contents->id . '_' . uniqid() . '.' . $figure1->extension();
    $license_question_contents->figure1 = Util::formFileToImageLicenseQuestion($figure1, $pic_path, $license_question_contents->figure1, $pic_name );    
  }

  $figure2 = $request->file('figure2');
  if($figure2){
    $pic_size = filesize($figure2);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/';
    $pic_name = 'figure2_' . $license_question_contents->id . '_' . uniqid() . '.' . $mainPic->extension(); 
    $license_question_contents->figure2 = Util::formFileToImageLicenseQuestion($figure2, $pic_path, $license_question_contents->figure2, $pic_name );
  }

  if($license_schedule->license_phase === 1){
    $license_question_contents->license_question_contents_answer_id = null;
    License_question_contents_answer::where('license_question_contents_id',$license_question_contents_id)->delete();
    for($i = 0; $i < 8; $i++) {
      if($request->get('answer'.$i)){
        $license_question_contents_answer = new License_question_contents_answer;
        $license_question_contents_answer->license_question_contents_id = $license_question_contents->id;
        $license_question_contents_answer->answer = $request->get('answer'.$i);
        $license_question_contents_answer->save();
      }
      if($request->has('license_answer'.$i)){
        $license_question_contents->license_question_contents_answer_id = $license_question_contents_answer->id;
      }
    }
    if(!$license_question_contents->license_question_contents_answer_id) return back()->with('warning', '答えにチェックを入れてください。')->withInput();
  }

  $license_question_contents->save();
  
  return redirect('/owner/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents->id . '/show')->with('success', '変更しました。');

}



public function openCloseLicenseQuestionContents(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $license_question = License_question::find($license_question_id);
  $license_question->owner_open = ($license_question->owner_open===1) ? 0 : 1;
  $license_question->save();

  return ['err'=>0, 'owner_open'=>$license_question->owner_open];

}














public function showLicenseQuestionContents(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $license = License::find($license_id);


  #################
  #License_question
  #################
  $license_question = License_question::find($license_question_id);
  $license_examination_subject = License_examination_subject::find($license_question->license_examination_subject_id);
  $license_schedule = License_schedule::find($license_question->license_schedule_id);
  $last_question_number = License_question::select('number')->where('license_id',$license_id)->orderBy('number','desc')->first();
  $last_question_number = $last_question_number->number;

  $next = License_question::select('id')
    ->where('license_id',$license_id)
    ->where('number','>',$license_question->number)
    ->orderBy('number','asc')
    ->first();
  $next_license_question_id = null;
  if($next){
    $next_license_question_id = $next->id;
  }
  
  $before = License_question::select('id')
  ->where('license_id',$license_id)
  ->where('number','<',$license_question->number)
  ->orderBy('number','desc')
  ->first();
  $before_license_question_id = null;
  if($before){
    $before_license_question_id = $before->id;
  }

  $learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
    ->leftjoin('license_question_learning', 'learning.id', '=', 'license_question_learning.learning_id')
    ->where('license_question_learning.license_question_id',$license_question_id)
    ->get();

  $learning_region = [];
  $learning_relation = [];
  foreach($learnings as $key=>$val){
    $learning_region[$key] = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
      ->leftjoin('learning_region', 'learning.id', '=', 'learning_region.learning_id')
      ->where('learning_region.learning_id',$val->id)
      ->get();
    $learning_relation[$key] = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
      ->leftjoin('learning_relation', 'learning.id', '=', 'learning_relation.learning_id')
      ->where('learning_relation.learning_id',$val->id)
      ->get();
  }
  $literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_literature', 'literature.id', '=', 'license_question_literature.literature_id')
    ->where('license_question_literature.license_question_id',$license_question_id)
    ->get();


  #################
  #license_question_contents
  #################
  $license_question_contents = License_question_contents::find($license_question_contents_id);
  $license_question_contents_answer = License_question_contents_answer::where('license_question_contents_id',$license_question_contents_id)->get();

  $next_con = license_question_contents::select('id')
    ->where('license_question_id',$license_question_id)
    ->where('number','>',$license_question_contents->number)
    ->orderBy('number','asc')
    ->first();
  $next_license_question_contents_id = null;
  if($next_con){
    $next_license_question_contents_id = $next_con->id;
  }
  
  $before_con = license_question_contents::select('id')
    ->where('license_question_id',$license_question_id)
    ->where('number','<',$license_question_contents->number)
    ->orderBy('number','desc')
    ->first();
  $before_license_question_contents_id = null;
  if($before_con){
    $before_license_question_contents_id = $before_con->id;
  }

  $con_learnings = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
  ->leftjoin('license_question_contents_learning', 'learning.id', '=', 'license_question_contents_learning.learning_id')
  ->where('license_question_contents_learning.license_question_contents_id',$license_question_contents_id)
  ->get();

  $con_learning_region = [];
  $con_learning_relation = [];
  foreach($con_learnings as $key=>$val){
    $con_learning_region[$key] = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
      ->leftjoin('learning_region', 'learning.id', '=', 'learning_region.learning_id')
      ->where('learning_region.learning_id',$val->id)
      ->get();
    $con_learning_relation[$key] = Learning::select('learning.id','learning.pageid','learning.name','learning.description','learning.url')
      ->leftjoin('learning_relation', 'learning.id', '=', 'learning_relation.learning_id')
      ->where('learning_relation.learning_id',$val->id)
      ->get();
  }
  $con_literature = Literature::select('literature.id','literature.name','literature.description','literature.url')
    ->join('license_question_contents_literature', 'literature.id', '=', 'license_question_contents_literature.literature_id')
    ->where('license_question_contents_literature.license_question_contents_id',$license_question_contents_id)
    ->get();
  
  return View('owner.license.question.contents.show', compact(
      'license',
      'license_question',
      'license_examination_subject',
      'license_schedule',
      'license_question_answer',
      'learnings',
      'learning_region',
      'learning_relation',
      'literature',
      'last_question_number',
      'next_license_question_id',
      'before_license_question_id',
      'license_question_contents',
      'license_question_contents_answer',
      'next_license_question_contents_id',
      'before_license_question_contents_id',
      'con_learnings',
      'con_learning_region',
      'con_learning_relation',
      'con_literature'
  ));

}





public function deleteLicenseQuestionContents(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  License_question_learning::where('license_question_id',$license_question_id)->delete();
  License_question_answer::where('license_question_id',$license_question_id)->delete();

  $license_question = License_question::find($license_question_id);
  $pic_path = '/uploads/license/' . $license_question_id . '/';

  Util::deleteImage($pic_path,$license_question->figure1);
  Util::deleteImage($pic_path,$license_question->figure2);

  $license_question->delete();

}






public function postLicenseQuestionContentsLearning(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $this->validate($request, [
    'pageid'     => 'required',
    'title'      => 'required',
    'snippet'    => 'required'
  ]);

  $learning = Learning::where( 'pageid', $request->get('pageid') )->first();
  if(!$license_question_learning){
    $learning = new Learning;
    $learning->pageid = $request->get('pageid');
    $learning->name = $request->get('title');
    $learning->description = $request->get('snippet');
    $learning->save();
  }

  $license_question_learning = License_question_learning::where( 'learning_id', $learning->id )->first();
  if($license_question_learning){
    return 'doNo';
  }
  $license_question_learning = new License_question_learning;
  $license_question_learning->license_question_id = $license_question_id;
  $license_question_learning->learning_id = $learning->id;
  $license_question_learning->save();

  $ans = ['err'=>0, 'message'=>'', 'learning'=>$learning, 'region_up'=>null, 'region_down'=>null];
  
  $learning_region = Learning_region::select('id')->where('learning_id',$learning->id)->first;
  if($learning_region){
    return $ans;
  }

  #上位学問
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&prop=categories'; #propを変更して
  $url_parameter_search_word = '&pageids='.$request->get('pageid');
  $url = $url . $url_parameter . $url_parameter_search_word;
  $ans['region_up'] = file_get_contents($url, true);




  #下位学問
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&prop=links'; #propを変更して
  $url_parameter_search_word = '&pageids=166978';

  $url = $url . $url_parameter . $url_parameter_search_word;

  $wiki = file_get_contents($url, true);

  $wiki = json_decode($wiki,true);

  $count = 1;
  foreach($wiki as $val){
    print_r($count);
    if($count===2){
      foreach($val as $a){
        foreach($a as $b){
          foreach($b['links'] as $c){
            print_r($c);
          }
        }
      }
    }
    $count++;
  }






}









public function postLicenseQuestionContentsLearningRegion(Request $request, $license_id, $license_question_id, $license_question_contents_id)
{

  $this->validate($request, [
    'learning_id'  => 'required',
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







}