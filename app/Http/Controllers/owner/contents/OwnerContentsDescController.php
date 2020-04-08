<?php namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use App\models\Place;
use App\models\Contents;
use App\models\Content_recruit_type;
 


use App\models\company;
use App\models\Company_calendar;
use App\models\Country_area;
use App\models\Recommends;
use App\models\owner_service;
use App\models\Owner_request;

use App\models\Content_step_food;
use App\models\Content_step_active;
use App\models\Content_step_experience;
use App\models\Content_step_lesson;
use App\models\Content_step_spasalon;
use App\models\Content_step_tour;
use App\models\Content_step_ticket;
use App\models\Content_step_hairsalon;
use App\models\Content_step_stay;
use App\models\Content_step_studio;
use App\models\Content_step_kaigi;
use App\models\Content_step_recruit;
use App\models\Content_step_hotel;
use App\models\Content_step_divination;


use Redirect;
use Auth;
use View;
use DB;
use Util;
use UtilYoyaku;
use Utilowner;

class OwnerContentsDescController extends Controller {

public function __construct()
{

}




//stepValidation
function stepValidation($request, $content_id){

  $content = Contents::select('service')->find($content_id);

  if(!$request->get('title')) return ['err'=>1, 'message'=>'グッドポイントタイトルを登録してください。'];
  if( mb_strlen($request->get('title')) > 40) return ['err'=>1, 'message'=> 'グッドポイントタイトルは40文字以内で入力ください。']; 

  if(!$request->get('description')) return ['err'=>1, 'message'=>'グッドポイント詳細を登録してください。'];
  if( mb_strlen($request->get('description')) > 300) return ['err'=>1, 'message'=> 'グッドポイント詳細は300文字以内で入力ください。']; 

  $count = Util::getContentStep($content_id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, true, null);
  if($count>10) return ['err'=>1, 'message'=>'グッドポイントは10ステップまでです。'];
  $pic = $request->file('pic');
  if($pic){
    $pic_size = filesize($pic);
    if( !$pic_size ) return ['err'=>1, 'message'=>'このイメージは対応してません。'];
    if( $pic_size<1000 ) return ['err'=>1, 'message'=>'もっと大きな写真をアップしてください。'];
    if( $pic_size>20971520 ) return ['err'=>1, 'message'=>'20MByte以下の写真をアップしてください。'];
  }
  return ['err'=>0];
}





public function postStepNew(Request $request, $id)
{  
  
  $content = Contents::select('id','service')->find($id);
  $ans = $this->stepValidation($request, $id);
  if($ans['err']){ return $ans; }

  switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)) {
    case 'food': $step = new Content_step_food; break;
    case 'active': $step = new Content_step_active; break;
    case 'experience': $step = new Content_step_experience; break;
    case 'lesson': $step = new Content_step_lesson; break;
    case 'spasalon': $step = new Content_step_spasalon; break;
    case 'tour': $step = new Content_step_tour; break;
    case 'ticket': $step = new Content_step_ticket; break;
    case 'hairsalon': $step = new Content_step_hairsalon; break;
    case 'stay': $step = new Content_step_stay; break;
    case 'studio': $step = new Content_step_studio; break;
    case 'kaigi': $step = new Content_step_kaigi; break;
    case 'hotel': $step = new Content_step_hotel; break;
    case 'recruit': $step = new Content_step_recruit; break;
    case 'divination': $step = new Content_step_divination; break;
  }

  $step->content_id = $content->id;
  $step->title = $request->get('title');
  $step->description = $request->get('description');
  $step->save();

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/step/' . $step->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $step->pic = Util::formFileToImage($pic, $pic_path, null, $pic_name, $pic_type );  
  }
  $step->save();

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  
  $element_number = 1;
  foreach($steps as $s){
    //$edit_step = Content_menu_step_lesson::find($s->id);
    $edit_step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $s->id);
    $edit_step->element_number = $element_number;
    $element_number++;
    $edit_step->save();
  }

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  return $steps;

}



