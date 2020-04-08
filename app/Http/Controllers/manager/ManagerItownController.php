<?php namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\company;
use App\models\company_code;

use App\models\Contents;
use App\models\Content_tags;

use App\models\Contents_new;
use App\models\Content_new_tags;

use App\models\Itownpage;


use Mail;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Util;
use phpQuery;
use QR_Code\Types\QR_Url;


class ManagerItownController extends Controller {

public function __construct()
{

}




public function getServiceFormBussinessType()
{
  //13898~ コンピュータースクール
  //10480~13897 lovehotel
  //6311~10479 studio
  //377~2627   uranai
  $itowns = DB::table('itownpage')
    ->select('id','address','name','post_code','email')
    ->where('id','>=',377)
    ->where('id','<=',2626)
    ->orderBy('id','asc')
    //->take(10)  
    ->get();

  foreach($itowns as $itown){
    if(strpos($itown->email, 'mailto:')!==false){
      $email = str_replace("mailto:", '', $itown->email);
      DB::table('itownpage')
        ->where('id',$itown->id)
        ->update(['email'=>$email]);
    }
    
  }
  
  echo 'ok';
  exit;


  $types = [];
  
  foreach($itowns as $itown){
    if(strpos($itown->bussiness_type, '、')!==false){
      $types_tmp = explode('、',$itown->bussiness_type);
    }elseif(strpos($itown->bussiness_type, ',')!==false){
      $types_tmp = explode(',',$itown->bussiness_type);
    }elseif(strpos($itown->bussiness_type, '，')!==false){
      $types_tmp = explode('，',$itown->bussiness_type);
    }else{
      $types_tmp = explode(' ',$itown->bussiness_type);
    }
    
    foreach($types_tmp as $type_tmp){
      if(!in_array($type_tmp, $types)){
        if(strpos($type_tmp, '、')!==false){
          $lasts = explode('、',$type_tmp);
          foreach($lasts as $last){
            $last = str_replace("　", '', $last);
            $last = str_replace(" ", '', $last);
            $last = trim($last);
            $types[] = $last;
          }
        }elseif(strpos($type_tmp, ',')!==false){
          $lasts = explode(',',$type_tmp);
          foreach($lasts as $last){
            $last = str_replace("　", '', $last);
            $last = str_replace(" ", '', $last);
            $last = trim($last);
            $types[] = $last;
          }
        }elseif(strpos($type_tmp, '，')!==false){
          $lasts = explode('，',$type_tmp);
          foreach($lasts as $last){
            $last = str_replace("　", '', $last);
            $last = str_replace(" ", '', $last);
            $last = trim($last);
            $types[] = $last;
          }
        }else{
          $type_tmp = str_replace("　", '', $type_tmp);
          $type_tmp = str_replace(" ", '', $type_tmp);
          $type_tmp = trim($type_tmp);
          $types[] = $type_tmp;
        }
        
      }
    }
    
  }

  //事前確認の作成するコンテンツを決定する。
  //sort($types);
  //foreach($types as $type){
  //  if(
  //    strpos($type, '占')!==false or
  //    strpos($type, '命')!==false or
  //    strpos($type, '姓')!==false or
  //    strpos($type, '気学')!==false or
  //    strpos($type, '風水')!==false or
  //    strpos($type, '観相')!==false
  //  ){
  //   //logger($type);
  //  }
  //}

}

/*
[2018-07-19 07:04:32] local.DEBUG: タロット占い  
[2018-07-19 07:04:32] local.DEBUG: 九星気学  
[2018-07-19 07:04:32] local.DEBUG: 四柱推命  
[2018-07-19 07:04:32] local.DEBUG: 姓名判断
[2018-07-19 07:04:32] local.DEBUG: 手相占い  
[2018-07-19 07:04:32] local.DEBUG: 易占い  
[2018-07-19 07:04:32] local.DEBUG: 東洋占い  
[2018-07-19 07:04:32] local.DEBUG: 西洋占い  
[2018-07-19 07:04:32] local.DEBUG: 観相  
[2018-07-19 07:04:32] local.DEBUG: 風水  
*/


public function getAlldataformAddress()
{

  $company_codes = DB::table('company_code')->where('id','<=',30)->get();
  $itowns = DB::table('itownpage')
    ->select('id','address','name','post_code')
    ->where('id','>=',377)
    ->where('id','<=',2626)
    ->orderBy('id','asc')
    //->take(10)
    ->get();

  foreach($itowns as $itown){

    if($itown->post_code){
      continue;
    }

    $itownpage = Itownpage::find($itown->id);
    $moji = $itown->address;
    $moji = str_replace("（", '', $moji);
    $moji = str_replace("）", '', $moji);
    $moji = str_replace("　", '', $moji);
    //logger($moji);
    $start = mb_strpos($moji,'〒')+1;
    $end = $start+7;
    $zip = mb_substr($moji, $start, $end-$start);
    $address = mb_substr($moji, $end+1, mb_strlen($moji));
    
    //logger($zip);
    //logger($address);
    $itownpage->post_code = $zip;
    $itownpage->address = $address;

    if($ad_address = DB::table('ad_address')->where('zip','=',$zip)->first()){
      //logger($ad_address);
    }else{
      //logger('not found ad_address');
      exit;
    }
    
    $itownpage->country_area = $ad_address->ken_id;
    $itownpage->country_area_address_one = $ad_address->city_id;
    $itownpage->country_area_address_two = $ad_address->town_id;
    //$cut_address = $ad_address->ken_name . $ad_address->city_name . $ad_address->town_name;
    //$itownpage->country_area_address_other = str_replace($cut_address, '', $address);
    
    foreach($company_codes as $company_code){
      if(strpos($itown->name, $company_code->name)!==false){
        $name = str_replace($company_code->name, '', $itown->name);
        $name = str_replace("（", '', $name);
        $name = str_replace("）", '', $name);
        $itownpage->name = $name;
        $itownpage->company_code = $company_code->id;
      }
    }

    $itownpage->save();

  }

  echo 'ok';

}





public function getItown()
{
  $itowns = DB::table('itownpage')->orderBy('address','asc')->orderBy('name','asc')->paginate(25);

  return View::make('manager.itown.index', compact('url','itowns'));
}










public function getItownToContents()
{

  //6311~10479 studio
  //377~2627   uranai
  $itowns = DB::table('itownpage')
    ->where('id','>=',377)
    ->where('id','<=',2626)
    ->get();

  foreach($itowns as $itown)
  {

    //if($itown->id===1023600) continue;
    //if($itown->id===1128606) break;
    
    $name = $itown->name;
    if($itown->email){
      $email = $itown->email;
      if(!$user = User::where('email','=',$email)->first()){
        $user = null;
      }
    }else{
      $email = 'email'.uniqid().str_random(8).'@coordiy.com';
      $user = null;
    }
    
    $password = str_random(10);

    //
    //create account logic
    //

    if(!$user){
      $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($password)
      ]);
      $user->verified = 1;
      $user->status = 1;
      $user->owner = 1;
      $user->clump_point = 200;
      $user->csv = 1;
      $user->csv_password = $password;
      $user->save();
    
      //
      //create public_owner logic
      //
      $owner_public = User::create([
          'name' => '[一般オーナー]' . $name,
          'email' => 'public_' . $email,
          'password' => bcrypt($password)
      ]);
      $owner_public->owner = 1;
      $owner_public->owner_super_id = $user->id;
      $owner_public->verified = 1;
      $owner_public->status = 1;
      $owner_public->save();
    }

  
    //
    //create company logic
    //
    //$company = new Company;
    //$company->user_id = $user->id;
    
