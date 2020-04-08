<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Favorite;
use App\models\Company;
use App\models\owner_service;
use App\models\Country;
use App\models\Country_area;
use App\models\Content_recruit_type;
use App\models\Content_menu_recruit;

use App\User;
use App\models\Contents;
use App\models\Content_date;
use App\models\Recommends;
use App\models\Recommends_pics;

use App\models\Event;

use App\models\Messages;
use App\models\Messages_notread;

use Response;
use Mail;
use Validator;
use Redirect;
use Auth;
use DB;
use Storage;
use Image;
use Util;
use Utilowner;

use Wikipedia;
use MediaWiki;

class TestController extends Controller {

public function __construct()
{
}




public function test1(Request $request, $search_words = null)
{

  $search_words = 'エマ・ワトソン';
  $search_words = '総需要';

  #https://ja.wikipedia.org/?curid=128948
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&list=search';
  $url_parameter_search_word = '&srsearch=' . urlencode($search_words);

  $url = $url . $url_parameter . $url_parameter_search_word;

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





public function test2(Request $request, $search_words = null)
{

  $search_words = 'エマ・ワトソン';
  $search_words = '総需要';

  #links 　　　下位学問かも。

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

  exit;

}





public function test3(Request $request, $search_words = null)
{

  $search_words = 'エマ・ワトソン';
  $search_words = '総需要';

  #categories 上位学問かも。カテゴリーなので含まれるって意味合いがあるから

  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&prop=categories'; #propを変更して
  $url_parameter_search_word = '&pageids=166978';

  $url = $url . $url_parameter . $url_parameter_search_word;

  $wiki = file_get_contents($url, true);

  $wiki = json_decode($wiki,true);

  $count = 1;
  foreach($wiki as $val){
    print_r($count);
    //print_r($val);
    if($count===2){
      foreach($val as $a){
        foreach($a as $b){
          foreach($b['categories'] as $c){
            print_r($c);
          }
        }
      }
    }
    $count++;
  }

  exit;

}






public function test4(Request $request, $search_words = null)
{

  $search_words = 'エマ・ワトソン';
  $search_words = '総需要';

  #https://ja.wikipedia.org/?curid=128948
  $url = 'https://ja.wikipedia.org/w/api.php';
  $url_parameter = '?format=json&action=query&list=search&srlimit=1';
  $url_parameter_search_word = '&srsearch=' . urlencode($search_words);

  $url = $url . $url_parameter . $url_parameter_search_word;

  $wiki = file_get_contents($url, true);

  $wiki = json_decode($wiki,true);

  $count = 1;
  foreach($wiki as $val){
    if($count===3){
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





public function test5(Request $request)
{

  $json = '/uploads/instinct.json';
  $contents = Storage::disk('public')->get($json);

  $json = json_decode($contents,true);
  $json = $json['package']['part'][1]['xmlData']['document']['body']['p'];

  echo '<pre>';
  foreach($json as $key=>$val){

    if( isset($val['pPr']['ind']) and $val['pPr']['ind'] ){
      $left = 0;
      foreach($val['pPr']['ind'] as $l){
        $left = (int)$l;
      }
      $spacenumber = $left/200 - 1;
      for ($i = $spacenumber; $i >= 1; $i--) {
        echo '　';
      }
      if( isset($val['r']['t']) ){
        print_r($val['r']['t']);
      }else{
        foreach($val['r'] as $r){
          if( !is_array($r['t']) ){
            print_r($r['t']);
          }
        }
      }
    }else{
      //print_r($val['r']['t']);
    }
    echo '
';

  }

  exit;

}





}