public function postStepEdit(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  $ans = $this->stepValidation($request, $id);
  if($ans['err']){ return $ans; }

  $step_id = (int)$request->get('step_id');
  if(!$request->get('step_id')) return ['err'=>1, 'message'=>'画面を読み込み直してもう一度お試しください。'];

  $step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $step_id);
  $step->title = $request->get('title');
  $step->description = $request->get('description');

  $pic = $request->file('pic');
  if($pic){
    $pic_path = '/uploads/contents/' . $id . '/step/' . $step->id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $pic->extension();
    $step->pic = Util::formFileToImage($pic, $pic_path, $step->pic, $pic_name, $pic_type );  
  }
  $step->save();

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  $element_number = 1;
  foreach($steps as $s){
    $edit_step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $s->id);
    $edit_step->element_number = $element_number;
    $element_number++;
    $edit_step->save();
  }

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  return $steps;

}

public function deleteStep(Request $request, $id)
{

  $content = Contents::select('id','service')->find($id);
  if(!$step = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, $request->get('step_id'))) return ['err'=>1,'message'=>'ステップが見つかりません。'];
  
  Util::deleteImage('/uploads/contents/' . $content->id . '/step/' . $step->id . '/', $step->pic);
  $step->delete();

  $steps = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);

  return $steps;

}















public function descExample(Request $request, $id)
{

  $content = Contents::select('id','service','name')->find($id);
  switch (UtilYoyaku::getNewMenuSenMonTenSummary($content->service)){
    case 'food':  return $content->name . 'は、
イタリアで4年、フランスで７年修行を積んだ〇〇料理長が監修する創業〇〇年目のフレンチレストランです。

常に更新され続けているすべての創作料理は、姿、におい、味、すべての感覚へ最適な刺激を与えます。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'active':  return $content->name . 'は、
子供から大人まで楽しめる大型アトラクションセンターです。

常に最新化を続けてけるすべてのアトラクションは、日ごろの疲れを完全に忘れて、心から笑える時間を提供します。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'exprience':  return $content->name . 'は、
' . UtilYoyaku::getNewMenuSenMonTen($content->service) . '体験ができるサービスです。

常に最新化を続けてける' . UtilYoyaku::getNewMenuSenMonTen($content->service) . '体験は、ステキな時間を提供します。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'lesson':  return $content->name . 'は、
子供から大人まで学べるジャンルと、内容の濃いカリキュラムがそろっている学びセンターです。

常に最新化を続けてけるレッスンは、スキルアップを達成させ、自信を生み出します。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'spasalon':  return $content->name . 'は、
美容に関するすべてのサービスが受けられる大型スパセンターです。

岩盤風呂、泥風呂、ヨモギ蒸しや、女性スタッフが行うマッサージまで、疲れを癒す最適な空間です。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'tour':  return $content->name . 'は、
その季節ごとに最適な国内ツアーを開催することを大切にしている創業３０年のツアークリエイターです。

各エリアは各季節によってさまざまな顔を見せてくれます。その魅力的な顔にスポットを当ててツアーを開催しています。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'ticket':  return $content->name . 'は、
その時代にもっとも魅力的なコトやモノにスポットを当ててイベントを開催する創業３０年のイベント運営会社です。

運営イベントの種類は、音楽ライブ、展示会などが一般的です。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円チケットのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'hairsalon':  return $content->name . 'は、
その時代にもっとも魅力的なヘアースタイルを生み出し続けてきた創業３０年の美容室グループです。

当グループの魅了は価格設定にもあります。スモールカットは１０００円からご利用いただけます。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円チケットのキャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'stay':  return $content->name . 'は、
和風創作料理と自然をテーマにお客様の満足を追求し続けてきた創業３０年の旅館グループです。

当グループの魅了は料理と自然だけではありません。価格設定にもあります。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円キャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
    '; break;
    case 'studio': return $content->name . 'は、
ちょっとした撮影、収録から、数日のロケを要する撮影にもご利用いただけるレンタル撮影、収録スタジオです。

常に最新化を続けてけるすべてのスタジオは、新しいクリエイティブを生み出す最適な空間です。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことをここを待ちにしております。
    '; break;
    case 'kaigi': return $content->name . 'は、
ちょっとした打ち合わせや面接から、セキュアなネット回線を利用した電話会議などまでご利用いただけるレンタル会議室です。

常に最新化を続けてけるすべての会議室は、新しいクリエイティブを生み出す最適な空間です。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円コースのキャンペーンを行っております。

是非、この機会にお越しいただけことをここを待ちにしております。
    '; break;
    case 'recruit': return $content->name . 'のサービス拡大に伴い「〇〇」の運営メンバーを募集します。

■営業メンバー
オーナー様をサポートいただきます。
予約受付登録、コンテンツ制作などオーナー様との折衝をするお仕事です。
社会に貢献できるやりがいのあるお仕事です。
最初は先輩が隣で丁寧にサポートいたします。

■開発メンバー
「〇〇」の機能追加、機能改善を行うお仕事です。
C言語の知識が必要です。
社会に貢献できるやりがいのあるお仕事です。
最初は先輩が隣で丁寧にサポートいたします。

■サービス概要
「〇〇」はで多くのお客様にご利用いただいている業界トップクラスのサービスです。
更にお客様に便利になっていただくために常に進化を続けています。

■エントリーを検討いただいている皆様へ
是非、新しい社会を一緒に作って行きましょう。
    '; break;
    case 'divination': return $content->name . 'は、
占いを通して、人の心を、不安、不穏、動揺、混乱、激動から開放し、正しい道へ導くことが目的です。

占いの結果はすばらしいライフワークへの一歩となります。

只今、初めてのお客様には、お気軽に足を運んでいただけるように、お試し３０００円キャンペーンを行っております。

是非、この機会にお越しいただけことを心待ちにしております。
        '; break;
    default: return null;
  }

}