    // $address[0] === country_area_id
    // $address[1] === country_area_address_one
    // $address[2] === country_area_address_two
    // $address[3] === country_area_address_other
    //$company->grand_country_area_id = 0;
    //$company->name = $name;
    //$company->company_code = 32;
    //$company->company_type_first = 18;
    //$company->company_type_second = 95;
    //$company->country = 392;
    //$company->country_area = $address->ken_id;
    //$company->country_area_address_one = $address->city_id;
    //$company->country_area_address_two = $address->town_id;
    //$company->country_area_address_other = $itown->address;
    //$company->tell = $itown->tell;
    //$company->email = $email;
    //$company->save();

    //$owner_services = new owner_service;
    //$owner_services->user_id = $user->id;
    //$owner_services->$culmen = 1;
    //$owner_services->recruit = 1;
    //$owner_services->save();
  
    //
    // create content logic
    //
    $content = new Contents;
    $content->service = 90;
    $content->user_id = $user->id;
    $content->itownpage_id = $itown->id;
    $content->calendar_flug = 1;
    $content->country_area_id = $itown->country_area;
    $content->country_area_address_one = $itown->country_area_address_one;
    $content->country_area_address_two = $itown->country_area_address_two;
    $content->country_area_address_other = $itown->address;
    $content->admin_open = 1;
    $content->name = $name;
    $content->tell = $itown->tell;
    $content->homepage = $itown->homepage;
    $content->save();

