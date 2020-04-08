<?php namespace App\Http\Controllers\owner\learning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use App\models\Learning;
use App\models\Learning_region;
use App\models\Learning_relation;
use App\models\License_examination_subject;
use App\models\License_question;
use App\models\License_question_answer;
use App\models\License_question_learning;
use App\models\License_question_literature;
use App\models\License_schedule;
use App\models\License_schedule_examination_subject;
use App\models\License_schedule_pass_rate;
use App\models\License_schedule_statistics;

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

class OwnerLearningController extends Controller {

public function __construct()
{

}





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







}