public function getDesc(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  $content['steps'] = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);
  return View('owner.contents.desc.desc', compact('content','company'));

}


public function getDescEdit(Request $request, $id)
{

  $company = company::where('user_id',Utilowner::getOwnerId())->first();
  $content = Contents::find($id);
  $content['steps'] = Util::getContentStep($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null);

  if( $content->service===39 or $content->service===85 or $content->service===89 ){
    if(!Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null)){
      $to = '/owner/contents/' . $content->id . '/capacity/edit';
      return redirect($to)->with('warning', '先に「' . UtilYoyaku::getNewContentCapacity($content->service) . '」を登録してください。');
    }
  }else{
    $to = '/owner/contents/' . $content->id . '/menu/edit';
    if(!Util::getContentMenu($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), true, null, null, null)){
      return redirect($to)->with('warning', '先に「メニュー」を登録してください。');
    }  
  }

  if($content->service===15){
    $capacity_total = $this->getTotalCapacity($content);
  }else{
    $capacity_total = null;
  }

  return View('owner.contents.desc.descEdit', compact('content','company','capacity_total'));

}



public function postDescEdit(Request $request, $id)
{

  $this->validate($request, [
    'name'   => 'required|min:1|max:255',
    'description'  => 'max:20000',
    'homepage'     => 'max:255',
    'price_kids'   => 'min:1|max:200',
    'price_yoji'   => 'min:1|max:200',
    'price_baby'   => 'min:1|max:200',
    'last_time_order' => 'required',
    'last_time_yoyaku' => 'required',
  ]);

  $tell = null;
  if($request->get('tell')){
    $tell = $request->get('tell');
    $tell = str_replace('-','',$tell);
    if( !ctype_digit($tell) ) return back()->with('warning', '電話番号は半角の数字とハイフンのみ有効です。')->withInput();
    if( !(strlen($tell)>=10 and strlen($tell)<=11) ) return back()->with('warning', '電話番号は10-11桁で登録してください。')->withInput();  
  }

  $ans = ['err'=>0, 'message'=>''];
  $content = Contents::find($id);
  $content->name = $request->get('name');

  if($content->service===15){ //貸切判定
    $content->allUseNumber = ($request->get('allUseNumber')) ? (int)$request->get('allUseNumber') : null;
    if($content->allUseNumber){
      $capacity_total = $this->getTotalCapacity($content);
      //logger('capacity_total: ' . $capacity_total);
      if($content->allUseNumber > $capacity_total){
        $ans['err'] = 1;
        $ans['message'] = '設備許容人数以上は登録できません';
        return back()->with('warning', $ans['message'])->withInput();
      }
    }
  }

  if($content->service===91){ //recruit
    if( !$request->get('salary_type') ) return back()->with('warning', '給与形態を選択してください。')->withInput();
    if( !$request->get('salary_min') ) return back()->with('warning', '最低給与を入力してください。')->withInput();
    if( !$request->get('salary_max') ) return back()->with('warning', '最高給与を入力してください。')->withInput();

    $content->salary_type = (int)$request->get('salary_type');
    $content->salary_min = (int)$request->get('salary_min');
    $content->salary_max = (int)$request->get('salary_max');
  }

  $content->last_time_order = $request->get('last_time_order');
  $minitus = Util::ToMin($content->last_time_order . ':00');
  if($minitus<60){
    $ans['err'] = 1;
    $ans['message'] = '最終受付時間は1時間以上必要です';
    return back()->with('warning', $ans['message'])->withInput();
  }
  $content->last_time_yoyaku = $request->get('last_time_yoyaku');

  //startstay9 only
  //kids
  $content->kids = ($request->has('kids')) ? 1 : 0;
  $content->price_kids = ($request->has('price_kids')) ? $request->get('price_kids') : 100;
  //yoji
  $content->yoji = ($request->has('yoji')) ? 1 : 0;
  $content->price_yoji = ($request->has('price_yoji')) ? $request->get('price_yoji') : 100;
  //baby
  $content->baby = ($request->has('baby')) ? 1 : 0;
  $content->price_baby = ($request->has('price_baby')) ? $request->get('price_baby') : 100;
  //end stay9 only 

  $content->homepage = $request->get('homepage');
  $content->description = $request->get('description');
  
  $mainPic = $request->file('mainPic');
  if($mainPic){
    $pic_size = filesize($mainPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/contents/' . $id . '/';
    $pic_type = 'pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $mainPic->extension();
    $content->pic = Util::formFileToImage($mainPic, $pic_path, $content->pic, $pic_name, $pic_type );  
  }

  $backPic = $request->file('backPic');
  if($backPic){
    $pic_size = filesize($backPic);
    if( !$pic_size ) return back()->with('warning', 'このイメージは対応してません。')->withInput();
    if( $pic_size<1000 ) return back()->with('warning', 'もっと大きな写真をアップしてください。')->withInput();
    if( $pic_size>20971520 ) return back()->with('warning', '20MByte以下の写真をアップしてください。')->withInput();
    $pic_path = '/uploads/contents/' . $id . '/';
    $pic_type = 'back_pic';
    $pic_name = 'coordiy_' . uniqid() . '.' . $backPic->extension();
    $content->back_pic = Util::formFileToImage($backPic, $pic_path, $content->back_pic, $pic_name, $pic_type );  
  }

  $content->tell = $tell;
  $content->admin_open = 1;

  $content->save();
  
  if($content->service===91){
    return redirect('/owner/contents/' . $content->id . '/date/edit')->with('success', '編集しました。');
  }else{
    return redirect('/owner/contents/' . $content->id . '/cancel/edit')->with('success', '編集しました。');
  }

}







function getTotalCapacity($content){
  $total = 0;
  $capacities = Util::getContentCapacityDesc($content->id, UtilYoyaku::getNewMenuSenMonTenSummary($content->service), null, null, null, null);
  foreach($capacities as $capacity){
    if($capacity->delete_flug) continue;
    $total += $capacity->number * $capacity->person;
  }
  return $total;
}












}