    $content_tag = new Content_tags;
    $content_tag->content_id = $content->id;
    if(strpos($itown->bussiness_type, "タロット占い")!==false) $content_tag->tag1 = 1;
    if(strpos($itown->bussiness_type, "九星気学")!==false) $content_tag->tag2 = 1;
    if(strpos($itown->bussiness_type, "四柱推命")!==false) $content_tag->tag3 = 1;
    if(strpos($itown->bussiness_type, "姓名判断")!==false) $content_tag->tag4 = 1;
    if(strpos($itown->bussiness_type, "手相占い")!==false) $content_tag->tag5 = 1;
    if(strpos($itown->bussiness_type, "易占い")!==false) $content_tag->tag6 = 1;
    if(strpos($itown->bussiness_type, "東洋占い")!==false) $content_tag->tag7 = 1;
    if(strpos($itown->bussiness_type, "西洋占い")!==false) $content_tag->tag8 = 1;
    if(strpos($itown->bussiness_type, "観相")!==false) $content_tag->tag9 = 1;
    if(strpos($itown->bussiness_type, "風水")!==false) $content_tag->tag10 = 1;
    $content_tag->save();

    DB::table('contents_check')->insert(['content_id'=>$content->id]);

  }
  
  echo 'ok';

}



public function postItownDelete(Request $request)
{

  $delete_id = $request->get('id');
  DB::table('itownpage')->where('id',$delete_id)->delete();

  return 1;

}

public function postItownEdit(Request $request)
{

  //logger($request->all());
  $edit_id = $request->get('id');
  DB::table('itownpage')->where('id',$edit_id)->update([
      'type_key'=>$request->get('type_key'),
      'type_value'=>$request->get('type_value'),
      'name'=>$request->get('name'),
      'tell'=>$request->get('tell')
    ]);

  return 1;
  
}





public function getItownCheckTellSpace()
{
  $itowns = DB::table('itownpage')->orderBy('address','asc')->orderBy('name','asc')->get();
  //area
  //type_key
  //type_value
  //name
  //post_code
  //address
  //tell

  foreach($itowns as $itown){

    if(strpos($itown->name, "有限会社")!==false){

      $name = str_replace('有限会社', '', $itown->name);
      DB::table('itownpage')->where('id',$itown->id)->update(['name'=>$name]);

    }

  }

  echo 'ok';

  //return View::make('manager.itown.index', compact('itowns'));
}









