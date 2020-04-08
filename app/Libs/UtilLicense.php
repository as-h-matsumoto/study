<?php
namespace App\Libs;

use Util;
use Utilowner;
use DateTime;
use Auth;
use Mail;
use DB;
use Session;

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



class UtilLicense
{





  public static function getLicenseScheduleStatisticsSummary($key = null)
  {
  
    $tag = [
      'number_of_applicants'                      =>   '申込人数',
      'number_of_candidates_onemore'              =>   '1科目以上受験者数',
      'number_of_applicants_all'                  =>   '全科目受験者数',
      'number_of_oral_examination'                =>   '口述試験受験者数',
      'passing_number'                            =>   '試験合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }


  public static function getLicenseScheduleStatisticsPerson($key = null)
  {
  
    $tag = [
      'man'                                       =>   '男性申込数',
      'wom'                                       =>   '女性申込数',
      'under20'                                   =>   '２０才未満申込者数',
      'under29'                                   =>   '２０～２９才未満申込者数',
      'under39'                                   =>   '３０～３９才未満申込者数',
      'under49'                                   =>   '４０～４９才未満申込者数',
      'under59'                                   =>   '５０～５９才未満申込者数',
      'under69'                                   =>   '６０～６９才未満申込者数',
      'older70'                                   =>   '７０才以上申込者数',
      'pass_man'                                  =>   '男性試験合格者数',
      'pass_wom'                                  =>   '女性試験合格者数',
      'pass_under20'                              =>   '２０歳未満試験合格者数',
      'pass_under29'                              =>   '２０～２９歳試験合格者数',
      'pass_under39'                              =>   '３０～３９歳試験合格者数',
      'pass_under49'                              =>   '４０～４９歳試験合格者数',
      'pass_under59'                              =>   '５０～５９歳試験合格者数',
      'pass_under69'                              =>   '６０～６９歳試験合格者数',
      'pass_older70'                              =>   '７０歳以上試験合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }


  public static function getLicenseScheduleStatisticsArea($key = null)
  {
  
    $tag = [
      'area_sapporo'                              =>   '札幌エリア申込者数',
      'area_sendai'                               =>   '仙台エリア申込者数',
      'area_tokyo'                                =>   '東京エリア申込者数',
      'area_nagoya'                               =>   '名古屋エリア申込者数',
      'area_osaka'                                =>   '大阪エリア申込者数',
      'area_hiroshima'                            =>   '広島エリア申込者数',
      'area_fukuoka'                              =>   '福岡エリア申込者数',
      'area_naha'                                 =>   '那覇エリア申込者数',
      'pass_area_sapporo'                         =>   '札幌エリア試験合格者数',
      'pass_area_sendai'                          =>   '仙台エリア試験合格者数',
      'pass_area_tokyo'                           =>   '東京エリア試験合格者数',
      'pass_area_nagoya'                          =>   '名古屋エリア試験合格者数',
      'pass_area_osaka'                           =>   '大阪エリア試験合格者数',
      'pass_area_hiroshima'                       =>   '広島エリア試験合格者数',
      'pass_area_fukuoka'                         =>   '福岡エリア試験合格者数',
      'pass_area_naha'                            =>   '那覇エリア試験合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }



  public static function getLicenseScheduleStatisticsWork($key = null)
  {
  
    $tag = [
      'work_consultant'                           =>   '経営コンサルタント自営業者申込者数',
      'work_Accountant'                           =>   '税理士・公認会計士等自営業者数',
      'work_self'                                 =>   'コンサル、会計士以外の自営業者申込数',
      'work_belongs_consultant'                   =>   '経営コンサルタント事業所等勤務者申込数',
      'work_belongs_private'                      =>   '民間企業勤務者申込数',
      'work_belongs_government_finance'           =>   '政府系金融機関勤務者申込数',
      'work_belongs_nogovernment_finance'         =>   '政府系以外の金融機関勤務者申込数',
      'work_belongs_sme_support'                  =>   '中小企業支援機関者申込数',
      'work_belongs_administration'               =>   '独立行政法人・公益法人等勤務者申込数',
      'work_belongs_public_servant'               =>   '公務員者申込数',
      'work_belongs_teacher'                      =>   '研究・教育者申込数',
      'work_belongs_student'                      =>   '学生者申込数',
      'work_notworker'                            =>   'その他申込数',
      'pass_work_consultant'                      =>   '経営コンサルタント自営業試験合格者数',
      'pass_work_Accountant'                      =>   '税理士・公認会計士等自営業試験合格者数',
      'pass_work_self'                            =>   'コンサル、会計士以外の自営業者試験合格者数',
      'pass_work_belongs_consultant'              =>   '経営コンサルタント事業所等勤務試験合格者数',
      'pass_work_belongs_private'                 =>   '民間企業勤務試験合格者数',
      'pass_work_belongs_government_finance'      =>   '政府系金融機関勤務試験合格者数',
      'pass_work_belongs_nogovernment_finance'    =>   '政府系以外の金融機関勤務試験合格者数',
      'pass_work_belongs_sme_support'             =>   '中小企業支援機関試験合格者数',
      'pass_work_belongs_administration'          =>   '独立行政法人・公益法人等勤務試験合格者数',
      'pass_work_belongs_public_servant'          =>   '公務員試験合格者数',
      'pass_work_belongs_teacher'                 =>   '研究・教育試験合格者数',
      'pass_work_belongs_student'                 =>   '学生試験合格者数',
      'pass_work_notworker'                       =>   'その他試験合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }




  public static function getLicenseScheduleStatisticsSubject($key = null)
  {
  
    $tag = [
      'subject_economics_economic'               =>   '経済学・経済政策科目受験者',
      'subject_financial_accounting'              =>   '財務・会計科目受験者',
      'subject_corporate_management_theory'       =>   '企業経営理論科目受験者',
      'subject_operational_management'            =>   '運営管理科目受験者',
      'subject_management_law'                    =>   '経営法務科目受験者',
      'subject_management_information'            =>   '経営情報システム科目受験者',
      'subject_sme_management'                    =>   '中小企業経営・中小企業政策科目受験者',
      'pass_subject_economics_economic'           =>   '経済学・経済政策科目合格者数',
      'pass_subject_financial_accounting'         =>   '財務・会計科目合格者数',
      'pass_subject_corporate_management_theory'  =>   '企業経営理論科目合格者数',
      'pass_subject_operational_management'       =>   '運営管理科目合格者数',
      'pass_subject_management_law'               =>   '経営法務科目合格者数',
      'pass_subject_management_information'       =>   '経営情報システム科目合格者数',
      'pass_subject_sme_management'               =>   '中小企業経営・中小企業政策科目合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }



  public static function getLicenseScheduleStatistics($key = null)
  {
  
    $tag = [
      'man'                                       =>   '男性申込数',
      'wom'                                       =>   '女性申込数',
      'under20'                                   =>   '２０才未満申込者数',
      'under29'                                   =>   '２０～２９才未満申込者数',
      'under39'                                   =>   '３０～３９才未満申込者数',
      'under49'                                   =>   '４０～４９才未満申込者数',
      'under59'                                   =>   '５０～５９才未満申込者数',
      'under69'                                   =>   '６０～６９才未満申込者数',
      'older70'                                   =>   '７０才以上申込者数',
      'area_sapporo'                              =>   '札幌エリア申込者数',
      'area_sendai'                               =>   '仙台エリア申込者数',
      'area_tokyo'                                =>   '東京エリア申込者数',
      'area_nagoya'                               =>   '名古屋エリア申込者数',
      'area_osaka'                                =>   '大阪エリア申込者数',
      'area_hiroshima'                            =>   '広島エリア申込者数',
      'area_fukuoka'                              =>   '福岡エリア申込者数',
      'area_naha'                                 =>   '那覇エリア申込者数',
      'work_consultant'                           =>   '経営コンサルタント自営業者申込者数',
      'work_Accountant'                           =>   '税理士・公認会計士等自営業者数',
      'work_self'                                 =>   'コンサル、会計士以外の自営業者申込数',
      'work_belongs_consultant'                   =>   '経営コンサルタント事業所等勤務者申込数',
      'work_belongs_private'                      =>   '民間企業勤務者申込数',
      'work_belongs_government_finance'           =>   '政府系金融機関勤務者申込数',
      'work_belongs_nogovernment_finance'         =>   '政府系以外の金融機関勤務者申込数',
      'work_belongs_sme_support'                  =>   '中小企業支援機関者申込数',
      'work_belongs_administration'               =>   '独立行政法人・公益法人等勤務者申込数',
      'work_belongs_public_servant'               =>   '公務員者申込数',
      'work_belongs_teacher'                      =>   '研究・教育者申込数',
      'work_belongs_student'                      =>   '学生者申込数',
      'work_notworker'                            =>   'その他申込数',
      'subject_economics_economic	'               =>   '経済学・経済政策科目受験者',
      'subject_financial_accounting'              =>   '財務・会計科目受験者',
      'subject_corporate_management_theory'       =>   '企業経営理論科目受験者',
      'subject_operational_management'            =>   '運営管理科目受験者',
      'subject_management_law'                    =>   '経営法務科目受験者',
      'subject_management_information'            =>   '経営情報システム科目受験者',
      'subject_sme_management'                    =>   '中小企業経営・中小企業政策科目受験者',
      'pass_man'                                  =>   '男性試験合格者数',
      'pass_wom'                                  =>   '女性試験合格者数',
      'pass_under20'                              =>   '２０歳未満試験合格者数',
      'pass_under29'                              =>   '２０～２９歳試験合格者数',
      'pass_under39'                              =>   '３０～３９歳試験合格者数',
      'pass_under49'                              =>   '４０～４９歳試験合格者数',
      'pass_under59'                              =>   '５０～５９歳試験合格者数',
      'pass_under69'                              =>   '６０～６９歳試験合格者数',
      'pass_older70'                              =>   '７０歳以上試験合格者数',
      'pass_area_sapporo'                         =>   '札幌エリア試験合格者数',
      'pass_area_sendai'                          =>   '仙台エリア試験合格者数',
      'pass_area_tokyo'                           =>   '東京エリア試験合格者数',
      'pass_area_nagoya'                          =>   '名古屋エリア試験合格者数',
      'pass_area_osaka'                           =>   '大阪エリア試験合格者数',
      'pass_area_hiroshima'                       =>   '広島エリア試験合格者数',
      'pass_area_fukuoka'                         =>   '福岡エリア試験合格者数',
      'pass_area_naha'                            =>   '那覇エリア試験合格者数',
      'pass_work_consultant'                      =>   '経営コンサルタント自営業試験合格者数',
      'pass_work_Accountant'                      =>   '税理士・公認会計士等自営業試験合格者数',
      'pass_work_self'                            =>   'コンサル、会計士以外の自営業者試験合格者数',
      'pass_work_belongs_consultant'              =>   '経営コンサルタント事業所等勤務試験合格者数',
      'pass_work_belongs_private'                 =>   '民間企業勤務試験合格者数',
      'pass_work_belongs_government_finance'      =>   '政府系金融機関勤務試験合格者数',
      'pass_work_belongs_nogovernment_finance'    =>   '政府系以外の金融機関勤務試験合格者数',
      'pass_work_belongs_sme_support'             =>   '中小企業支援機関試験合格者数',
      'pass_work_belongs_administration'          =>   '独立行政法人・公益法人等勤務試験合格者数',
      'pass_work_belongs_public_servant'          =>   '公務員試験合格者数',
      'pass_work_belongs_teacher'                 =>   '研究・教育試験合格者数',
      'pass_work_belongs_student'                 =>   '学生試験合格者数',
      'pass_work_notworker'                       =>   'その他試験合格者数',
      'pass_subject_economics_economic'           =>   '経済学・経済政策科目合格者数',
      'pass_subject_financial_accounting'         =>   '財務・会計科目合格者数',
      'pass_subject_corporate_management_theory'  =>   '企業経営理論科目合格者数',
      'pass_subject_operational_management'       =>   '運営管理科目合格者数',
      'pass_subject_management_law'               =>   '経営法務科目合格者数',
      'pass_subject_management_information'       =>   '経営情報システム科目合格者数',
      'pass_subject_sme_management'               =>   '中小企業経営・中小企業政策科目合格者数'
    ];
  
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';
  
  }



  public static function getTryMasterAll($try_master_id)
  {

    $license_question_try_master = License_question_try_master::select(
      'license.id as license_id',       #試験ＩＤ
      'license.name as license_name',  #試験名
      'license_schedule.id as license_schedule_id', #試験スケジュールＩＤ
      'license_schedule.license_year',  #試験年度
      'license_schedule.license_phase', #試験フェーズ（１か２）
      'license_schedule.name as schedule_name', #（一次試験、か、二次試験）
      'license_examination_subject.id as license_examination_subject_id', #試験科目ＩＤ、全科目は「9999999」
      'license_examination_subject.name as subject_name', #試験科目名、全科目は「全科目」
      'license_examination_subject.step as subject_step', #試験科目番号、全科目は「9999」
      'license_examination_subject.time as subject_time', #試験時間、全科目は「325, or 530」
      'license_question_try_master.id as try_master_id',  #問題トライマスターＩＤ
      'license_question_try_master.type as master_type',  #'１：練習、２：模擬'
      'license_question_try_master.rate as rate',  #'１：練習、２：模擬'
      'license_question_try_master.active as active', #99：試験終了、1：試験前、2：試験中（time_limitを超えていたら終了、もしくは、終了ボタンを押した場合）
      'license_question_try_master.start_question_id as start_question_id', #開始の問題ＩＤ
      'license_question_try_master.time_limit as master_time_limit' #試験終了時間
      )
      ->leftjoin('license', 'license.id', '=', 'license_question_try_master.license_id')
      ->leftjoin('license_schedule', 'license_schedule.id', '=', 'license_question_try_master.license_schedule_id')
      ->leftjoin('license_examination_subject', 'license_examination_subject.id', '=', 'license_question_try_master.license_examination_subject_id')
      ->where('license_question_try_master.id',$try_master_id)
      ->first();
  
    return $license_question_try_master;

  }



  public static function checkTryStart($license_question_try_master)
  {

    if($license_question_try_master->active === 1){
      return true;
    }

    if( $license_question_try_master->active === 99 )
    {
      return redirect('/account/try/history')->with('warning', 'この受験は終了しています。');
    }
    elseif( $license_question_try_master->active === 2 )
    { //試験中
      if( $license_question_try_master->master_type === 2 )
      { #模擬試験
        if( strtotime($license_question_try_master->master_time_limit) < strtotime(date('Y-m-d H:i:s')) )
        {
          return redirect('/account/try/master/'.$license_question_try_master->id.'/done')->with('warning', '試験は終了しました。'); 
        }
      }elseif( $license_question_try_master->master_type === 1 )
      { #練習問題
        return redirect('/account/try/master/'.$license_question_try_master->id.'/license/'.$license_question_try_master->license_id.'/question/'.$license_question_try_master->start_question_id);
      }
    }

    return redirect('/account/try/history')->with('warning', '試験タイプを認識できません。');
  
  }


  public static function checkTimeLimit($license_question_try_master)
  {

    if($license_question_try_master->type === 2){
      if( strtotime($license_question_try_master->time_limit) < strtotime(date('Y-m-d H:i:s')) )
      {
        return false;
      }
    }
    
    return true;
  
  }


  public static function getLearning($data, $summry = null)
  {

    $learnings = [];

    foreach($data as $k => $v){

      if($summry){
        switch ( $v['level'] ){
          case 1: $learnings[] = Learning_top::select('id','name')->find( $v['id'] ); break;
          case 2: $learnings[] = Learning_second::select('id','name')->find( $v['id'] ); break;
          case 3: $learnings[] = Learning_third::select('id','name')->find( $v['id'] ); break;
          case 4: $learnings[] = Learning_fourth::select('id','name')->find( $v['id'] ); break;
        }
      }else{
        switch ( $v['level'] ){
          case 1: $learnings[] = Learning_top::find( $v['id'] ); break;
          case 2: $learnings[] = Learning_second::find( $v['id'] ); break;
          case 3: $learnings[] = Learning_third::find( $v['id'] ); break;
          case 4: $learnings[] = Learning_fourth::find( $v['id'] ); break;
        }
      }
    
    }
    
    return $learnings;

  }



  public static function getLiterature($data)
  {

    $literatures = [];

    foreach($data as $k => $v){

      $literatures[] = Literature::find( $v['id'] );

    }
    
    return $licenses;

  }



  public static function getLicense($data)
  {

    $licenses = [];

    foreach($data as $k => $v){

      $license['License'] = License::find( $v['id'] );
      $license['License_schedule'] = License_schedule::where('license_id', $v['id'])->first();
      $license['License_examination_subject'] = License_examination_subject::where('license_id', $v['id'])->first();
      $license['License_phase'] = License_phase::where('license_id', $v['id'])->first();
      $license['License_pass_rate'] = License_pass_rate::where('license_id', $v['id'])->first();

      $licenses[] = $license;

    }
    
    return $licenses;

  }



  public static function getLicenseQuestion($data)
  {

    $license_questions = [];

    foreach($data as $k => $v){

      $license_question['License_question'] = License_question::find( $v['id'] );
      $license_question_id = $license['License_question']->id;
      
      $license_question['License_question_answer'] = License_question_answer::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_figure'] = License_question_figure::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_note'] = License_question_note::where('license_question_id', $license_question_id)->get();

      $learnings = License_question_learning::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_learning'] = UtilLicense::getLicenseQuestionLearning($learnings);

      $literatures = License_question_literature::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_literature'] = UtilLicense::getLiterature($literatures);

      $license_id = $license['License_question']->license_id;
      $license_question['License'] = License::find( $license_id );
      $license_question['License_examination_subject'] = License_examination_subject::where('license_id', $license_id)->first();
      $license_question['License_phase'] = License_phase::where('license_id', $license_id)->first();

      $license_questions[] = $license_question;

    }
    
    return $license_questions;

  }


  public static function getUsersLicenseQuestion($user_id, $count = false)
  {

    $license_questions = [];

    $Questions = License_question::select('id')->where('user_id', $user_id)->get();

    if($count){ return count($Questions); }

    foreach($Questions as $k => $v){

      $license_question['License_question'] = License_question::find( $v['id'] );
      $license_question_id = $license['License_question']->id;
      
      $license_question['License_question_answer'] = License_question_answer::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_figure'] = License_question_figure::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_note'] = License_question_note::where('license_question_id', $license_question_id)->get();

      $learnings = License_question_learning::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_learning'] = UtilLicense::getLicenseQuestionLearning($learnings);

      $literatures = License_question_literature::where('license_question_id', $license_question_id)->get();
      $license_question['License_question_literature'] = UtilLicense::getLiterature($literatures);

      $license_id = $license['License_question']->license_id;
      $license_question['License'] = License::find( $license_id );
      $license_question['License_examination_subject'] = License_examination_subject::where('license_id', $license_id)->first();
      $license_question['License_phase'] = License_phase::where('license_id', $license_id)->first();

      $license_questions[] = $license_question;

    }
    
    return $license_questions;

  }
  
}