public function getItownCheckSame(Request $request)
{

  $itowns = DB::table('itownpage')->orderBy('address','asc')->orderBy('name','asc')->take(40000)->get();
  //area
  //type_key
  //type_value
  //name
  //post_code
  //address
  //tell

  $sameItowns = [];
  $before = null;
  $checkDone = true;
  $before_count_one = true;

  foreach($itowns as $itown){


    //if($itown->id===1131760){
    //  return 'ok';
    //}else{
    //  DB::table('itownpage')->where('id',$itown->id)->delete();
    //}
    //continue;

    //if( strpos($itown->name, "自遊空間")!==false ){
    //  DB::table('itownpage')->where('id',$itown->id)->update(['type_key'=>'sportssisetu']);
    //}
    //continue;

    

    //if($itown->id===799552) $checkDone=false;
    //if($checkDone) continue;

    if($before){


      //住所だけ一緒(チェック対象)
      if( $before->address == $itown->address ){
        if($before_count_one){
          $before_count_one = false;
          $sameItowns[] = $before;
          $sameItowns[] = $itown;
        }else{
          $sameItowns[] = $itown;
        }
      }else{
        $before_count_one = true;
      }

    }

    if(count($sameItowns)>200) break;

    $before = $itown;

  }

  $itowns = $sameItowns;
  
  return View::make('manager.itown.index2', compact('itowns'));

}









public function postImportOwner(Request $request)
{


  //[0] => 門仲はりきゅう整骨院 
  //[1] => 135-0041
  //[2] => ２丁 naniti 4F
  //[3] => 03-3820-1234
  //[4] => tour
  //[5] => https://test40.com
  //[6] => test40@coordiy.ssee

  //logger($request->all());
  
  // CSVファイルをサーバーに保存
  $temporary_csv_file = $request->file('csv')->store('csv');

  //$fp = fopen(storage_path('app/') . $temporary_csv_file, 'r');
  $file = new \SplFileObject(storage_path('app/') . $temporary_csv_file, 'r');
  $file->setFlags(\SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $count = 1;
  $errors = [];

  foreach ($file as $n => $row) {
      if(!$row) break;
      $ans = explode(',',$row);
      
      //logger($ans);

      $name = trim($ans[0]);
      $post_code = $ans[1];
      $address = $ans[2];
      $tell = $ans[3];
      $type = $ans[4];
      $url = $ans[5];
      $email = $ans[6];
      
      DB::table('itownpage')->insert(['type_key'=>$type,'name'=>$name,'post_code'=>$post_code,'address'=>$address,'tell'=>$tell,'url'=>$url,'email'=>$email]);
  }

  echo '
    end
  ';
  echo '
  
  ';
  echo '<a href="/manager/owner/import">インポートページ</a>';
  echo '

  ';
  echo '<a href="/manager/itown">itownページ</a>';
  
  
}














function itownAreaIds(){
  return  [
    'tokyo'=>13,
    'osaka'=>27,
    'aichi'=>23,
    'kanagawa'=>14,
    'hokkaido'=>1,
    'fukuoka'=>40,
    'hyogo'=>28,
    'saitama'=>11,
    'chiba'=>12,
    'shizuoka'=>22,
    'hiroshima'=>34,
    'kyoto'=>26,
    'nagano'=>20,
    'niigata'=>15,
    'ibaraki'=>8,
    'gifu'=>21,
    'miyagi'=>4,
    'fukushima'=>7,
    'gunma'=>10,
    'tochigi'=>9,
    'kumamoto'=>43,
    'kagoshima'=>46,
    'mie'=>24,
    'okinawa'=>47,
    'okayama'=>33,
    'nagasaki'=>42,
    'ehime'=>38,
    'ishikawa'=>17,
    'aomori'=>2,
    'yamaguchi'=>35,
    'oita'=>44,
    'miyazaki'=>45,
    'iwate'=>3,
    'yamagata'=>6,
    'toyama'=>16,
    'kagawa'=>37,
    'akita'=>5,
    'yamanashi'=>19,
    'fukui'=>18,
    'shiga'=>25,
    'wakayama'=>30,
    'kouchi'=>39,
    'saga'=>41,
    'nara'=>29,
    'tokushima'=>36,
    'shimane'=>32,
    'tottori'=>31
  ];
}


function itownAreaNames(){
  return  [
    'tokyo'=>'東京',
    'osaka'=>'大阪',
    'aichi'=>'愛知',
    'kanagawa'=>'神奈川',
    'hokkaido'=>'北海道',
    'fukuoka'=>'福岡',
    'hyogo'=>'兵庫',
    'saitama'=>'埼玉',
    'chiba'=>'千葉',
    'shizuoka'=>'静岡',
    'hiroshima'=>'広島',
    'kyoto'=>'京都',
    'nagano'=>'長野',
    'niigata'=>'新潟',
    'ibaraki'=>'茨城',
    'gifu'=>'岐阜',
    'miyagi'=>'宮城',
    'fukushima'=>'福島',
    'gunma'=>'群馬',
    'tochigi'=>'栃木',
    'kumamoto'=>'熊本',
    'kagoshima'=>'鹿児島',
    'mie'=>'三重',
    'okinawa'=>'沖縄',
    'okayama'=>'岡山',
    'nagasaki'=>'長崎',
    'ehime'=>'愛媛',
    'ishikawa'=>'石川',
    'aomori'=>'青森',
    'yamaguchi'=>'山口',
    'oita'=>'大分',
    'miyazaki'=>'宮崎',
    'iwate'=>'岩手',
    'yamagata'=>'山形',
    'toyama'=>'富山',
    'kagawa'=>'香川',
    'akita'=>'秋田',
    'yamanashi'=>'山梨',
    'fukui'=>'福井',
    'shiga'=>'滋賀',
    'wakayama'=>'和歌山',
    'kouchi'=>'高知',
    'saga'=>'佐賀',
    'nara'=>'奈良',
    'tokushima'=>'徳島',
    'shimane'=>'島根',
    'tottori'=>'鳥取'
  ];
}




function itownJanleNames(){
  return  [
    'house' => '住まい',
    'bussiness' => 'ビジネス',
    'life' => '暮らし',
    'gourmet' => 'グルメ・飲食',
    'shopping' => 'ショッピング',
    'health' => '健康・介護',
    'beauty' => '美容・ファッション',
    'public' => '公共機関・団体',
    'motor' => '自動車・バイク',
    'lesson' => '教育・習い事',
    'medical' => '病院・医院',
    'hobby' => '趣味',
    'ceremony' => '冠婚葬祭・イベント',
    'travel' => '旅行・宿泊',
    'leisure' => 'レジャー・スポーツ',
    'dentistry' => '歯科',
    'pet' => 'ペット'
  ];
}





function typeServiceId(){
  return [
    'gourmet'=>1,
    'beautysalon'=>8,
    '1027'=>8,
    '1022'=>5,
    '1024'=>5,
    '1055'=>5,
    '1054'=>5,
    '3225'=>5,
    '1047'=>5,
    '171'=>4,
    'musicschool'=>4,
    'language'=>4,
    'sports'=>4,
    '168'=>4,
    '4331'=>4,
    'childschool'=>4,
    'syodou_soroban'=>4,
    'budou'=>4,
    'ikebana_sadou'=>4,
    'marinesports'=>4,
    'dance'=>4,
    'uranai'=>4,
    'fitness'=>2,
    'sportssisetu'=>2,
    'zoo_aquarium'=>2,
    'outdoorrecreation'=>2,
    '5785'=>2,
    '1751'=>2,
    '1755'=>2,
    'museum'=>7,
    '5613'=>2,
    '5655'=>2,
    '5603'=>2,
    '5624'=>2,
    'hotel_pension'=>9,
    'kankou_onsen_sentou'=>9,
    'ryokan_minsyuku'=>9,
    'lovehotel'=>9,
    '613'=>2,
    '57'=>9,
    'bokujo'=>2,
    'food'=>1,
    'active'=>2,
    'experience'=>3,
    'lesson'=>4,
    'spasalon'=>5,
    'tour'=>6,
    'ticket'=>7,
    'hairsalon'=>8,
    'stay'=>9,
    'studio'=>10,
    'kaigi'=>11,
    'hotel'=>12,
    'recruit'=>13,
    'divination'=>14
  ];
}







}
