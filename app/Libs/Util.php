<?php namespace App\Libs;

use App\models\Country;
use App\models\Country_area;
use App\models\Contents;
use App\models\Content_date;

use App\models\Content_capacity_food;
use App\models\Content_capacity_active;
use App\models\Content_capacity_experience;
use App\models\Content_capacity_tour;
use App\models\Content_capacity_stay;
use App\models\Content_capacity_ticket;
use App\models\Content_capacity_studio;
use App\models\Content_capacity_kaigi;
use App\models\Content_capacity_hairsalon;
use App\models\Content_capacity_spasalon;
use App\models\Content_capacity_lesson;
use App\models\Content_capacity_hotel;
use App\models\Content_capacity_recruit;
use App\models\Content_capacity_divination;

use App\models\Content_menu_food;
use App\models\Content_menu_active;
use App\models\Content_menu_experience;
use App\models\Content_menu_tour;
use App\models\Content_menu_stay;
use App\models\Content_menu_ticket;
use App\models\Content_menu_studio;
use App\models\Content_menu_kaigi;
use App\models\Content_menu_hairsalon;
use App\models\Content_menu_spasalon;
use App\models\Content_menu_lesson;
use App\models\Content_menu_hotel;
use App\models\Content_menu_recruit;
use App\models\Content_menu_divination;

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
use App\models\Content_step_divination;

use App\models\Content_menu_step_lesson;
use App\models\Content_menu_step_tour;
use App\models\Content_menu_step_ticket;

use App\models\Favorite;

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

use App\models\Recommends;
use App\models\Recommends_pics;

use DB;
use Storage;
use Image;
use DateTime;
use Auth;





class Util {



  public static function putTitleUrlToRecommends($recommends)
  {
    foreach($recommends as $key=>$val){
      if($val->table_name == 'learning')
      {
        $learning = Learning::select('title','url')->where('id',$val->table_id)->first();
        $recommends[$key]['title'] = $learning->name;
        $recommends[$key]['url'] = $learning->url;
      }
      elseif($val->table_name == 'license_question')
      {
        $license_question = License_question::select(
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
        $recommends[$key]['title'] = $license_question->subject_name . ' 第'.$license_question->number.'問 ('.$license_question->license_year.')';
        $recommends[$key]['url'] = '/license/'.$license_question->license_id.'/question/'.$license_question->id;
      }
    }
    return $recommends;
  }




  public static function getRequestExists($key)
  {
    return (isset($_GET[$key])) ? $_GET[$key] : null;
  }


/*
1=>'ダーツ', 1申し込み=1台 メニュー: 利用時間
2=>'卓球', 1申し込み=1台 メニュー: 利用時間
3=>'テニス',1申し込み=1コート メニュー: 利用時間
4=>'‎ビリヤード 1申し込み=1台 メニュー: 利用時間
5=>'ボルダリング 1申し込み=枠確保 メニュー: 利用時間
‎6=>'ジム 1申し込み=枠確保 メニュー: 利用時間
‎7=>'プール 1申し込み=枠確保 メニュー: 利用時間
‎9=>'その他アクティブ 1申し込み=枠 メニュー: 利用時間
*/


  
public static function getPhotoCredit()
{

  $photos = [
    1=>['src'=>'/storage/global/img/credit/coordiy_5ac0413bf0541_250.jpeg', 'title'=>'パーマ,Perm', 'credit'=>'Markus Spiske freeforcommercialuse.net', 'url'=>'https://www.pexels.com/photo/hair-dryer-hair-style-hairstyle-hair-112782/'],
    2=>['src'=>'/storage/global/img/credit/coordiy_5ac0411c5b731_250.jpeg', 'title'=>'hair,カラーリング', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/woman-with-brown-hair-with-black-top-with-gray-background-159780/'],
    3=>['src'=>'/storage/global/img/credit/coordiy_5ac045c91f8ea_250.jpeg', 'title'=>'hair,cut, ヘアーカット', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/fashion-woman-model-style-52499/'],
    4=>['src'=>'/storage/global/img/credit/coordiy_5ac04122cd8db_250.jpeg', 'title'=>'Hair Accessories, ヘアーアクセサリ', 'credit'=>'Kaboompics .com', 'url'=>'https://www.pexels.com/photo/bride-s-hair-styled-with-a-hair-ornament-6171/'],
    5=>['src'=>'/storage/global/img/credit/coordiy_5ac045a73ed28_250.jpeg', 'title'=>'hair modal, ヘアーモデル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/attractive-beautiful-beautiful-girl-beauty-458766/'],
    7=>['src'=>'/storage/global/img/credit/coordiy_5ac045ab06f78_250.jpeg', 'title'=>'hair modal, ヘアーモデル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/portrait-of-young-woman-247287/'],
    9=>['src'=>'/storage/global/img/credit/coordiy_5ac0461cf3f5c_250.jpeg', 'title'=>'hair shop, 美容院', 'credit'=>'Delbeautybox', 'url'=>'https://www.pexels.com/photo/white-and-brown-chairs-inside-a-salon-705255/'],
    10=>['src'=>'/storage/global/img/credit/coordiy_5ac04607b4acc_250.jpeg', 'title'=>'hair shop, 美容院', 'credit'=>'Delbeautybox', 'url'=>'https://www.pexels.com/photo/black-salon-chairs-853427/'],
    12=>['src'=>'/storage/global/img/credit/coordiy_5ac047d236439_250.jpeg', 'title'=>'hotel room, ホテルルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-bed-bedroom-chair-271624/'],
    14=>['src'=>'/storage/global/img/credit/coordiy_5ac0485c22d71_250.jpeg', 'title'=>'photo studio, フォトスタジオ', 'credit'=>'Alexander Dummer', 'url'=>'https://www.pexels.com/photo/photo-studio-with-white-wooden-framed-wall-mirror-134469/'],
    18=>['src'=>'/storage/global/img/credit/coordiy_5ac07b6e053bf_250.jpeg', 'title'=>'makeup, メイクグッツ', 'credit'=>'freestocks.org', 'url'=>'https://www.pexels.com/photo/beautiful-birthday-blur-bouquet-318379/'],
    22=>['src'=>'/storage/global/img/credit/coordiy_5ac07d913e6fb_250.jpeg', 'title'=>'exercise, エクササイズ', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/three-women-s-doing-exercises-863977/'],
    24=>['src'=>'/storage/global/img/credit/coordiy_5ac03d2e8f0f4_250.jpeg', 'title'=>'golf, ゴルフ', 'credit'=>'Fancycrave', 'url'=>'https://www.pexels.com/photo/active-activity-adults-athlete-424725/'],
    26=>['src'=>'/storage/global/img/credit/coordiy_5ac043b0d992a_250.jpeg', 'title'=>'archery, アーチェリー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/archery-beautiful-beauty-bow-413971/'],
    27=>['src'=>'/storage/global/img/credit/coordiy_5ac03d4ae564a_250.jpeg', 'title'=>'tennis, テニス', 'credit'=>'Tookapic', 'url'=>'https://www.pexels.com/photo/ball-tennis-court-racket-7753/'],
    28=>['src'=>'/storage/global/img/credit/coordiy_5ac07e8c897a9_250.jpeg', 'title'=>'Badminton, バトミントン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blue-badminton-racket-with-shuttlecock-115016/'],
    29=>['src'=>'/storage/global/img/credit/coordiy_5ac07eb4e0f4e_250.jpeg', 'title'=>'bassboal, 野球', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/green-ball-on-sand-257970/'],
    30=>['src'=>'/storage/global/img/credit/coordiy_5ac042a6bfc10_250.jpeg', 'title'=>'Bouldering, ボルダリング', 'credit'=>'Skitterphoto', 'url'=>'https://www.pexels.com/photo/sport-muscles-climbing-climber-9606/'],
    31=>['src'=>'/storage/global/img/credit/coordiy_5ac042c5ab6f0_250.jpeg', 'title'=>'swiming, スイミング', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/action-exercise-fun-goggles-260598/'],
    33=>['src'=>'/storage/global/img/credit/coordiy_5ac03d2374c81_250.jpeg', 'title'=>'table tennis, 卓球', 'credit'=>'Sascha Düser', 'url'=>'https://www.pexels.com/photo/white-pingpong-ball-beneath-red-table-tennis-paddle-187329/'],
    34=>['src'=>'/storage/global/img/credit/coordiy_5ac043a7d25dd_250.jpeg', 'title'=>'Maternity Yoga, マタニティーヨガ', 'credit'=>'freestocks.org', 'url'=>'https://www.pexels.com/photo/abdomen-active-activity-belly-button-396133/'],
    36=>['src'=>'/storage/global/img/credit/coordiy_5ac043b530ee8_250.jpeg', 'title'=>'Athletic, アスレチック', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/boy-carabiners-child-climber-434400/'],
    37=>['src'=>'/storage/global/img/credit/coordiy_5ac03d27d873d_250.jpeg', 'title'=>'Skiing, スキー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/flatlay-of-skiing-equipment-257961/'],
    38=>['src'=>'/storage/global/img/credit/coordiy_5ac042d0b4608_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/athlete-athletic-baseball-boy-264337/'],
    39=>['src'=>'/storage/global/img/credit/coordiy_5ac0429f9376d_250.jpeg', 'title'=>'Canoe, カヌー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/smiling-man-in-white-crew-neck-t-shirt-wearing-sunglasses-paddling-on-yellow-kayak-during-daytime-40859/'],
    40=>['src'=>'/storage/global/img/credit/coordiy_5ac043f55d0a5_250.jpeg', 'title'=>'snowboad, スノーボード', 'credit'=>'Visit Almaty', 'url'=>'https://www.pexels.com/photo/person-in-grey-hoodie-sitting-on-snowboard-848681/'],
    43=>['src'=>'/storage/global/img/credit/coordiy_5ac03d4078d95_250.jpeg', 'title'=>'darts, ダーツ', 'credit'=>'Marc', 'url'=>'https://www.pexels.com/photo/green-and-yellow-darts-on-brown-black-green-and-red-dartboard-695266/'],
    45=>['src'=>'/storage/global/img/credit/coordiy_5ac044022e96a_250.jpeg', 'title'=>'exercise, エクササイズ', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/woman-wearing-white-and-black-sweat-suit-doing-curl-ups-864091/'],
    46=>['src'=>'/storage/global/img/credit/coordiy_5ac03d39c23de_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Krivec Ales', 'url'=>'https://www.pexels.com/photo/active-activity-adventure-backpack-547116/'],
    47=>['src'=>'/storage/global/img/credit/coordiy_5ac0833a4c915_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/active-activity-adventure-backpack-541520/'],
    48=>['src'=>'/storage/global/img/credit/coordiy_5ac03d2ccd891_250.jpeg', 'title'=>'billiards, ビリヤード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/bar-billiards-gambling-game-261043/'],
    49=>['src'=>'/storage/global/img/credit/coordiy_5ac0839f9e0f9_250.jpeg', 'title'=>'billiard boad in hotel root, ビリヤード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-architecture-beautiful-billiard-table-261426/'],
    50=>['src'=>'/storage/global/img/credit/coordiy_5ac041ba34599_250.jpeg', 'title'=>'office, オフィス', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/business-chairs-company-coworking-7070/'],
    51=>['src'=>'/storage/global/img/credit/coordiy_5ac03d7187f8d_250.jpeg', 'title'=>'meeting, ミーティング', 'credit'=>'Startup Stock Photos', 'url'=>'https://www.pexels.com/photo/people-meeting-workspace-team-7097/'],
    52=>['src'=>'/storage/global/img/credit/coordiy_5ac041870d8cb_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/black-and-white-board-boardroom-business-260689/'],
    55=>['src'=>'/storage/global/img/credit/coordiy_5ac0856290d39_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/person-curving-wood-167708/'],
    58=>['src'=>'/storage/global/img/credit/coordiy_5ac03fe8c174f_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/five-white-plates-with-different-kinds-of-dishes-54455/'],
    59=>['src'=>'/storage/global/img/credit/coordiy_5ac086010204e_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/burrito-chicken-delicious-dinner-461198/'],
    62=>['src'=>'/storage/global/img/credit/coordiy_5ac0865d2443c_250.jpeg', 'title'=>'food, フード', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/spinach-chicken-pomegranate-salad-5938/'],
    63=>['src'=>'/storage/global/img/credit/coordiy_5ac086990368c_250.jpeg', 'title'=>'food, フード', 'credit'=>'Ash', 'url'=>'https://www.pexels.com/photo/blur-breakfast-close-up-dairy-product-376464/'],
    64=>['src'=>'/storage/global/img/credit/coordiy_5ac04018426f2_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/anise-aroma-art-bazaar-277253/'],
    65=>['src'=>'/storage/global/img/credit/coordiy_5ac08737c834f_250.jpeg', 'title'=>'food, フード', 'credit'=>'Robin Stickel', 'url'=>'https://www.pexels.com/photo/food-dinner-lunch-unhealthy-70497/'],
    66=>['src'=>'/storage/global/img/credit/coordiy_5ac087602570a_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-of-food-247685/'],
    68=>['src'=>'/storage/global/img/credit/coordiy_5ac087987bad2_250.jpeg', 'title'=>'food, フード', 'credit'=>'Foodie Factor', 'url'=>'https://www.pexels.com/photo/appetizer-avocado-bread-breakfast-566566/'],
    69=>['src'=>'/storage/global/img/credit/coordiy_5ac03e4375fb1_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/abundance-agriculture-bananas-batch-264537/'],
    70=>['src'=>'/storage/global/img/credit/coordiy_5ac088bf291ef_250.jpeg', 'title'=>'food, フード', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/lunch-table-salad-5876/'],
    71=>['src'=>'/storage/global/img/credit/coordiy_5ac088fc245b7_250.jpeg', 'title'=>'food, フード', 'credit'=>'Malidate Van', 'url'=>'https://www.pexels.com/photo/steak-food-769289/'],
    74=>['src'=>'/storage/global/img/credit/coordiy_5ac089467058a_250.jpeg', 'title'=>'food, フード', 'credit'=>'Terje Sollie', 'url'=>'https://www.pexels.com/photo/beef-cuisine-delicious-dinner-299347/'],
    75=>['src'=>'/storage/global/img/credit/coordiy_5ac0400a6fe54_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/dessert-donuts-doughnuts-food-273773/'],
    77=>['src'=>'/storage/global/img/credit/coordiy_5ac089d17c4c3_250.jpeg', 'title'=>'food, フード', 'credit'=>'Snapwire', 'url'=>'https://www.pexels.com/photo/selective-focus-photography-of-beef-steak-with-sauce-675951/'],
    79=>['src'=>'/storage/global/img/credit/coordiy_5ac03e2b9cf45_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/food-vegetables-summer-eat-111131/'],
    81=>['src'=>'/storage/global/img/credit/coordiy_5ac03e2ac6ef6_250.jpeg', 'title'=>'food, フード', 'credit'=>'Tookapic', 'url'=>'https://www.pexels.com/photo/food-dinner-lemon-rice-8758/'],
    83=>['src'=>'/storage/global/img/credit/coordiy_5ac03e34bf430_250.jpeg', 'title'=>'food, フード', 'credit'=>'Igor Ovsyannykov', 'url'=>'https://www.pexels.com/photo/donuts-and-bagel-display-205961/'],
    86=>['src'=>'/storage/global/img/credit/coordiy_5ac08b18c1fc7_250.jpeg', 'title'=>'food, フード', 'credit'=>'Tookapic', 'url'=>'https://www.pexels.com/photo/food-mozzarella-tomatoes-tomato-7765/'],
    88=>['src'=>'/storage/global/img/credit/coordiy_5ac0401d24791_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/asia-carrot-chopsticks-delicious-357756/'],
    91=>['src'=>'/storage/global/img/credit/coordiy_5ac08c2ff1960_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-of-salad-in-plate-257816/'],
    92=>['src'=>'/storage/global/img/credit/coordiy_5ac08c637f8f4_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-photo-of-sushi-served-on-table-248444/'],
    94=>['src'=>'/storage/global/img/credit/coordiy_5ac08cb060681_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/barbecue-bbq-beef-charcoal-533325/'],
    96=>['src'=>'/storage/global/img/credit/coordiy_5ac08ce5c9669_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-cream-creamy-dairy-357586/'],
    97=>['src'=>'/storage/global/img/credit/coordiy_5ac04ba33ac3a_250.jpeg', 'title'=>'Nature, 自然', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/agriculture-asia-cat-china-235648/'],
    98=>['src'=>'/storage/global/img/credit/coordiy_5ac0472f59966_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/barbecue-bbq-beef-brown-236887/'],
    99=>['src'=>'/storage/global/img/credit/coordiy_5ac08d557217a_250.jpeg', 'title'=>'food, フード', 'credit'=>'Quang Anh Ha Nguyen', 'url'=>'https://www.pexels.com/photo/white-scoop-on-white-ceramic-bowl-884600/'],
    100=>['src'=>'/storage/global/img/credit/coordiy_5ac0471acd830_250.jpeg', 'title'=>'food, フード', 'credit'=>'Thuy Nguyen', 'url'=>'https://www.pexels.com/photo/cooked-seafoods-699953/'],
    103=>['src'=>'/storage/global/img/credit/coordiy_5ac08dc324c44_250.jpeg', 'title'=>'food, フード', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-of-meal-served-in-bowl-257818/'],
    104=>['src'=>'/storage/global/img/credit/coordiy_5ac08de5aeb35_250.jpeg', 'title'=>'food, フード', 'credit'=>'Dana Tentis', 'url'=>'https://www.pexels.com/photo/cooked-shrimp-with-noodles-725997/'],
    108=>['src'=>'/storage/global/img/credit/coordiy_5ac08e45989a3_250.jpeg', 'title'=>'food, フード', 'credit'=>'Trang Doan', 'url'=>'https://www.pexels.com/photo/bowl-filled-with-noodles-and-hard-boiled-egg-793750/'],
    109=>['src'=>'/storage/global/img/credit/coordiy_5ac0414ce555b_250.jpeg', 'title'=>'hair modal, ヘアーモデル', 'credit'=>'Karyme França', 'url'=>'https://www.pexels.com/photo/close-up-photography-of-a-woman-holding-her-hair-839347/'],
    110=>['src'=>'/storage/global/img/credit/coordiy_5ac0414e80c56_250.jpeg', 'title'=>'hair modal, ヘアーモデル', 'credit'=>'Karyme França', 'url'=>'https://www.pexels.com/photo/close-up-photography-of-a-woman-s-face-839348/'],
    111=>['src'=>'/storage/global/img/credit/coordiy_5ac0414080d1d_250.jpeg', 'title'=>'hair modal, ヘアーモデル', 'credit'=>'Yuliya Shabliy', 'url'=>'https://www.pexels.com/photo/beautiful-brunette-business-casual-388517/'],
    112=>['src'=>'/storage/global/img/credit/kaigi1_250.jpeg', 'title'=>'meeting, ミーティング', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/adult-agreement-blur-brainstorming-630839/'],
    113=>['src'=>'/storage/global/img/credit/coordiy_5ac0419f86fc4_250.jpeg', 'title'=>'meeting, ミーティング', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/man-and-woman-handshake-567633/'],
    114=>['src'=>'/storage/global/img/credit/coordiy_5ac041755dde9_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/black-chairs-and-white-table-159805/'],
    115=>['src'=>'/storage/global/img/credit/coordiy_5ac04183bad7f_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-architecture-business-chair-221537/'],
    117=>['src'=>'/storage/global/img/credit/coordiy_5ac04172a3e65_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/chairs-conference-room-corporate-indoors-236730/'],
    118=>['src'=>'/storage/global/img/credit/coordiy_5ac0418024e40_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/business-chairs-contemporary-decoration-210620/'],
    119=>['src'=>'/storage/global/img/credit/coordiy_5ac0416f83a12_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/black-and-white-blackboard-blinds-chairs-260928/'],
    120=>['src'=>'/storage/global/img/credit/coordiy_5ac0911a912ea_250.jpeg', 'title'=>'meeting room, ミーティングルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-chairs-close-up-contemporary-260887/'],
    121=>['src'=>'/storage/global/img/credit/coordiy_5ac042a8c9cad_250.jpeg', 'title'=>'ceramics, 陶芸', 'credit'=>'Regiane Tosatti', 'url'=>'https://www.pexels.com/photo/handmade-ceramics-pottery-workshop-22823/'],
    122=>['src'=>'/storage/global/img/credit/coordiy_5ac043f70f2ed_250.jpeg', 'title'=>'chest, チェスと', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/selective-focus-photo-of-chess-set-860377/'],
    123=>['src'=>'/storage/global/img/credit/coordiy_5ac043ee4e899_250.jpeg', 'title'=>'lesson room, レッスンルーム', 'credit'=>'Stephen Paris', 'url'=>'https://www.pexels.com/photo/brown-wooden-desk-table-752395/'],
    124=>['src'=>'/storage/global/img/credit/coordiy_5ac043e8df7b4_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'JESHOOTS.com', 'url'=>'https://www.pexels.com/photo/woman-illustrating-albert-einstein-formula-714698/'],
    125=>['src'=>'/storage/global/img/credit/coordiy_5ac04295a237d_250.jpeg', 'title'=>'kitchen, キッチン', 'credit'=>'JESHOOTS.com', 'url'=>'https://www.pexels.com/photo/apartment-blinds-cabinets-chairs-349749/'],
    126=>['src'=>'/storage/global/img/credit/coordiy_5ac043946479d_250.jpeg', 'title'=>'kitchen, キッチン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-cabinets-chairs-contemporary-279648/'],
    131=>['src'=>'/storage/global/img/credit/coordiy_5ac093e5a36a4_250.jpeg', 'title'=>'kitchen, キッチン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-architecture-ceiling-chairs-271647/'],
    132=>['src'=>'/storage/global/img/credit/coordiy_5ac049cd6e8dc_250.jpeg', 'title'=>'music, ミュージック', 'credit'=>'picjumbo.com', 'url'=>'https://www.pexels.com/photo/crowd-in-front-of-people-playing-musical-instrument-during-nighttime-196652/'],
    133=>['src'=>'/storage/global/img/credit/coordiy_5ac0947711021_250.jpeg', 'title'=>'music, ミュージック', 'credit'=>'abednego ago', 'url'=>'https://www.pexels.com/photo/broken-drumstick-close-up-dark-dirty-241687/'],
    134=>['src'=>'/storage/global/img/credit/coordiy_5ac094a05ff44_250.jpeg', 'title'=>'music, ミュージック', 'credit'=>'Negative Space', 'url'=>'https://www.pexels.com/photo/hands-hand-notes-music-34583/'],
    136=>['src'=>'/storage/global/img/credit/coordiy_5ac043a0753ef_250.jpeg', 'title'=>'music, ミュージック', 'credit'=>'Burst', 'url'=>'https://www.pexels.com/photo/acoustic-acoustic-guitar-adult-blur-374711/'],
    138=>['src'=>'/storage/global/img/credit/coordiy_5ac043bc0e1d8_250.jpeg', 'title'=>'music, ミュージック', 'credit'=>'Lucas Allmann', 'url'=>'https://www.pexels.com/photo/audience-back-view-band-blur-442540/'],
    140=>['src'=>'/storage/global/img/credit/coordiy_5ac04450974b0_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Marianne', 'url'=>'https://www.pexels.com/photo/architecture-chairs-contemporary-decorations-238377/'],
    142=>['src'=>'/storage/global/img/credit/coordiy_5ac0444318652_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/table-in-vintage-restaurant-6267/'],
    143=>['src'=>'/storage/global/img/credit/coordiy_5ac03fff78881_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blur-breakfast-chef-cooking-262978/'],
    144=>['src'=>'/storage/global/img/credit/coordiy_5ac04458b33d0_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/alcohol-architecture-bar-beer-260922/'],
    145=>['src'=>'/storage/global/img/credit/coordiy_5ac0444972156_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Life Of Pix', 'url'=>'https://www.pexels.com/photo/clear-wine-glass-on-table-67468/'],
    149=>['src'=>'/storage/global/img/credit/coordiy_5ac0445a4cb8a_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-ceiling-chairs-chandeliers-262047/'],
    150=>['src'=>'/storage/global/img/credit/coordiy_5ac04453c309d_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'vedanti', 'url'=>'https://www.pexels.com/photo/chairs-interior-design-restaurant-seats-239975/'],
    151=>['src'=>'/storage/global/img/credit/coordiy_5ac047a913ff8_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/chairs-dining-room-food-furniture-460537/'],
    152=>['src'=>'/storage/global/img/credit/coordiy_5ac0443bdc187_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Skitterphoto', 'url'=>'https://www.pexels.com/photo/italian-pizza-restaurant-italy-3498/'],
    153=>['src'=>'/storage/global/img/credit/coordiy_5ac044379e063_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/street-view-of-a-coffee-terrace-with-tables-and-chairs-6458/'],
    156=>['src'=>'/storage/global/img/credit/coordiy_5ac0442dded46_250.jpeg', 'title'=>'restaurant, レストラン', 'credit'=>'Valeria Boltneva', 'url'=>'https://www.pexels.com/photo/two-round-pendant-lamps-in-cafeteria-827528/'],
    159=>['src'=>'/storage/global/img/credit/coordiy_5ac047c7021b0_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-blue-water-buildings-business-261102/'],
    160=>['src'=>'/storage/global/img/credit/coordiy_5ac047d8672dc_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Thorsten technoman', 'url'=>'https://www.pexels.com/photo/view-of-tourist-resort-338504/'],
    161=>['src'=>'/storage/global/img/credit/coordiy_5ac046b94c995_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Burst', 'url'=>'https://www.pexels.com/photo/apartment-bed-bedroom-comfort-545034/'],
    162=>['src'=>'/storage/global/img/credit/coordiy_5ac046994168c_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/adult-bread-breakfast-chef-280121/'],
    163=>['src'=>'/storage/global/img/credit/coordiy_5ac047ac58e44_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/daylight-holidays-hotel-idyllic-261156/'],
    164=>['src'=>'/storage/global/img/credit/coordiy_5ac047ae684d2_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Stocpic', 'url'=>'https://www.pexels.com/photo/holiday-vacation-hotel-luxury-6534/'],
    166=>['src'=>'/storage/global/img/credit/coordiy_5ac046d033873_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Stocpic', 'url'=>'https://www.pexels.com/photo/person-woman-apple-hotel-5329/'],
    167=>['src'=>'/storage/global/img/credit/coordiy_5ac04623e1808_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Skitterphoto', 'url'=>'https://www.pexels.com/photo/night-dark-hotel-luxury-919/'],
    168=>['src'=>'/storage/global/img/credit/coordiy_5ac046afda502_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-beach-bed-bedroom-271643/'],
    169=>['src'=>'/storage/global/img/credit/coordiy_5ac04780a2fd0_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/bed-bedroom-chair-comfort-271619/'],
    170=>['src'=>'/storage/global/img/credit/coordiy_5ac045ddc1f48_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/bed-bedroom-blanket-candles-275845/'],
    171=>['src'=>'/storage/global/img/credit/coordiy_5ac04701ee9ca_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/brown-cushion-armchairs-in-between-brown-frame-round-mirror-53577/'],
    174=>['src'=>'/storage/global/img/credit/coordiy_5ac046be0fa15_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Donald Tong', 'url'=>'https://www.pexels.com/photo/white-bedding-cover-beside-brown-wooden-side-table-189293/'],
    179=>['src'=>'/storage/global/img/credit/coordiy_5ac04c415756e_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Ibrahim Asad', 'url'=>'https://www.pexels.com/photo/yellow-and-pink-petaled-flowers-on-table-near-ocean-under-blue-sky-at-daytime-169193/'],
    188=>['src'=>'/storage/global/img/credit/coordiy_5ac04786a5c20_250.jpeg', 'title'=>'hotel, ホテル', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/bed-bedroom-ceiling-fan-chair-280208/'],
    189=>['src'=>'/storage/global/img/credit/coordiy_5ac0486892961_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/recording-studio-with-ultra-violet-florescent-164938/'],
    190=>['src'=>'/storage/global/img/credit/coordiy_5ac048866cac4_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'tyler hendy', 'url'=>'https://www.pexels.com/photo/lights-photography-white-lighting-53265/'],
    192=>['src'=>'/storage/global/img/credit/coordiy_5ac0486707677_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/gray-and-black-mixer-164907/'],
    193=>['src'=>'/storage/global/img/credit/coordiy_5ac04878dc0e6_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/aluminum-audio-battery-broadcast-270288/'],
    194=>['src'=>'/storage/global/img/credit/coordiy_5ac0487f07bd4_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Shamraevsky Maksim', 'url'=>'https://www.pexels.com/photo/ballerina-ballet-ballet-dancer-beautiful-576801/'],
    195=>['src'=>'/storage/global/img/credit/coordiy_5ac0454939b73_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/balls-beautiful-beauty-cute-371110/'],
    199=>['src'=>'/storage/global/img/credit/coordiy_5ac048d8b74f0_250.jpeg', 'title'=>'ticket, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/action-adults-celebration-clouds-433452/'],
    201=>['src'=>'/storage/global/img/credit/coordiy_5ac048f4339cb_250.jpeg', 'title'=>'ticket, スタジオ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/orange-and-blue-abstract-painting-756076/'],
    203=>['src'=>'/storage/global/img/credit/coordiy_5ac048ca7fb0a_250.jpeg', 'title'=>'ticket, スタジオ', 'credit'=>'mali maeder', 'url'=>'https://www.pexels.com/photo/abstract-architecture-art-artwork-110818/'],
    205=>['src'=>'/storage/global/img/credit/coordiy_5ac04b944fcbd_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/adventure-casual-field-grass-551650/'],
    207=>['src'=>'/storage/global/img/credit/coordiy_5ac04c437fa72_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'imagesthai.com', 'url'=>'https://www.pexels.com/photo/assorted-green-plants-and-trees-733203/'],
    209=>['src'=>'/storage/global/img/credit/coordiy_5ac04bbd2b41e_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'snapwire', 'url'=>'https://www.pexels.com/photo/woman-standing-near-of-niagara-falls-670060/'],
    210=>['src'=>'/storage/global/img/credit/coordiy_5ac04b77e02cc_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/man-in-green-jacket-and-gray-helmet-holding-phone-standing-next-to-person-in-red-and-black-jacket-163168/'],
    211=>['src'=>'/storage/global/img/credit/coordiy_5ac04b9d41845_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'SplitShire', 'url'=>'https://www.pexels.com/photo/aerial-alpine-ceresole-reale-desktop-backgrounds-1562/'],
    212=>['src'=>'/storage/global/img/credit/coordiy_5ac04b92d978b_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Bess Hamiti', 'url'=>'https://www.pexels.com/photo/red-and-blue-hot-air-balloon-floating-on-air-on-body-of-water-during-night-time-36487/'],
    213=>['src'=>'/storage/global/img/credit/coordiy_5ac04bac85d87_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Juhasz Imre', 'url'=>'https://www.pexels.com/photo/white-airplane-728824/'],
    214=>['src'=>'/storage/global/img/credit/coordiy_5ac04c4ef156a_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'H H', 'url'=>'https://www.pexels.com/photo/cooked-crab-on-white-ceramic-palte-775863/'],
    215=>['src'=>'/storage/global/img/credit/coordiy_5ac04bb4c4377_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/close-up-of-lobster-248455/'],
    220=>['src'=>'/storage/global/img/credit/coordiy_5ac0a4e6957e2_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/woman-wearing-maroon-velvet-plunge-neck-long-sleeved-dress-while-carrying-several-paper-bags-photography-972995/'],
    221=>['src'=>'/storage/global/img/credit/coordiy_5ac159c51ea56_250.jpeg', 'title'=>'stay, 宿泊', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/brown-wooden-door-near-body-of-water-210547/'],
    222=>['src'=>'/storage/global/img/credit/coordiy_5acf087891d13_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/printed-musical-note-page-164821/'],
    223=>['src'=>'/storage/global/img/credit/coordiy_5acf08dc29137_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/playing-music-musician-classic-33597/'],
    224=>['src'=>'/storage/global/img/credit/coordiy_5acf0987b4beb_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Thibault Trillet', 'url'=>'https://www.pexels.com/photo/group-of-people-inside-disco-house-167491/'],
    225=>['src'=>'/storage/global/img/credit/coordiy_5acf0d4c479eb_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Burst', 'url'=>'https://www.pexels.com/photo/archery-arrow-daylight-equipment-544978/'],
    226=>['src'=>'/storage/global/img/credit/coordiy_5acf0db66b638_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Burst', 'url'=>'https://www.pexels.com/photo/adult-archery-club-course-545006/'],
    227=>['src'=>'/storage/global/img/credit/coordiy_5acf0e08689f6_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Lê Minh', 'url'=>'https://www.pexels.com/photo/man-holding-bow-in-seashore-977235/'],
    228=>['src'=>'/storage/global/img/credit/coordiy_5acf0f5288d31_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Johan Bos', 'url'=>'https://www.pexels.com/photo/people-riding-kayaks-696039/'],
    229=>['src'=>'/storage/global/img/credit/coordiy_5acf0f7e9fde7_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Roman Pohorecki', 'url'=>'https://www.pexels.com/photo/action-boat-canoe-clouds-241044/'],
    230=>['src'=>'/storage/global/img/credit/coordiy_5acf0fb8cd1f1_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Nicolas Postiglioni', 'url'=>'https://www.pexels.com/photo/group-of-people-ride-on-jon-boats-near-bridge-919804/'],
    231=>['src'=>'/storage/global/img/credit/coordiy_5acf11692abe5_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/'],
    232=>['src'=>'/storage/global/img/credit/coordiy_5acf117637954_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Sabrina Schulz', 'url'=>'https://www.pexels.com/'],
    233=>['src'=>'/storage/global/img/credit/coordiy_5acf1189b1fda_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/'],
    234=>['src'=>'/storage/global/img/credit/coordiy_5acf147ae4fd2_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Tookapic', 'url'=>'https://www.pexels.com/photo/idea-bulb-paper-sketch-8704/'],
    235=>['src'=>'/storage/global/img/credit/coordiy_5acf151d51f74_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/art-composition-creative-creativity-355731/'],
    236=>['src'=>'/storage/global/img/credit/coordiy_5acf15fe0ba15_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Medhat Ayad', 'url'=>'https://www.pexels.com/photo/art-black-and-white-decoration-design-383568/'],
    237=>['src'=>'/storage/global/img/credit/coordiy_5acf180c5c6a5_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Fancycrave', 'url'=>'https://www.pexels.com/photo/abstract-ancient-antique-area-243059/'],
    238=>['src'=>'/storage/global/img/credit/coordiy_5acf18650c3ef_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Regiane Tosatti', 'url'=>'https://www.pexels.com/photo/ceramics-pottery-man-artist-22824/'],
    239=>['src'=>'/storage/global/img/credit/coordiy_5acf1878ee907_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Daria Shevtsova', 'url'=>'https://www.pexels.com/photo/two-vases-on-table-842950/'],
    240=>['src'=>'/storage/global/img/credit/coordiy_5acf2a848e0c8_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-bay-bridge-buildings-356830/'],
    241=>['src'=>'/storage/global/img/credit/coordiy_5acf2d5428ad5_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Nicolas Postiglioni', 'url'=>'https://www.pexels.com/photo/group-of-people-at-the-street-950834/'],
    242=>['src'=>'/storage/global/img/credit/coordiy_5acf2e61e4777_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'imagesthai.com', 'url'=>'https://www.pexels.com/photo/green-grassy-field-landscape-photography-805448/'],
    243=>['src'=>'/storage/global/img/credit/coordiy_5acf2ea27f1e7_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Flickr', 'url'=>'https://www.pexels.com/photo/bottom-view-of-tokyo-tower-149498/'],
    244=>['src'=>'/storage/global/img/credit/coordiy_5acfdc4f0e45d_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/ancient-architecture-asia-building-356629/'],
    245=>['src'=>'/storage/global/img/credit/coordiy_5acfdae6a8241_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Yihua Chen', 'url'=>'https://www.pexels.com/photo/dinner-sushi-59782/'],
    246=>['src'=>'/storage/global/img/credit/coordiy_5acfdc367edee_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Fancycrave', 'url'=>'https://www.pexels.com/photo/hallway-in-blue-and-orange-wall-paint-219000/'],
    247=>['src'=>'/storage/global/img/credit/coordiy_5acfde3d240ec_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Skitterphoto', 'url'=>'https://www.pexels.com/photo/food-japanese-food-photography-sushi-9210/'],
    248=>['src'=>'/storage/global/img/credit/coordiy_5ad007cc8d028_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/snow-light-sky-winter-41004/'],
    249=>['src'=>'/storage/global/img/credit/coordiy_5acfe626269c8_250.jpeg', 'title'=>'tour, ツアー', 'credit'=>'Nastasia', 'url'=>'https://www.pexels.com/photo/forest-winter-sport-skiing-66990/'],
    250=>['src'=>'/storage/global/img/credit/coordiy_5ad05361655b6_250.jpeg', 'title'=>'ticket, チケット', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/adult-artist-artists-band-210887/'],
    251=>['src'=>'/storage/global/img/credit/coordiy_5ad053e015df5_250.jpeg', 'title'=>'ticket, チケット', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blur-classic-close-up-equipment-221629/'],
    252=>['src'=>'/storage/global/img/credit/coordiy_5ad062ec54203_250.jpeg', 'title'=>'room, ルーム', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/apartment-bed-bedroom-chair-462235/'],
    253=>['src'=>'/storage/global/img/credit/coordiy_5ad17d3a0a028_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/accomplishment-ceremony-education-graduation-267885/'],
    254=>['src'=>'/storage/global/img/credit/coordiy_5ad17e3944db7_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'MyStock.Photos', 'url'=>'https://www.pexels.com/photo/black-round-analog-wall-clock-121734/'],
    255=>['src'=>'/storage/global/img/credit/coordiy_5ad180aa866b4_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/adult-casual-collection-fashion-296881/'],
    256=>['src'=>'/storage/global/img/credit/coordiy_5ad17b9ac0236_250.jpeg', 'title'=>'lesson, レッスン', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/architecture-buildings-campus-cathedral-220351/'],
    257=>['src'=>'/storage/global/img/credit/coordiy_5ad189004f9ea_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Artem Bali', 'url'=>'https://www.pexels.com/photo/man-holding-on-rope-in-forest-911979/'],
    258=>['src'=>'/storage/global/img/credit/coordiy_5ad18aa99e7b9_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Lukas', 'url'=>'https://www.pexels.com/photo/action-activity-boys-colors-296308/'],
    259=>['src'=>'/storage/global/img/credit/coordiy_5ad18b1a7b246_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/activity-adventure-amusement-aqua-261429/'],
    260=>['src'=>'/storage/global/img/credit/coordiy_5ad1b706ccf30_250.jpeg', 'title'=>'active, アクティブ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/activity-bunker-club-course-274262/'],
    262=>['src'=>'/storage/global/img/credit/coordiy_5ad1b845d1013_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Hendrik B', 'url'=>'https://www.pexels.com/photo/macro-shot-audio-equalizer-744318/'],
    263=>['src'=>'/storage/global/img/credit/coordiy_5ad1ba8edac87_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/indudstrial-interior-6120/'],
    264=>['src'=>'/storage/global/img/credit/coordiy_5ad1baa04a2d5_250.jpeg', 'title'=>'studio, スタジオ', 'credit'=>'Rene Asmussen', 'url'=>'https://www.pexels.com/photo/abandoned-architecture-building-concrete-25716/'],
    265=>['src'=>'/storage/global/img/credit/coordiy_5ad1bdf6265fd_250.jpeg', 'title'=>'office, 会議室', 'credit'=>'Startup Stock Photos', 'url'=>'https://www.pexels.com/photo/man-wearing-red-while-sitting-inside-concrete-bulding-7065/'],
    266=>['src'=>'/storage/global/img/credit/coordiy_5ad1be7027e57_250.jpeg', 'title'=>'office, 会議室', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/chairs-daylight-designer-empty-416320/'],
    267=>['src'=>'/storage/global/img/credit/coordiy_5ad27b5125877_250.jpeg', 'title'=>'food, レストラン', 'credit'=>'ALBERT CHERNOGOROV', 'url'=>'https://www.pexels.com/photo/food-restaurant-photography-chicken-92670/'],
    268=>['src'=>'/storage/global/img/credit/coordiy_5ad27d3cae9f5_250.jpeg', 'title'=>'food, レストラン', 'credit'=>'mali maeder', 'url'=>'https://www.pexels.com/photo/steak-meat-raw-herbs-65175/'],
    269=>['src'=>'/storage/global/img/credit/coordiy_5ad6da8c9ae42_250.jpeg', 'title'=>'smartphone, tablet', 'credit'=>'Terje Sollie', 'url'=>'https://www.pexels.com/photo/apple-apple-device-blur-cell-phone-336948/'],
    270=>['src'=>'/storage/global/img/credit/coordiy_5ad6da982233c_250.jpeg', 'title'=>'smartphone, tablet', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/person-holding-white-ipad-38286/'],
    271=>['src'=>'/storage/global/img/credit/coordiy_5ae1010e601be_250.jpeg', 'title'=>'business, ビジネス', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/woman-wearing-white-top-holding-smartphone-and-tablet-864994/'],
    272=>['src'=>'/storage/global/img/credit/coordiy_5ae1011694f54_250.jpeg', 'title'=>'business, ビジネス', 'credit'=>'Marily Torres', 'url'=>'https://www.pexels.com/photo/group-of-people-in-dress-suits-776615/'],
    273=>['src'=>'/storage/global/img/credit/coordiy_5ae1010173b43_250.jpeg', 'title'=>'business, ビジネス', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/photo-of-woman-using-her-laptop-935756/'],
    274=>['src'=>'/storage/global/img/credit/coordiy_5ae101150fe13_250.jpeg', 'title'=>'business, ビジネス', 'credit'=>'nappy', 'url'=>'https://www.pexels.com/photo/photo-of-men-having-conversation-935949/'],
    275=>['src'=>'/storage/global/img/credit/coordiy_5ae116fb25888_250.jpeg', 'title'=>'contents, コンテンツ', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/abstract-architecture-black-and-white-boardwalk-262367/'],
    276=>['src'=>'/storage/global/img/credit/coordiy_5ae11949a7855_250.jpeg', 'title'=>'contents, コンテンツ', 'credit'=>'Tatiana', 'url'=>'https://www.pexels.com/photo/woman-standing-concrete-pilar-building-1027833/'],
    277=>['src'=>'/storage/global/img/credit/coordiy_5ae119501dea5_250.jpeg', 'title'=>'contents, コンテンツ', 'credit'=>'Scott Webb', 'url'=>'https://www.pexels.com/photo/botanical-cactus-close-up-decor-305821/'],
    278=>['src'=>'/storage/global/img/credit/coordiy_5afbc36154fb3_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Terje Sollie', 'url'=>'https://www.pexels.com/photo/close-up-of-menu-313700/'],
    279=>['src'=>'/storage/global/img/credit/coordiy_5afbc37924815_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/red-reserved-signage-beside-stainless-steel-spoon-and-fork-on-white-surface-697057/'],
    280=>['src'=>'/storage/global/img/credit/coordiy_5afbc3562fb75_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Tirachard Kumtanom', 'url'=>'https://www.pexels.com/photo/background-cafe-chairs-colors-601169/'],
    281=>['src'=>'/storage/global/img/credit/coordiy_5afbc34c16eab_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/full-drinking-glass-with-slice-of-lime-158821/'],
    282=>['src'=>'/storage/global/img/credit/coordiy_5afbc37d4b233_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/leek-and-potato-soup-with-parsley-5791/'],
    283=>['src'=>'/storage/global/img/credit/coordiy_5afbc35179de8_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'PhotoMIX Ltd.', 'url'=>'https://www.pexels.com/photo/anniversary-beautiful-birthday-celebrate-300886/'],
    284=>['src'=>'/storage/global/img/credit/coordiy_5afbc372a0aea_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Robert Bogdan', 'url'=>'https://www.pexels.com/photo/cooked-fish-with-two-green-leaf-on-round-white-ceramic-plate-676560/'],
    285=>['src'=>'/storage/global/img/credit/coordiy_5afbc35e07c95_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'Creative Stash', 'url'=>'https://www.pexels.com/photo/top-view-photography-of-white-ceramic-mug-on-white-background-768943/'],
    286=>['src'=>'/storage/global/img/credit/coordiy_5afbc375934ba_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'David Jakab', 'url'=>'https://www.pexels.com/photo/cakes-chocolate-close-up-cupcakes-959079/'],
    287=>['src'=>'/storage/global/img/credit/coordiy_5afbc35c67779_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/person-holding-white-ceramic-teacup-with-black-coffee-997719/'],
    288=>['src'=>'/storage/global/img/credit/coordiy_5afbc4f2dda2e_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'MockupEditor.com', 'url'=>'https://www.pexels.com/photo/silver-imac-near-white-ceramic-kettle-205316/'],
    289=>['src'=>'/storage/global/img/credit/coordiy_5afbd85592aae_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'gdtography', 'url'=>'https://www.pexels.com/photo/long-exposure-photography-white-dome-building-interior-911758/'],
    290=>['src'=>'/storage/global/img/credit/coordiy_5afcaa8d5dee3_250.jpeg', 'title'=>'food, 飲食', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/adult-beautiful-bride-card-388240/'],
    291=>['src'=>'/storage/global/img/credit/coordiy_5afcabf4e2a30_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Scott Webb', 'url'=>'https://www.pexels.com/photo/green-leaf-plant-in-white-flower-pot-1022923/'],
    292=>['src'=>'/storage/global/img/credit/coordiy_5afcf7be5a669_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/person-holding-white-ceramic-teacup-with-black-coffee-997719/'],
    293=>['src'=>'/storage/global/img/credit/coordiy_5afcf7ed088fc_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Rafael', 'url'=>'https://www.pexels.com/photo/nature-white-cactus-97260/'],
    294=>['src'=>'/storage/global/img/credit/coordiy_5afcf7da21b03_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Katelin Elliott', 'url'=>'https://www.pexels.com/photo/bloom-blooming-blossom-blur-463133/'],
    295=>['src'=>'/storage/global/img/credit/coordiy_5afcf7b2745b8_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Skitterphoto', 'url'=>'https://www.pexels.com/photo/air-atmosphere-blue-blue-sky-675977/'],
    296=>['src'=>'/storage/global/img/credit/coordiy_5afcf7ba9723a_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Burst', 'url'=>'https://www.pexels.com/photo/beautiful-bed-bedroom-book-545043/'],
    297=>['src'=>'/storage/global/img/credit/coordiy_5afcf7c0043df_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/blank-board-empty-painted-1050308/'],
    298=>['src'=>'/storage/global/img/credit/coordiy_5afcf7b5c2c5e_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Tirachard Kumtanom', 'url'=>'https://www.pexels.com/photo/apartment-beverage-bottle-clean-544112/'],
    299=>['src'=>'/storage/global/img/credit/coordiy_5afcf7e91fb35_250.jpeg', 'title'=>'public, 一般', 'credit'=>'its me neosiam', 'url'=>'https://www.pexels.com/photo/bright-colors-cream-creamy-592392/'],
    300=>['src'=>'/storage/global/img/credit/coordiy_5afcf7dfe97a0_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Scott Webb', 'url'=>'https://www.pexels.com/photo/selective-photography-of-white-5-petaled-flower-52674/'],
    301=>['src'=>'/storage/global/img/credit/coordiy_5afcf7e37938a_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Scott Webb', 'url'=>'https://www.pexels.com/photo/green-leaf-plant-in-white-flower-pot-1022923/'],
    302=>['src'=>'/storage/global/img/credit/coordiy_5afcf7b8a8ef4_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Ibrahim Asad', 'url'=>'https://www.pexels.com/photo/beach-chairs-flowers-nature-169208/'],
    303=>['src'=>'/storage/global/img/credit/coordiy_5afd00ee7f35b_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Element5 Digital', 'url'=>'https://www.pexels.com/photo/person-pointing-at-black-and-gray-film-camera-near-macbook-pro-1051075/'],
    304=>['src'=>'/storage/global/img/credit/coordiy_5afd00f73c6fe_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/portrait-of-a-beautiful-woman-255349/'],
    305=>['src'=>'/storage/global/img/credit/coordiy_5afd00cd34ac2_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Tim Savage', 'url'=>'https://www.pexels.com/photo/man-wearing-black-zip-up-jacket-near-beach-smiling-at-the-photo-736716/'],
    306=>['src'=>'/storage/global/img/credit/coordiy_5afd00cedda43_250.jpeg', 'title'=>'public, 一般', 'credit'=>'J carter', 'url'=>'https://www.pexels.com/photo/portrait-of-happy-young-woman-using-mobile-phone-in-city-254069/'],
    307=>['src'=>'/storage/global/img/credit/coordiy_5afd00f208d9c_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Rakicevic Nenad', 'url'=>'https://www.pexels.com/photo/women-s-black-hair-821259/'],
    308=>['src'=>'/storage/global/img/credit/coordiy_5afd00d47fb9c_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/adult-business-desk-document-296886/'],
    309=>['src'=>'/storage/global/img/credit/coordiy_5afd00c998f6d_250.jpeg', 'title'=>'public, 一般', 'credit'=>'mali maeder', 'url'=>'https://www.pexels.com/photo/men-s-black-coat-with-white-polo-shirt-213117/'],
    400=>['src'=>'/storage/global/img/credit/coordiy_5afd00e978cab_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Riccardo Bresciani', 'url'=>'https://www.pexels.com/photo/rear-view-of-woman-standing-on-beach-307006/'],
    401=>['src'=>'/storage/global/img/credit/coordiy_5afd00d79f437_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Flo Maderebner', 'url'=>'https://www.pexels.com/photo/two-man-hiking-on-snow-mountain-869258/'],
    402=>['src'=>'/storage/global/img/credit/coordiy_5aff5acdabf6e_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/multicolored-bead-lot-827066/'],
    403=>['src'=>'/storage/global/img/credit/coordiy_5aff5ac85d085_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Dom J', 'url'=>'https://www.pexels.com/photo/abstract-art-artistic-background-310452/'],
    404=>['src'=>'/storage/global/img/credit/coordiy_5aff67c14fceb_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Valeria Boltneva', 'url'=>'https://www.pexels.com/photo/adults-apron-business-counter-580613/'],
    405=>['src'=>'/storage/global/img/credit/coordiy_5b009ba042d54_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pietro Jeng', 'url'=>'https://www.pexels.com/photo/fruit-shake-pouring-on-fruit-671956/'],
    406=>['src'=>'/storage/global/img/credit/coordiy_5b009b915433e_250.jpeg', 'title'=>'public, 一般', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/photography-of-a-smiling-woman-831012/'],
    407=>['src'=>'/storage/global/img/credit/coordiy_5b009b2921495_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Leah Kelley', 'url'=>'https://www.pexels.com/photo/adult-affection-blur-couple-341520/'],
    408=>['src'=>'/storage/global/img/credit/coordiy_5b009b259478c_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/active-activity-kayak-kayaking-461595/'],
    409=>['src'=>'/storage/global/img/credit/coordiy_5b009b4acf239_250.jpeg', 'title'=>'public, 一般', 'credit'=>'freestocks.org', 'url'=>'https://www.pexels.com/photo/adult-back-view-blur-book-287335/'],
    410=>['src'=>'/storage/global/img/credit/coordiy_5b009b9ccac57_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/woman-relaxing-relax-spa-56884/'],
    411=>['src'=>'/storage/global/img/credit/coordiy_5b009b537b080_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/panoramic-view-of-sea-against-blue-sky-248771/'],
    412=>['src'=>'/storage/global/img/credit/coordiy_5b009b50cc898_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Salah Alawadhi', 'url'=>'https://www.pexels.com/photo/architecture-auditorium-blue-bright-colours-382297/'],
    413=>['src'=>'/storage/global/img/credit/coordiy_5b009b4f801a4_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/two-woman-taking-photo-in-photobooth-holding-black-and-pink-masquerade-mask-160420/'],
    414=>['src'=>'/storage/global/img/credit/coordiy_5b009b54d8ccf_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Neromare Design', 'url'=>'https://www.pexels.com/photo/barber-barbershop-haircut-men-163569/'],
    415=>['src'=>'/storage/global/img/credit/coordiy_5b009b5b4d3df_250.jpeg', 'title'=>'public, 一般', 'credit'=>'prakhar', 'url'=>'https://www.pexels.com/photo/architectural-photography-of-brown-stilt-houses-on-top-of-sea-under-orange-sky-732199/'],
    416=>['src'=>'/storage/global/img/credit/coordiy_5b009b1a9b660_250.jpeg', 'title'=>'public, 一般', 'credit'=>'McKylan Mullins', 'url'=>'https://www.pexels.com/photo/man-holding-dslr-camera-wearing-cap-1093076/'],
    417=>['src'=>'/storage/global/img/credit/coordiy_5b009ba75b58a_250.jpeg', 'title'=>'public, 一般', 'credit'=>'PhotoMIX Ltd.', 'url'=>'https://www.pexels.com/photo/light-camera-photographer-photography-106011/'],
    418=>['src'=>'/storage/global/img/credit/coordiy_5b009b2e332e0_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/three-people-discussing-inside-the-conference-room-1061574/'],
    419=>['src'=>'/storage/global/img/credit/coordiy_5b009b0f85456_250.jpeg', 'title'=>'public, 一般', 'credit'=>'mentatdgt', 'url'=>'https://www.pexels.com/photo/men-s-wearing-black-suit-jacket-and-pants-937481/'],
    420=>['src'=>'/storage/global/img/credit/coordiy_5b009b2014388_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/action-automotive-car-employee-279949/'],
    421=>['src'=>'/storage/global/img/credit/coordiy_5b00a4166a4a4_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Tirachard Kumtanom', 'url'=>'https://www.pexels.com/photo/chef-holding-white-tea-cup-887827/'],
    422=>['src'=>'/storage/global/img/credit/coordiy_5b00abfac5314_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/hearts-valentine-painting-fingernails-nail-polish-37553/'],
    423=>['src'=>'/storage/global/img/credit/coordiy_5b0e465e513b5_250.jpeg', 'title'=>'public, 一般', 'credit'=>'freestocks.org', 'url'=>'https://www.pexels.com/photo/white-black-and-red-person-carrying-heart-illustration-in-brown-envelope-867462/'],
    424=>['src'=>'/storage/global/img/credit/coordiy_5b0e46560f714_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Lynnelle Richardson', 'url'=>'https://www.pexels.com/photo/art-artistic-black-and-white-blank-311391/'],
    425=>['src'=>'/storage/global/img/credit/coordiy_5b319fcce1a05_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Kaboompics.com', 'url'=>'https://www.pexels.com/photo/crystal-ball-6102/'],
    426=>['src'=>'/storage/global/img/credit/coordiy_5b319fcb35f8b_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Rusanthan Ezhil', 'url'=>'https://www.pexels.com/photo/card-card-game-cards-chance-158966/'],
    427=>['src'=>'/storage/global/img/credit/coordiy_5b319fc14c89d_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/white-and-yellow-playing-cards-39018/'],
    429=>['src'=>'/storage/global/img/credit/coordiy_5b51783162b2c_250.jpeg', 'title'=>'public, 一般', 'credit'=>'George Becker', 'url'=>'https://www.pexels.com/photo/luck-gambling-chance-ace-127053/'],
    433=>['src'=>'/storage/global/img/credit/coordiy_5b5178919655b_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Josh Sorenson', 'url'=>'https://www.pexels.com/photo/beach-sand-831889/'],
    434=>['src'=>'/storage/global/img/credit/coordiy_5b5178421d1b8_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/back-light-ball-ball-shaped-blur-301632/'],
    435=>['src'=>'/storage/global/img/credit/coordiy_5b5178484a5c2_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Sindre Strøm', 'url'=>'https://www.pexels.com/photo/photo-displays-person-holding-ball-with-reflection-of-horizon-940880/'],
    436=>['src'=>'/storage/global/img/credit/coordiy_5b517899c1e7f_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blur-burn-burning-burnt-278779/'],
    437=>['src'=>'/storage/global/img/credit/coordiy_5b5178940614d_250.jpeg', 'title'=>'public, 一般', 'credit'=>'David Bartus', 'url'=>'https://www.pexels.com/photo/pillar-candle-inside-glass-bottle-230971/'],
    438=>['src'=>'/storage/global/img/credit/coordiy_5b5178369ed48_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/red-candle-220483/'],
    439=>['src'=>'/storage/global/img/credit/coordiy_5b51782c86c37_250.jpeg', 'title'=>'public, 一般', 'credit'=>'revac film s&photography', 'url'=>'https://www.pexels.com/photo/abstract-blaze-blur-bokeh-286145/'],
    440=>['src'=>'/storage/global/img/credit/coordiy_5b58ec86b92c7_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Artem Bali', 'url'=>'https://www.pexels.com/photo/closeup-photo-black-door-yes-we-are-open-signage-929245/'],
    441=>['src'=>'/storage/global/img/credit/coordiy_5b61229883319_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/clear-glass-with-red-sand-grainer-39396/'],
    442=>['src'=>'/storage/global/img/credit/coordiy_5b61227b025d0_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/art-background-beautiful-bright-414544/'],
    443=>['src'=>'/storage/global/img/credit/coordiy_5b612257964e7_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/abstract-bright-close-up-color-268460/'],
    445=>['src'=>'/storage/global/img/credit/coordiy_5b612290dc714_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Mikes Photos', 'url'=>'https://www.pexels.com/photo/daylight-design-door-frame-109963/'],
    446=>['src'=>'/storage/global/img/credit/coordiy_5b61224fca332_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Markus Spiske freeforcommercialuse.net', 'url'=>'https://www.pexels.com/photo/abstract-blur-bright-bubbles-364495/'],
    447=>['src'=>'/storage/global/img/credit/coordiy_5b61226630371_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/woman-in-black-scoop-neck-shirt-smiling-38554/'],
    448=>['src'=>'/storage/global/img/credit/coordiy_5b61225e82a0b_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Thorn Yang', 'url'=>'https://www.pexels.com/photo/portrait-of-smiling-girl-against-white-background-253758/'],
    449=>['src'=>'/storage/global/img/credit/coordiy_5b61228403b5b_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/black-and-white-caucasian-indoors-man-157928/'],
    450=>['src'=>'/storage/global/img/credit/coordiy_5b61228c59468_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Royal Anwar', 'url'=>'https://www.pexels.com/photo/close-up-facial-expression-fashion-fine-looking-450214/'],
    451=>['src'=>'/storage/global/img/credit/coordiy_5b6267c023216_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/advertisement-businessman-hands-handwriting-533444/'],
    452=>['src'=>'/storage/global/img/credit/coordiy_5b6267c3e3cf7_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/two-person-in-formal-attire-doing-shakehands-886465/'],
    453=>['src'=>'/storage/global/img/credit/coordiy_5b62676619d11_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/group-hand-fist-bump-1068523/'],
    455=>['src'=>'/storage/global/img/credit/coordiy_5b6267d326d06_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blank-business-composition-computer-373076/'],
    456=>['src'=>'/storage/global/img/credit/coordiy_5b6267d9e41e2_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Lukas', 'url'=>'https://www.pexels.com/photo/person-writing-on-notebook-669615/'],
    457=>['src'=>'/storage/global/img/credit/coordiy_5b62677ccaa5c_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Moose Photos', 'url'=>'https://www.pexels.com/photo/two-woman-and-one-man-looking-at-the-laptop-1036641/'],
    458=>['src'=>'/storage/global/img/credit/coordiy_5b6267cb87633_250.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>'https://www.pexels.com/photo/blur-business-coffee-commerce-273222/'],
    459=>['src'=>'/storage/global/img/credit/coordiy_5b626768bcb21_250.jpeg', 'title'=>'public, 一般', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/woman-in-white-t-shirt-holding-smartphone-in-front-of-laptop-914931/'],
    460=>['src'=>'/storage/global/img/credit/coordiy_5b6267632ffe2_250.jpeg', 'title'=>'public, 一般', 'credit'=>'rawpixel.com', 'url'=>'https://www.pexels.com/photo/group-of-people-raising-right-hand-1059120/'],
    461=>['src'=>'/storage/global/img/credit/coordiy_5b62677082b2d_250.jpeg', 'title'=>'public, 一般', 'credit'=>'bruce mars', 'url'=>'https://www.pexels.com/photo/woman-sitting-on-sofa-while-looking-at-phone-with-laptop-on-lap-920382/'],
    //402=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //403=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //404=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //402=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //403=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //404=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //404=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //402=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //403=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //404=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //402=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //403=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],
    //404=>['src'=>'/storage/global/img/credit/.jpeg', 'title'=>'public, 一般', 'credit'=>'Pixabay', 'url'=>''],

  ];
  return $photos;

}



















public static function getColors($key)
{

    $tag = [
      1  => 'amber',
      2  => 'blue',
      3  => 'blue-grey',
      4  => 'brown',
      5  => 'cyan',
      6  => 'deep-orange',
      7  => 'deep-purple',
      8  => 'fuse-dark',
      9  => 'green',
      10 => 'grey',
      11 => 'indigo',
      12 => 'light-blue',
      13 => 'light-green',
      14 => 'lime',
      15 => 'orange',
      16 => 'pink',
      17 => 'purple',
      18 => 'red',
      19 => 'teal',
      20 => 'yellow'
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

























public static function getRecruitType($type, $summary_key, $desc_key)
{

  if($type==='summary'){
    $tag = [
      10100=>'営業',
      10200=>'事務・管理',
      10300=>'企画・マーケティング・経営・管理職',
      10400=>'サービス・販売・外食',
      10500=>'ゲーム',
      10600=>'メディア・アパレル・デザイン',
      10700=>'コンサルタント・士業・金融・不動産',
      10800=>'システム開発・SE・インフラ',
      10900=>'機械・電気・電子・半導体・制御',
      11000=>'素材・化学・食品・医薬品技術職',
      11100=>'建築・土木技術職',
      11200=>'技能工・設備・交通・運輸',
      11300=>'医療・福祉・介護',
      11400=>'教育・保育・公務員・農林水産・その他'
    ];
  }elseif($type==='desc'){

    switch ($summary_key){
      case 10100: 
        $tag = [
          10101=>'企画営業・法人営業・個人営業・MR・その他営業関連',
          10102=>'テレマーケティング・コールセンター',
          10103=>'キャリアカウンセラー・人材コーディネーター',
          10104=>'その他営業'
        ];
        break;
      case 10200: 
        $tag = [
          10201=>'一般事務・アシスタント・受付・秘書・その他事務関連',
          10202=>'財務・会計・経理',
          10203=>'総務・人事・法務・知財・広報・IR',
          10204=>'物流・資材購買・貿易',
          10205=>'その他事務・管理'
        ];
        break;
      case 10300: 
        $tag = [
          10301=>'商品企画・営業企画・マーケティング・宣伝',
          10302=>'経営企画・事業統括・新規事業開発',
          10303=>'管理職・エグゼクティブ',
          10304=>'MD・バイヤー・店舗開発・FCオーナー',
          10305=>'その他企画'
        ];
        break;
      case 10400: 
        $tag = [
          10401=>'小売・流通・外食・アミューズメント',
          10402=>'美容・エステ・リラクゼーション関連',
          10403=>'旅行・ホテル・航空・ブライダル・葬祭',
          10404=>'その他サービス'
        ];
        break;
      case 10500: 
        $tag = [
          10501=>'Weｂ・インターネット・ゲーム',
          10502=>'ゲーム・マルチメディア関連',
          10503=>'その他マルチメディア'
        ];
        break;
      case 10600: 
        $tag = [
          10601=>'広告・グラフィック関連',
          10602=>'出版・印刷関連',
          10603=>'映像・音響・イベント・芸能・テレビ・放送関連',
          10604=>'ファッション・インテリア・空間・プロダクトデザイン',
          10605=>'その他クリエイティブ'
        ];
        break;
      case 10700: 
        $tag = [
          10701=>'ビジネスコンサルタント・シンクタンク',
          10702=>'士業・専門コンサルタント',
          10703=>'金融系専門職',
          10704=>'不動産・プロパティマネジメント系専門職',
          10705=>'その他専門職'
        ];
        break;
      case 10800: 
        $tag = [
          10801=>'システムコンサルタント・システムアナリスト・プリセールス',
          10802=>'システム開発（Web・オープン・モバイル系）',
          10803=>'システム開発（汎用機系）',
          10804=>'システム開発（組み込み・ファームウェア・制御系）',
          10805=>'パッケージソフト・ミドルウェア開発',
          10806=>'ネットワーク・サーバ設計・構築',
          10807=>'キャリア・ISP系',
          10808=>'運用・保守・監視・テクニカルサポート',
          10809=>'社内SE・情報システム',
          10810=>'研究・特許・テクニカルマーケティング',
          10811=>'品質管理',
          10812=>'その他IT'
        ];
        break;
      case 10900: 
        $tag = [
          10901=>'回路・システム設計',
          10902=>'半導体設計',
          10903=>'制御設計',
          10904=>'機械・機構設計・金型設計',
          10905=>'光学技術・光学設計',
          10906=>'生産技術・プロセス開発',
          10907=>'品質管理・製品評価・品質保証・生産管理・製造管理',
          10908=>'セールスエンジニア・フィールドアプリケーションエンジニア（FAE)',
          10909=>'サービスエンジニア・サポートエンジニア',
          10910=>'研究・特許・テクニカルマーケティング',
          10911=>'評価・検査・実験',
          10912=>'その他エンジニア'
        ];
        break;
      case 11000: 
        $tag = [
          11001=>'素材・化学・食品・医薬品技術職',
          11002=>'化粧品・食品・香料関連',
          11003=>'医薬品関連',
          11004=>'医療用具関連',
          11005=>'その他科学'
        ];
        break;
      case 11100: 
        $tag = [
          11101=>'プランニング・測量・設計・積算',
          11102=>'施工管理・設備・環境保全',
          11103=>'研究開発・技術開発・構造解析・特許',
          11104=>'その他建設'
        ];
        break;
      case 11200: 
        $tag = [
          11201=>'技能工（整備・工場生産・製造・工事）',
          11202=>'運輸・配送・倉庫関連',
          11203=>'交通（鉄道・バス）関連',
          11204=>'警備・清掃・設備管理関連',
          11205=>'その他設備',
        ];
        break;
      case 11300: 
        $tag = [
          11301=>'医療サービス関連',
          11302=>'福祉・介護サービス・栄養',
          11303=>'その他医療'
        ];
        break;
      case 11400: 
        $tag = [
          11401=>'教育・保育・インストラクター・通訳・翻訳',
          11402=>'公務員・団体職員',
          11403=>'農林水産関連職',
          11404=>'その他公務員'
        ];
        break;
    }
    
  }

  if($desc_key){
    return $tag[$desc_key];
  }elseif($type==='summary' and $summary_key){
    return $tag[$summary_key];
  }else{
    return $tag;
  }

}



public static function getBankName($id)
{
    $bank = DB::table('bank')->select('name')->find($id);
    return $bank->name;
}

public static function getCompanyCodeName($id)
{
    if($id){
      $a = DB::table('company_code')->select('name')->find($id);
      return $a->name;
    }else{
      return '';
    } 
}


public static function getCompanyTypeFirstName($id)
{
  if($id){
    $a = DB::table('company_type_first')->select('name')->find($id);
    return $a->name;
  }else{
    return '';
  } 
}

public static function getCompanyTypeSecondName($id)
{
  if($id){
    $a = DB::table('company_type_second')->select('name')->find($id);
    return $a->name;
  }else{
    return '';
  } 
}

public static function getNice($table, $id, $type)
{

  if($table==='contents'){
    $key = 'content_id';
    $table = 'content';
  }elseif($table==='recommend'){
    $key = 'recommend_id';
  }elseif($table==='owner'){
    $key = 'owner_id';
  }
  $ans = DB::table($table . '_' . $type)
    ->where($key, $id)
    ->sum('point');
  return $ans;
}

public function whatFavorite($type, $me_id, $id)
{
  // type is 'users','place','contents'.
  if($favo = Favorite::select($type)
    ->where('user_id', $me_id)
    ->first())
  {
    $favo = json_decode($favo[$type], true);
  }
  if( ($favo) and in_array($id, $favo, true)){
    return true;
  }else{
    return null;
  }
}


function delelteImage($path, $old_name)
{

  Storage::disk('public')->makeDirectory($path);
  $path = base_path(). '/storage/app/public' . $path;
  
  if($old_name){
    $filename = $path . $old_name;
    //logger($filename);
    $filename = $path . Util::addFilename($old_name,'80');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($old_name,'250');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($old_name,'1600');
    if (file_exists($filename)) {
        unlink($filename);
    }
  }

  return 'ok';

}


function formFileToImage($base64String, $path, $old_name, $name )
{

  Storage::disk('public')->makeDirectory($path);
  $path = base_path(). '/storage/app/public' . $path;
  
  if($old_name){
    $filename = $path . $old_name;
    //logger($filename);
    $filename = $path . Util::addFilename($old_name,'80');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($old_name,'1600');
    if (file_exists($filename)) {
        unlink($filename);
    }
  }

  $img = Image::make($base64String);
  $width  = $img->width();
  $height = $img->height();

  if($width < $height){ $img->resize(400, null, function ($constraint) {$constraint->aspectRatio();});
  }else{                $img->resize(null, 400, function ($constraint) {$constraint->aspectRatio();});}
  $img->crop(400,250)->save($path.Util::addFilename($name,'400'), 100);

  $img = Image::make($base64String);
  if($width < $height){ $img->resize(1600, null, function ($constraint) {$constraint->aspectRatio();});
  }else{                $img->resize(null, 1600, function ($constraint) {$constraint->aspectRatio();});}
  $img->crop(1600,1000)->save($path.Util::addFilename($name,'1600'), 100);

  return $name;

}



function formFileToImageLicenseQuestion($base64String, $path, $old_name, $name )
{

  Storage::disk('public')->makeDirectory($path);
  $path = base_path(). '/storage/app/public' . $path;
  
  if($old_name){
    $filename = $path . $old_name;
    if (file_exists($filename)) {
        unlink($filename);
    }
  }

  $img = Image::make($base64String)->save($path.$name, 100);

  return $name;

}



function managerFormFileToImage($base64String, $path, $name )
{

  Storage::disk('public')->makeDirectory($path);
  $path = base_path(). '/storage/app/public' . $path;

  $img = Image::make($base64String);
  //$img = Util::orientate($img, $orientation );
  $width  = $img->width();
  $height = $img->height();

  $img = Image::make($base64String);
  if($width < $height){ $img->resize(400, null, function ($constraint) {$constraint->aspectRatio();});
  }else{                $img->resize(null, 400, function ($constraint) {$constraint->aspectRatio();});}
  $img->crop(400,250)->save($path.$name, 100);

  return $name;

}



public static function deleteImage($path, $name){

  $path = base_path(). '/storage/app/public' . $path;

  if($name){
    $filename = $path . Util::addFilename($name,'80');
    //logger($filename);
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($name,'250');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($name,'400');
    if (file_exists($filename)) {
        unlink($filename);
    }
    $filename = $path . Util::addFilename($name,'1600');
    if (file_exists($filename)) {
        unlink($filename);
    }
  }

  Storage::deleteDirectory($path);

  return 1;

}






public static function getRoomid($user_id,$friend_id)
{
    $sort_src = [$user_id,$friend_id];
    sort($sort_src);
    return $sort_src[0] . '-' . $sort_src[1];
}


public static function getGender($type)
{
  $keyValue = [
    1=>'真ん中',
    2=>'男',
    3=>'女'
  ];
  return $keyValue[$type];
}



public static function ToMin($time){
  $tArry=explode(":",$time);
  $hour=$tArry[0]*60;//時間→分
  $secnd=round($tArry[2]/60,2);//秒→分　少数第2を丸めてる
  $mins=$hour+$tArry[1]+$secnd;//分だけを足す
  return $mins;	
}


public static function getPublicCountryArea($type)
{

  $keyValue = [
    13=>'東京',
    27=>'大阪',
    23=>'名古屋',
    14=>'横浜',
    20=>'長野',
    22=>'静岡',
    12=>'千葉',
    1 =>'北海道',
    40=>'福岡',
    26=>'京都',
    47=>'沖縄',
    7 =>'宮城',
    15=>'新潟',
    16=>'富山',
    37=>'香川',
    34=>'広島'
  ];
  if($type==='all'){
    return $keyValue;
  }elseif($type==='onlyKey'){
    return [
      13,
      27,
      23,
      14,
      20,
      22,
      12,
      1,
      40,
      26,
      47,
      7,
      15,
      16,
      37,
      34
    ];
  }else{
    if($type){
      return $keyValue[$type];
    }
  }

  return '';

}

public static function areaUtil($id)
{

    if(!$id){
      return 13;
    }

    function grandAreaList(){

      $grandAreaIds = [13,27,23,14,20,22,12,1,40,26,47,7,15,16,37,34];
      return DB::table('country_area')
        ->select('ken_id','latitude','longitude')
        ->whereIn('ken_id',$grandAreaIds)
        ->get();
    }

    function location_distance($lat1, $lon1, $lat2, $lon2){
      $lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );//２点の緯度の平均
      $lat_difference = deg2rad( $lat1 - $lat2 );//２点の緯度差
      $lon_difference = deg2rad( $lon1 - $lon2 );//２点の経度差
      $curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
      $meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
      $prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径

      //２点間の距離
      $distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
      $distance = sqrt($distance);

      $distance_unit = round($distance);
      if($distance_unit < 1000){//1000m以下ならメートル表記
        $distance_unit = $distance_unit."m";
      }else{//1000m以上ならkm表記
        $distance_unit = round($distance_unit / 100);
        $distance_unit = ($distance_unit / 10)."km";
      }

      //$hoge['distance']で小数点付きの直線距離を返す（メートル）
      //$hoge['distance_unit']で整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以下は小数点第一位以上の数をkmで記述 例：2.8km）
      return array("distance" => $distance, "distance_unit" => $distance_unit);

    }

    $country_area_list = grandAreaList();
    $country_my_list = DB::table('country_area')
      ->select('ken_id','latitude','longitude')
      ->find($id);
      
    $lat1 = $country_my_list->latitude;
    $lon1 = $country_my_list->longitude;
    $ans = null;
    $mostleast = 99999999999999;
    foreach($country_area_list as $k => $v){
      $lat2 = $v->latitude;
      $lon2 = $v->longitude;
      $long=location_distance($lat1, $lon1, $lat2, $lon2);
      if($long['distance'] < $mostleast){
        $mostleast = $long['distance'];
        $ans = $v->ken_id;
      }
      if($mostleast === 0){
        break;
      }
    }

    return $ans;

}

public static function getCountryAreasJp()
{
  return DB::table('country_area')->select('id','ken_id','name')->where('country_id',392)->get();
}

public static function getCountryName($id)
{
  if($id){
    if($tmp = DB::table('country')->select('name')->find($id)){
      return $tmp->name;
    }
  }
  return '';
}
public static function getCountryAreaName($id)
{
  if($id){
    if($tmp = DB::table('country_area')->select('name')->where('ken_id',$id)->first()){
      return $tmp->name;
    }
  }
  return '';
}
public static function getCountryAreaOneName($id)
{
  if($id){
    if($tmp = DB::table('city_address')->select('city_name')->where('city_id',$id)->first()){
      return $tmp->city_name;
    }
  }
  return '';
}
public static function getCountryAreaTwoName($id)
{
  if($id){
    if($tmp = DB::table('town_address')->select('town_name')->where('town_id',$id)->first()){
      return $tmp->town_name;
    }
  }
  return '';
}



public static function getUserGood($id)
{
  $good = 0;
  $good += DB::table('content_good')->select('id')->where('user_id',$id)->count();
  $good += DB::table('recommend_good')->select('id')->where('user_id',$id)->count();
  return $good;
}
public static function getUserBad($id)
{
  $bad = 0;
  $bad += DB::table('content_bad')->select('id')->where('user_id',$id)->count();
  $bad += DB::table('recommend_bad')->select('id')->where('user_id',$id)->count();
  return $bad;
}
















/**
 * Orientate an image, based on its exif rotation state
 * 
 * @param  Intervention\Image\Image $image
 * @param  integer $orientation Image exif orientation
 * @return Intervention\Image\Image
 */
public static function orientate($image, $orientation)
{
  
    switch ($orientation) {

        // 888888
        // 88    
        // 8888  
        // 88    
        // 88    
        case 1:
            return $image;

        // 888888
        //     88
        //   8888
        //     88
        //     88
        case 2:
            return $image->flip('h');


        //     88
        //     88
        //   8888
        //     88
        // 888888
        case 3:
            return $image->rotate(180);

        // 88    
        // 88    
        // 8888  
        // 88
        // 888888
        case 4:
            return $image->rotate(180)->flip('h');

        // 8888888888
        // 88  88    
        // 88        
        case 5:
            return $image->rotate(-90)->flip('h');

        // 88        
        // 88  88    
        // 8888888888
        case 6:
            return $image->rotate(-90);

        //         88
        //     88  88
        // 8888888888
        case 7:
            return $image->rotate(-90)->flip('v');

        // 8888888888
        //     88  88
        //         88
        case 8:
            return $image->rotate(90);

        default:
            return $image;
    }
}



public static function getCalendarFlug($key)
{

  //$type = key or name
    $tag = [
      0 => '受付中',
      1 => '登録',
      2 => '翌々月',
      3 => '',
      4 => ''
    ];
  return $tag[$key];


}



public static function calendarDateStatusGet($key,$type)
{

  //$type = key or name
  if($type==='key'){
    $tag = [
      null => null,
      1 => 'move',
      2 => 'tourism',
      3 => 'experience',
      4 => 'breakfast',
      5 => 'lunch',
      6 => 'diner',
      7 => 'check-in-out',
      8 => 'freetime',
      9 => 'other'
    ];
  }elseif($type==='name'){
    $tag = [
      null => null,
      1 => '移動',
      2 => '観光',
      3 => '体験',
      4 => '朝食',
      5 => 'ランチ',
      6 => '夕食',
      7 => 'チェックアウト',
      8 => '自由行動',
      9 => 'その他'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}

public static function CalendarMoveTypeGet($key,$type)
{


  //$type = key or name
  if($type==='key'){
    $tag = [
      null => null,
      1 => 'walk',
      2 => 'bicycle',
      3 => 'car',
      4 => 'taxi',
      5 => 'train',
      6 => 'bus',
      7 => 'shinkansen',
      8 => 'airport',
      9 => 'ship'
    ];
  }elseif($type==='name'){
    $tag = [
      null => null,
      1 => '徒歩',
      2 => '自転車',
      3 => '自動車',
      4 => 'タクシー',
      5 => '電車',
      6 => 'バス',
      7 => '新幹線',
      8 => '飛行機',
      9 => '船'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}


public static function timeEdit($time)
{

  $ans = '';
  $time = str_split($time);
  if(!$time){
      return '';
  }

  $a = $time[0];
  $b = $time[1];
  $c = $time[3];
  $d = $time[4];

  if( !($a==='0' and $b==='0') ){
    if($a!=='0'){
      $ans = $ans . $a . $b . '時間';
    }else{
      $ans = $ans . $b . '時間';
    }
  }

  if( !($c==='0' and $d==='0') ){
    if($c!=='0'){
      $ans = $ans . $c . $d . '分';
    }else{
      $ans = $ans . $d . '分';
    }
  }

  return $ans;

}


public static function getIcon($key,$size,$color)
{

  $a1 = '<i class="icon icon-check-circle-outline ' . $size . ' title="登録" alt="登録"></i>';
  $a2 = '<i class="icon icon-pencil-box ' . $size . ' title="編集" alt="編集"></i>';
  $a3 = '<i class="icon icon-lead-pencil ' . $size . ' title="編集" alt="編集"></i>';
  $a4 = '<i class="icon icon-home-variant ' . $size . ' title="ホーム" alt="ホーム"></i>';
  $a5 = '<i class="icon icon-cancel ' . $size . ' title="キャンセル" alt="キャンセル"></i>';
  $a6 = '<i class="icon icon-trash ' . $size . ' title="削除" alt="削除"></i>';
  $a7 = '<i class="icon icon-plus-circle-outline ' . $size . ' title="追加" alt="追加"></i>';
  $a8 = '<i class="icon icon-shape-polygon-plus ' . $size . ' title="再登録" alt="再登録"></i>';
  $a9 = '<i class="icon icon-food-apple ' . $size . ' text-' . $color . '-600" title="単品" alt="単品"></i>';
  $a10 = '<i class="icon icon-food-variant ' . $size . ' text-' . $color . '-600" title="コース" alt="コース"></i>';
  $a11 = '<i class="icon icon-star ' . $size . ' text-yellow-600" title="お気に入り登録" alt="お気に入り登録"></i>';
  $a12 = '<i class="icon icon-star ' . $size . ' text-red-600" title="お気に入り解除" alt="お気に入り解除"></i>';
  //$a5 = '<i class="icon  ' . $size . ' text-' . $color . '-500" title="" alt=""></i>';
  $tag = [
    'register'   => $a1,
    'edit'       => $a2,
    'edit_table' => $a3,
    'home'       => $a4,
    'cancel'     => $a5,
    'delete'     => $a6,
    'add'        => $a7,
    'reActive'   => $a8,
    'foodSingle'   => $a9,
    'foodCourse'   => $a10,
    'favoriteAdd'   => $a11,
    'favoriteDelete'   => $a12
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


public static function getManagerMenuList($key,$type,$size)
{
  return null;

}






public static function getDefaultMenuList($key,$type,$size)
{

  
  if($type==='name'){
    $tag = [
      'license' => '出題科目学習',
      'license/try/question' => '過去問受験'
    ];
  }elseif($type==='icon'){
    $a1 = '<i class="icon icon-lead-pencil ' . $size . ' text-red-600" title="出題科目学習" alt="出題科目学習"></i>';
    $a2 = '<i class="icon icon-account ' . $size . ' text-cyan-600" title="過去問受験" alt="過去問受験"></i>';
    $tag = [
      'license'      => $a1,
      'license/try/question'   => $a2
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}



public static function getOwnerContentEditMenuList($key,$type,$size)
{

  
  if($type==='name'){
    $tag = [
      'top' => 'コンテンツトップ',
      'golist' => '所在地',
      'capacity' => '施設設備',
      'menu' => 'メニュー',
      'discount' => '割引設定',
      //'calendar' => 'スケジュール',
      'desc' => '概要',
      'cancel' => 'キャンセル料',
      'date' => '予約管理',
      'sell' => '売上げ',
      'recruit' => '求人エントリー管理'
    ];
  }elseif($type==='icon'){
    $a0 = '<i class="icon icon-comment-multipe-outline ' . $size . ' text-deep-purple-400" title="コンテンツトップ" alt="コンテンツトップ"></i>';
    $a1 = '<i class="icon icon-map-marker-plus ' . $size . ' text-red-A700" title="所在地/目的地" alt="所在地/目的地"></i>';
    $a2 = '<i class="icon icon-store ' . $size . ' text-cyan-A700" title="施設設備" alt="施設設備"></i>';
    $a3 = '<i class="icon icon-format-list-bulleted-type ' . $size . ' text-black-500" title="メニュー" alt="メニュー"></i>';
    $a4 = '<i class="icon icon-arrow-down-bold-hexagon-outline' . $size . ' text-amber-500" title="割引設定" alt="割引設定"></i>';
    //$a4 = '<i class="icon icon-calendar-clock ' . $size . ' text-blue-grey-500" title="スケジュール" alt="スケジュール"></i>';
    $a5 = '<i class="icon icon-note-text ' . $size . ' text-light-blue-900" title="概要" alt="概要"></i>';
    $a6 = '<i class="icon icon-cancel ' . $size . ' text-red-800" title="キャンセル料" alt="キャンセル料"></i>';
    $a7 = '<i class="icon icon-calendar-plus ' . $size . ' text-green-700" title="予約受付営業日/開催日" alt="予約受付営業日/開催日"></i>';
    $a8 = '<i class="icon icon-chart-bar-stacked ' . $size . ' text-blue-500" title="売上げ" alt="売上げ"></i>';
    $a9 = '<i class="icon icon-account-search ' . $size . ' text-orange-700" title="求人エントリー管理" alt="求人エントリー管理"></i>';
    $tag = [
      'top'      => $a0,
      'golist'   => $a1,
      'capacity' => $a2,
      'menu'     => $a3,
      'discount' => $a4,
      //'calendar' => $a4,
      'desc'     => $a5,
      'cancel'   => $a6,
      'date'     => $a7,
      'sell'     => $a8,
      'recruit'  => $a9
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}

public static function getAccountGroundMenuList($key,$type,$size)
{

  if($type==='name'){
    $tag = [
      'top'                    => '資格学習トップ',
      'getLicensestudyArea'    => '出題科目学習',
      'question/1'             => '過去問学習',
      'getLicenseMustReadList' => '一読リスト',
      'getLicenseData'         => '試験データ',
      'getLicenseStatistics'   => '試験合格率',
      'getLicenseSchedule'     => '学習スケジュール',
      'getLicenseTest'         => '試験日程',
      'getLicenseHotWords'     => 'ホットワード'
    ];
  }elseif($type==='icon'){
    $tag = [
      'top'                    => '<i class="icon icon-lead-pencil ' . $size . ' text-orange-500" title="ホーム" alt="ホーム"></i>',
      'getLicensestudyArea'    => '<i class="icon icon-book-open ' . $size . ' text-red-400" title="出題科目学習" alt="出題科目学習"></i>',
      'question/1'             => '<i class="icon icon-book-open-page-variant ' . $size . ' text-blue-400" title="過去問学習" alt="過去問学習"></i>',
      'getLicenseMustReadList' => '<i class="icon icon-widgets ' . $size . ' text-green-600" title="一読リスト" alt="一読リスト"></i>',
      'getLicenseData'         => '<i class="icon icon-data ' . $size . ' text-yellow-600" title="試験データ" alt="試験データ"></i>',
      'getLicenseStatistics'   => '<i class="icon icon-lightbulb-on-outline ' . $size . ' text-blue-gray-600" title="試験合格率" alt="試験合格率"></i>',
      'getLicenseSchedule'     => '<i class="icon icon-calendar-text ' . $size . ' text-purple-400" title="学習スケジュール" alt="学習スケジュール"></i>',
      'getLicenseTest'         => '<i class="icon icon-calendar-clock ' . $size . ' text-lime-400" title="試験日程" alt="試験日程"></i>',
      'getLicenseHotWords'     => '<i class="icon icon-fire ' . $size . ' text-red-500 title="ホットワード" alt="ホットワード"></i>'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}


public static function getAccountMenuList($key,$type,$size)
{

  if($type==='name'){
    $tag = [
      'license'            => '資格学習',
      'license/try/question' => '過去問受験',
      'try/history'        => '過去問受験履歴',
      'recommend'          => '学習メモ',
      'favorite'           => '補習リスト',
      'profile'            => '登録情報'
    ];
  }elseif($type==='icon'){
    $tag = [
      'license'            => '<i class="icon icon-account-edit ' . $size . ' text-red-500" title="資格学習" alt="資格学習"></i>',
      'license/try/question' => '<i class="icon icon-lead-pencil ' . $size . ' text-black-500" title="過去問受験" alt="過去問受験"></i>',
      'try/history'   => '<i class="icon icon-library-books ' . $size . ' text-blue-400" title="過去問受験履歴" alt="過去問受験履歴"></i>',
      'recommend' => '<i class="icon icon-book-open-page-variant ' . $size . ' text-green-600" title="学習メモ" alt="学習メモ"></i>',
      'favorite'  => '<i class="icon icon-content-save-all ' . $size . ' text-amber-500 title="補習リスト" alt="補習リスト"></i>',
      'profile'   => '<i class="icon icon-account-settings ' . $size . ' text-blue-100" title="登録情報" alt="登録情報"></i>'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}




public static function getContentDateStatus($key,$type,$size)
{

  if($type==='name'){
    $tag = [
      0  => '非表示',
      1  => '受付中',
      2  => '残り中',
      3  => '残りわずか',
      4  => 'キャンセル待ち',
      5  => '受付終了',
      6  => '満員',
      7  => '中止',
      8  => '延期',
      9  => '終了',
      10 => '貸切'
    ];
  }elseif($type==='icon'){
    $tag = [
      '0'   => '<i class="icon icon-stop ' . $size . ' text-grey-400" title="非表示" alt="非表示"></i>',
      '1'   => '<i class="icon icon-circle ' . $size . ' text-green-600" title="受付中" alt="受付中"></i>',
      '2'   => '<i class="icon icon-circle ' . $size . ' text-orange-900" title="残り中" alt="残り中"></i>',
      '3'   => '<i class="icon icon-alert ' . $size . ' text-yellow-500" title="残りわずか" alt="残りわずか"></i>',
      '4'   => '<i class="icon icon-skip-next ' . $size . ' text-blue-400" title="キャンセル待ち" alt="キャンセル待ち"></i>',
      '5'   => '<i class="icon icon-barley ' . $size . ' text-grey-600" title="受付終了" alt="受付終了"></i>',
      '6'   => '<i class="icon icon-timer-sand-full ' . $size . ' text-grey-500" title="満員" alt="満員"></i>',
      '7'   => '<i class="icon icon-stop-circle ' . $size . ' text-grey-700" title="中止" alt="中止"></i>',
      '8'   => '<i class="icon icon-sleep ' . $size . ' text-grey-800" title="延期" alt="延期"></i>',
      '9'   => '<i class="icon icon-cancel ' . $size . ' text-grey-400" title="終了" alt="終了"></i>',
      '10'  => '<i class="icon icon-stop-circle ' . $size . ' text-purple-700" title="貸切" alt="貸切"></i>'
    ];
  }elseif($type==='color'){
    $tag = [
      '0'   => '#bdbdbd',
      '1'   => '#00c853',
      '2'   => '#E65100',
      '3'   => '#fdd835',
      '4'   => '#607D8B',
      '5'   => '#37474f',
      '6'   => '#9E9E9E',
      '7'   => '#616161',
      '8'   => '#424242',
      '9'   => '#bdbdbd',
      '10'  => '#7B1FA2'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}



public static function getOwnerMenuList($key,$type,$size)
{
  //$type = key or name or desc
  if($type==='key'){
    $tag = [
      1  => 'home',
      3  => 'license',
      5  => 'question',
      7  => 'profile',
      11 => 'bank',
      12 => 'pay',
    ];
  }elseif($type==='name'){
    $tag = [
      1  => 'オーナーホーム',
      3  => '資格',
      5  => '問題',
      7  => 'オーナー登録情報',
      11 => '入金口座',
      12 => 'ネット決済'
    ];
  }elseif($type==='url'){
    $tag = [
      1  => '/owner',
      3  => '/owner/license',
      5  => '/owner/license/question',
      7  => '/owner/profile',
      11 => '/owner/bank',
      12 => '/owner/pay'
    ];
  }elseif($type==='icon'){
    $a1  = '<i class="icon icon-home-outline ' . $size . ' " title="オーナーホーム" alt="オーナーホーム"></i>';
    $a3  = '<i class="icon icon-pencil-box-outline ' . $size . ' " title="資格" alt="資格"></i>';
    $a5  = '<i class="icon icon-comment-multipe-outline ' . $size . ' " title="資格問題" alt="資格問題"></i>';
    $a7  = '<i class="icon icon-store ' . $size . ' " title="オーナー登録情報" alt="オーナー登録情報"></i>';
    $a11 = '<i class="icon icon-bank ' . $size . ' " title="入金口座" alt="入金口座"></i>';
    $a12 = '<i class="icon icon-credit-card ' . $size . ' " title="ネット決済" alt="ネット決済"></i>';
    $tag = [
      1  => $a1,
      3  => $a3,
      5  => $a5,
      7  => $a7,
      11 => $a11,
      12 => $a12
    ];
  }
  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}












public static function ownerSupportType($key,$type)
{
  
    if($type==='key'){
      $tag = [
        1  => 'bronze',
        2  => 'Silver',
        3  => 'gold',
        4  => 'platinum',
        11 => 'small',
        12 => 'smart',
        13 => 'middle',
        14 => 'big'
      ];
    }elseif($type==='name'){
      $tag = [
        1  => 'ブロンズ',
        2  => 'シルバー',
        3  => 'ゴールド',
        4  => 'プラチナ',
        11 => 'スモール',
        12 => 'スマート',
        13 => 'ミドル',
        14 => 'ビッグ'
      ];
    }elseif($type==='price'){
      $tag = [
        1  => 0,
        2  => 1280,
        3  => 2480,
        4  => 39800,
        11 => 78900,
        12 => 158900,
        13 => 262600,
        14 => 598900
      ];
    }
    
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';

}


public static function ownerSupportTypePublic($key,$type)
{
  
    if($type==='desc'){
      $tag = [
        1  => ['name'=>'メッセージサポート','desc'=>'メッセージツール、もしくは、Eメールによる問合せができます。',                                                'price'=>0,   1=>'<span class="text-info h1">○<span>', 2=>'<span class="text-info h1">○<span>', 3=>'<span class="text-info h1">○</span>'],
        2  => ['name'=>'電話サポート','desc'=>'電話によるお問合せができます。',                                                                                 'price'=>1280,1=>'<span class="h1">×</span>',          2=>'<span class="text-info h1">○<span>', 3=>'<span class="text-info h1">○</span>'],
        3  => ['name'=>'お任せサポート','desc'=>'予約受付の割引設定、キャパシティの一時変更、メニューの一時変更など細かい対応をCoordiyスタッフが代理対応いたします。', 'price'=>4980,1=>'<span class="h1">×</span>',          2=>'<span class="h1">×</span>',          3=>'<span class="text-info h1">○</span>'],
      ];
    }
    
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}

                       
public static function ownerSupportTypeSpot($key,$type)
{
  
    if($type==='key'){
      $tag = [
        11  => ['name'=>'店舗','desc'=>'店舗
        紹介文制作
        イメージ制作','price'=>2640,'ex'=>'店舗','ex_short'=>'S'],
        12  => ['name'=>'設備/ルーム','desc'=>'設備・ルーム
        紹介文制作
        イメージ制作','price'=>1280,'ex'=>'','ex_short'=>'S'],
        13  => ['name'=>'メニュー','desc'=>'メニュー
        紹介文制作
        イメージ制作','price'=>1280,'ex'=>'M','ex_short'=>'S'],
        14  => ['name'=>'グットポイント','desc'=>'グットポイント
        紹介文制作
        イメージ制作','price'=>1560,'ex'=>'グットポイント','ex_short'=>'G'],
        15  => ['name'=>'出張撮影','desc'=>'全国出張撮影対応','price'=>12980,'ex'=>null,'ex_short'=>null],
      ];
    }
    
    if(is_null($key)){
      return $tag;
    }elseif($key>=0){
      if(isset($tag[$key])){
        return $tag[$key];
      }
    }
  
    return '';

}













public static function getEventOfYear($key)
{
  if($key<0) return '';
    $tag = [
      0 => 'お誕生！',
      1 => '保育園ひよこ',
      2 => '保育園ことり',
      3 => '保育園あか',
      4 => '保育園あお',
      5 => '保育園みどり',
      6 => '小学校１年生',
      7 => '小学校２年生',
      8 => '小学校３年生',
      9 => '小学校４年生',
      10 => '小学校５年生',
      11 => '小学校６年生',
      12 => '中学１年生',
      13 => '中学２年生',
      14 => '中学３年生',
      15 => '高校１年生',
      16 => '高校２年生',
      17 => '高校３年生',
      18 => '選挙権取得
      免許取得
      大学１年生',
      19 => '大学２年生',
      20 => '成人
      大学３年生',
      21 => '大学４年生',
      22 => '大学院生１年生
      社会人１年生',
      23 => '大学院生２年生
      社会人２年生',
      24 => '社会人３年生',
      25 => '',
      26 => '',
      27 => '博士号取得',
      28 => '',
      29 => '',
      30 => '',
      31 => '',
      32 => '',
      33 => '',
      34 => '',
      35 => '',
      36 => '',
      37 => '',
      38 => '',
      39 => '',
      40 => '初老
      介護保険第2号被保険者認定',
      41 => '',
      42 => '',
      43 => '',
      44 => '',
      45 => '',
      46 => '',
      47 => '',
      48 => '',
      49 => '',
      50 => '',
      51 => '',
      52 => '',
      53 => '',
      54 => '',
      55 => '',
      56 => '',
      57 => '',
      58 => '',
      59 => '',
      60 => '',
      61 => '',
      62 => '',
      63 => '',
      64 => '',
      65 => '定年退職
      年金受給開始
      介護保険第1号被保険者認定',
      66 => '',
      67 => '',
      68 => '世界の男性平均寿命',
      69 => '',
      70 => '',
      71 => '',
      72 => '世界の女性平均寿命',
      73 => '',
      74 => '',
      75 => '後期高齢者医療制度の被保険者認定',
      76 => '',
      77 => '',
      78 => '',
      79 => '日本の男性平均寿命',
      80 => '',
      81 => '',
      82 => '',
      83 => '',
      84 => '',
      85 => '',
      86 => '日本の女性平均寿命',
      87 => '',
      88 => '',
      89 => '',
      90 => '',
      91 => '',
      92 => '',
      93 => '',
      94 => '',
      95 => '',
      96 => '',
      97 => '',
      98 => '',
      99 => '',
      100 => 'まだまだこれから！'
    ];
  
  if(is_null($key)){
    return $tag;
  }elseif($key<-3 or $key>100){
    return '';
  }elseif($key>=0){
    return $tag[$key];
  }

  return '';

}







public static function contentRecruitEntry($key,$type,$company,$content)
{
  if($type==='key'){
    $tag = [
      0 => 'paper',
      1 => 'step1',
      2 => 'step2',
      3 => 'step3',
      4 => 'step4',
      5 => 'step5',
      6 => 'step6',
      7 => 'step7',
      8 => 'step8',
      9 => 'adoption',
      10=> 'rejection'
    ];
  }elseif($type==='name'){
    $tag = [
      0 => '書類選考',
      1 => '1次面接',
      2 => '2次面接',
      3 => '3次面接',
      4 => '4次面接',
      5 => '5次面接',
      6 => '6次面接',
      7 => '7次面接',
      8 => '8次面接',
      9 => '採用',
      10=> '不採用'
    ];
  }elseif($type==='email'){
    $tag = [
      0 => '$user_name　様

' . Util::getCompanyCodeName($company->company_code) . $company->name . ' でございます。
' . $content->name . ' へエントリーいただき誠にありがとうございます。
また、エントリーに伴い、$user_name様のお時間を割いていただくことに感謝申し上げます。

つきましては、ご登録いただきました選考情報を確認しまして、改めてご連絡させていただきます。
何卒よろしくお願い申し上げます。

※============※
ご登録いただいた選考情報は採用資料として使うだけで、第三者への提供は一切ございません。
採用の決定において不採用となった場合、速やかに選考情報は破棄いたします。
※============※
' . Util::getCompanyCodeName($company->company_code) . $company->name . '
敬　具',
      1 => '$user_name　様
拝啓　時下ますますご健勝のこととお慶び申し上げます。

$old_stepの厳正なる選考の結果、$new_stepをさせていただきたく存じます。
つきましては、$yoyakuからご都合の良い日時を選んでいただき、予約受付をお願いいたします。

$new_stepの内容は以下を予定しております。
=============
顔写真撮影
筆記試験
面接
=============

お越しいただく際に以下のものをご持参ください。
=============
身分証明書
筆記用具
=============

お会いできる日を楽しみにしております。
※============※
$new_stepの予約受付が1ヶ月以上行われない場合は、辞退したものとさせていただきます。
その際は、速やかに選考情報は破棄いたします。
※============※
' . Util::getCompanyCodeName($company->company_code) . $company->name . '
敬　具',
      2 => '
      ',
      3 => '
      ',
      4 => '
      ',
      5 => '
      ',
      6 => '
      ',
      7 => '
      ',
      8 => '',
      9 => '$user_name　様
拝啓　時下ますますご健勝のこととお慶び申し上げます。

$old_stepの厳正なる選考の結果、$user_name様を採用することが内定いたしましたのでお知らせします。
つきましては、採用手続きを行いますので事前にご予約のうえ、弊社へお越しいただけますようお願い申し上げます。
また、お越しいただく際に以下のものをご持参ください。
=============
身分証明書
筆記用具
卒業証明書
=============

なお、応募書類は当社人事部にてお預かりさせていただきますのでご了承ください。
入社日および新入社員研修等の日程は改めてお越しいただいた際にお伝えいたします。

何卒よろしくお願い申し上げます。
' . Util::getCompanyCodeName($company->company_code) . $company->name . '
敬　具',
      10=> '$user_name　様
拝啓　時下ますますご健勝のこととお慶び申し上げます。

$old_stepの厳正なる選考の結果、残念ながら採用を見送りましたことをご通知いたします。
ご志望に添うことができませんでしたが、何卒ご理解の程よろしく願いたします。
なお、審査内容につきましては、お答えできませんのでご了承ください。
つきましては、ご応募に際し、お預かりしました選考情報は「個人情報保護方針」に従い適切に破棄いたします。
末筆ではありますが、$user_name様のより一層のご活躍を願っております 。

何卒よろしくお願い申し上げます。
' . Util::getCompanyCodeName($company->company_code) . $company->name . '
敬　具',
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}






public static function birthday($birth)
{
    $now = date("Ymd"); 
    $birth = date('Ymd', strtotime($birth));
    return floor(($now-$birth)/10000);
}











function remainDate($day) {
  return intval((strtotime($day) - strtotime(date('Y/m/d'))) / (60*60*24));
}

public static function convert_to_fuzzy_time($time_db){
	
//printf("time : $time_db");
	$time_db = str_replace("-", "/", $time_db);

	$unix	= strtotime($time_db);
	$now	= time();
	$diff_sec	= $now - $unix;

	if($diff_sec < 60){
		$time	= $diff_sec;
		$unit	= "秒前";
	}
	elseif($diff_sec < 3600){
		$time	= $diff_sec/60;
		$unit	= "分前";
	}
	elseif($diff_sec < 86400){
		$time	= $diff_sec/3600;
		$unit	= "時間前";
	}
	elseif($diff_sec < 2764800){
		$time	= $diff_sec/86400;
		$unit	= "日前";
	}
	else{
		if(date("Y") != date("Y", $unix)){
			$time	= date("Y年n月j日", $unix);
		}
		else{
			$time	= date("n月j日", $unix);
		}

		return $time;
	}
	return (int)$time .$unit;
}






//getPlanStay
public static function getPlanStay($getName)
{
  
  //$getType === false   : 配列
  //$getType === 'value' : index name

  $tag = [
    0      => '日帰り',
    1      => '一泊',
    2      => '二泊',
    3      => '三泊',
    4      => '五泊',
    5      => '長期宿泊'
  ];

  if($getName){
    return $tag[$getName];
  }

  return $tag;

}


















public static function getFavo($table_name)
{

    if(Auth::check()){
      $user_id = Auth::user()->id;
    }else{
      $user_id = 0;
    }
    //type = place, group, plan
    //favorite
    if($favo = Favorite::select($table_name)
      ->where('user_id', $user_id)
      ->first())
    {
      return json_decode($favo[$table_name], true);
    }else{
      return [];
    } 
}

//checkFavo
public static function checkFavo($favo, $id)
{
    if( ($favo) and in_array($id, $favo, true)){
      return true;
    }else{
      return null;
    }
}




//addFilename
public static function addFilename($filename,$addtext)
{
    $pos = strrpos($filename, '.');
    if ($pos){
      return(substr($filename, 0, $pos).'_'.$addtext.substr($filename, $pos));
    }else{
      return($filename.$addtext);	
    }
}



//changeSizeGoogleImage
public static function changeSizeGoogleImage($url,$size)
{
    $resize = 'h' . $size . '-k';
    $result = str_replace("w5000-k", $resize, $url);
    return $result;
}




public static function deleteContentMenusSteps($content_id, $service)
{
  switch ($service){
    case 'lesson': return Content_menu_step_lesson::where('content_id',$service)->delete(); break;
    case 'tour':   return Content_menu_step_tour::where('content_id',$service)->delete(); break;
    case 'ticket': return Content_menu_step_ticket::where('content_id',$service)->delete(); break;
  }
}

public static function deleteContentSteps($content_id, $service)
{
  switch ($service){
    case 'food': return Content_step_food::where('content_id',$content_id)->delete(); break;
    case 'active': return Content_step_active::where('content_id',$content_id)->delete(); break;
    case 'experience': return Content_step_experience::where('content_id',$content_id)->delete(); break;
    case 'lesson': return Content_step_lesson::where('content_id',$content_id)->delete(); break;
    case 'spasalon': return Content_step_spasalon::where('content_id',$content_id)->delete(); break;
    case 'tour': return Content_step_tour::where('content_id',$content_id)->delete(); break;
    case 'ticket': return Content_step_ticket::where('content_id',$content_id)->delete(); break;
    case 'hairsalon': return Content_step_hairsalon::where('content_id',$content_id)->delete(); break;
    case 'stay': return Content_step_stay::where('content_id',$content_id)->delete(); break;
    case 'studio': return Content_step_studio::where('content_id',$content_id)->delete(); break;
    case 'kaigi': return Content_step_kaigi::where('content_id',$content_id)->delete(); break;
    case 'hotel': return Content_step_hotel::where('content_id',$content_id)->delete(); break;
    case 'recruit': return Content_step_recruit::where('content_id',$content_id)->delete(); break;
    case 'divination': return Content_step_divination::where('content_id',$content_id)->delete(); break;
  }
}

public static function deleteContentCapacity($capa_id, $content_id, $service, $one, $all)
{
  if($one){
    switch ($service){
      case 'food': return Content_capacity_food::where('id',$capa_id)->delete(); break;
      case 'active': return Content_capacity_active::where('id',$capa_id)->delete(); break;
      case 'experience': return Content_capacity_experience::where('id',$capa_id)->delete(); break;
      case 'lesson': return Content_capacity_lesson::where('id',$capa_id)->delete(); break;
      case 'spasalon': return Content_capacity_spasalon::where('id',$capa_id)->delete(); break;
      case 'tour': return Content_capacity_tour::where('id',$capa_id)->delete(); break;
      case 'ticket': return Content_capacity_ticket::where('id',$capa_id)->delete(); break;
      case 'hairsalon': return Content_capacity_hairsalon::where('id',$capa_id)->delete(); break;
      case 'stay': return Content_capacity_stay::where('id',$capa_id)->delete(); break;
      case 'studio': return Content_capacity_studio::where('id',$capa_id)->delete(); break;
      case 'kaigi': return Content_capacity_kaigi::where('id',$capa_id)->delete(); break;
      case 'hotel': return Content_capacity_hotel::where('id',$capa_id)->delete(); break;
      case 'recruit': return Content_capacity_recruit::where('id',$capa_id)->delete(); break;
      case 'divination': return Content_capacity_divination::where('id',$capa_id)->delete(); break;
    }
  }elseif($all){
    switch ($service){
      case 'food': return Content_capacity_food::where('content_id',$content_id)->delete(); break;
      case 'active': return Content_capacity_active::where('content_id',$content_id)->delete(); break;
      case 'experience': return Content_capacity_experience::where('content_id',$content_id)->delete(); break;
      case 'lesson': return Content_capacity_lesson::where('content_id',$content_id)->delete(); break;
      case 'spasalon': return Content_capacity_spasalon::where('content_id',$content_id)->delete(); break;
      case 'tour': return Content_capacity_tour::where('content_id',$content_id)->delete(); break;
      case 'ticket': return Content_capacity_ticket::where('content_id',$content_id)->delete(); break;
      case 'hairsalon': return Content_capacity_hairsalon::where('content_id',$content_id)->delete(); break;
      case 'stay': return Content_capacity_stay::where('content_id',$content_id)->delete(); break;
      case 'studio': return Content_capacity_studio::where('content_id',$content_id)->delete(); break;
      case 'kaigi': return Content_capacity_kaigi::where('content_id',$content_id)->delete(); break;
      case 'hotel': return Content_capacity_hotel::where('content_id',$content_id)->delete(); break;
      case 'recruit': return Content_capacity_recruit::where('content_id',$content_id)->delete(); break;
      case 'divination': return Content_capacity_divination::where('content_id',$content_id)->delete(); break;
    }
  }
}

public static function getContentCapacityDesc($content_id, $service, $count, $pic, $whereIn, $find)
{

  if($pic){
    switch ($service){
      case 'food': return Content_capacity_food::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'active': return Content_capacity_active::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'experience': return Content_capacity_experience::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'lesson': return Content_capacity_lesson::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'spasalon': return Content_capacity_spasalon::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'tour': return Content_capacity_tour::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'ticket': return Content_capacity_ticket::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'hairsalon': return Content_capacity_hairsalon::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'stay': return Content_capacity_stay::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'studio': return Content_capacity_studio::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'kaigi': return Content_capacity_kaigi::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'hotel': return Content_capacity_hotel::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'recruit': return Content_capacity_recruit::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'divination': return Content_capacity_divination::select('id','pic','updated_at')->where('content_id',$content_id)->get(); break;
    }
  }elseif($find){
    switch ($service){
      case 'food': return Content_capacity_food::find($find); break;
      case 'active': return Content_capacity_active::find($find); break;
      case 'experience': return Content_capacity_experience::find($find); break;
      case 'lesson': return Content_capacity_lesson::find($find); break;
      case 'spasalon': return Content_capacity_spasalon::find($find); break;
      case 'tour': return Content_capacity_tour::find($find); break;
      case 'ticket': return Content_capacity_ticket::find($find); break;
      case 'hairsalon': return Content_capacity_hairsalon::find($find); break;
      case 'stay': return Content_capacity_stay::find($find); break;
      case 'studio': return Content_capacity_studio::find($find); break;
      case 'kaigi': return Content_capacity_kaigi::find($find); break;
      case 'hotel': return Content_capacity_hotel::find($find); break;
      case 'recruit': return Content_capacity_recruit::find($find); break;
      case 'divination': return Content_capacity_divination::find($find); break;
    }
  }elseif($whereIn){
    switch ($service){
      case 'food': return Content_capacity_food::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'active': return Content_capacity_active::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'experience': return Content_capacity_experience::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'lesson': return Content_capacity_lesson::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'spasalon': return Content_capacity_spasalon::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'tour': return Content_capacity_tour::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'ticket': return Content_capacity_ticket::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'hairsalon': return Content_capacity_hairsalon::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'stay': return Content_capacity_stay::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'studio': return Content_capacity_studio::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'kaigi': return Content_capacity_kaigi::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'hotel': return Content_capacity_hotel::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'recruit': return Content_capacity_recruit::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
      case 'divination': return Content_capacity_divination::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->take(250)->get(); break;
    }
  }elseif($count){
    switch ($service){
      case 'food': return Content_capacity_food::where('content_id',$content_id)->count(); break;
      case 'active': return Content_capacity_active::where('content_id',$content_id)->count(); break;
      case 'experience': return Content_capacity_experience::where('content_id',$content_id)->count(); break;
      case 'lesson': return Content_capacity_lesson::where('content_id',$content_id)->count(); break;
      case 'spasalon': return Content_capacity_spasalon::where('content_id',$content_id)->count(); break;
      case 'tour': return Content_capacity_tour::where('content_id',$content_id)->count(); break;
      case 'ticket': return Content_capacity_ticket::where('content_id',$content_id)->count(); break;
      case 'hairsalon': return Content_capacity_hairsalon::where('content_id',$content_id)->count(); break;
      case 'stay': return Content_capacity_stay::where('content_id',$content_id)->count(); break;
      case 'studio': return Content_capacity_studio::where('content_id',$content_id)->count(); break;
      case 'kaigi': return Content_capacity_kaigi::where('content_id',$content_id)->count(); break;
      case 'hotel': return Content_capacity_hotel::where('content_id',$content_id)->count(); break;
      case 'recruit': return Content_capacity_recruit::where('content_id',$content_id)->count(); break;
      case 'divination': return Content_capacity_divination::where('content_id',$content_id)->count(); break;
    }
  }else{
    switch ($service){
      case 'food':
        if(!$data = Content_capacity_food::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'active':
        if(!$data = Content_capacity_active::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'experience':
        if(!$data = Content_capacity_experience::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'lesson':
        if(!$data = Content_capacity_lesson::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'spasalon':
        if(!$data = Content_capacity_spasalon::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'tour':
        if(!$data = Content_capacity_tour::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = new Content_capacity_tour;
        }
        return $data;
        break;
      case 'ticket':
        if(!$data = Content_capacity_ticket::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'hairsalon':
        if(!$data = Content_capacity_hairsalon::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'stay':
        if(!$data = Content_capacity_stay::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'studio':
        if(!$data = Content_capacity_studio::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('type','desc')->orderBy('updated_at','desc')->orderBy('pic','asc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'kaigi':
        if(!$data = Content_capacity_kaigi::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'hotel':
        if(!$data = Content_capacity_hotel::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'recruit':
        if(!$data = Content_capacity_recruit::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'divination':
        if(!$data = Content_capacity_divination::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(250)->get()){
          $data = [];
        }
        return $data;
        break;
      default:
        return null;
    }
  }

}



public static function deleteContentMenu($menu_id, $content_id, $service, $one, $all)
{

  if($one){
    switch ($service){
      case 'food': return Content_menu_food::where('id',$menu_id)->delete();break;
      case 'active': return Content_menu_active::where('id',$menu_id)->delete(); break;
      case 'experience': return Content_menu_experience::where('id',$menu_id)->delete(); break;
      case 'lesson': return Content_menu_lesson::where('id',$menu_id)->delete(); break;
      case 'spasalon': return Content_menu_spasalon::where('id',$menu_id)->delete(); break;
      case 'tour': return Content_menu_tour::where('id',$menu_id)->delete(); break;
      case 'ticket': return Content_menu_ticket::where('id',$menu_id)->delete(); break;
      case 'hairsalon': return Content_menu_hairsalon::where('id',$menu_id)->delete(); break;
      case 'stay': return Content_menu_stay::where('id',$menu_id)->delete(); break;
      case 'studio': return Content_menu_studio::where('id',$menu_id)->delete(); break;
      case 'kaigi': return Content_menu_kaigi::where('id',$menu_id)->delete(); break;
      case 'hotel': return Content_menu_hotel::where('id',$menu_id)->delete(); break;
      case 'recruit': return Content_menu_recruit::where('id',$menu_id)->delete(); break;
      case 'divination': return Content_menu_divination::where('id',$menu_id)->delete(); break;
    }
  }elseif($all){
    switch ($service){
      case 'food': return Content_menu_food::where('content_id',$content_id)->delete(); break;
      case 'active': return Content_menu_active::where('content_id',$content_id)->delete(); break;
      case 'experience': return Content_menu_experience::where('content_id',$content_id)->delete(); break;
      case 'lesson': return Content_menu_lesson::where('content_id',$content_id)->delete(); break;
      case 'spasalon': return Content_menu_spasalon::where('content_id',$content_id)->delete(); break;
      case 'tour': return Content_menu_tour::where('content_id',$content_id)->delete(); break;
      case 'ticket': return Content_menu_ticket::where('content_id',$content_id)->delete(); break;
      case 'hairsalon': return Content_menu_hairsalon::where('content_id',$content_id)->delete(); break;
      case 'stay': return Content_menu_stay::where('content_id',$content_id)->delete(); break;
      case 'studio': return Content_menu_studio::where('content_id',$content_id)->delete(); break;
      case 'kaigi': return Content_menu_kaigi::where('content_id',$content_id)->delete(); break;
      case 'hotel': return Content_menu_hotel::where('content_id',$content_id)->delete(); break;
      case 'recruit': return Content_menu_recruit::where('content_id',$content_id)->delete(); break;
      case 'divination': return Content_menu_divination::where('content_id',$content_id)->delete(); break;
    }
  }
}






public static function getContentMenu($content_id, $service, $count, $pic, $whereIn, $find)
{

  if($pic){
    switch ($service){
      case 'food': return Content_menu_food::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'active': return Content_menu_active::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'experience': return Content_menu_experience::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'lesson': return Content_menu_lesson::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'spasalon': return Content_menu_spasalon::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'tour': return Content_menu_tour::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'ticket': return Content_menu_ticket::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'hairsalon': return Content_menu_hairsalon::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'stay': return Content_menu_stay::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'studio': return Content_menu_studio::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'kaigi': return Content_menu_kaigi::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'hotel': return Content_menu_hotel::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'recruit': return Content_menu_recruit::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
      case 'divination': return Content_menu_divination::select('id','name','pic','updated_at')->where('content_id',$content_id)->get(); break;
    }
  }elseif($find){
    switch ($service){
      case 'food': return Content_menu_food::find($find); break;
      case 'active': return Content_menu_active::find($find); break;
      case 'experience': return Content_menu_experience::find($find); break;
      case 'lesson': return Content_menu_lesson::find($find); break;
      case 'spasalon': return Content_menu_spasalon::find($find); break;
      case 'tour': return Content_menu_tour::find($find); break;
      case 'ticket': return Content_menu_ticket::find($find); break;
      case 'hairsalon': return Content_menu_hairsalon::find($find); break;
      case 'stay': return Content_menu_stay::find($find); break;
      case 'studio': return Content_menu_studio::find($find); break;
      case 'kaigi': return Content_menu_kaigi::find($find); break;
      case 'hotel': return Content_menu_hotel::find($find); break;
      case 'recruit': return Content_menu_recruit::find($find); break;
      case 'divination': return Content_menu_divination::find($find); break;
    }
  }elseif($whereIn){
    switch ($service){
      case 'food': return Content_menu_food::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'active': return Content_menu_active::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'experience': return Content_menu_experience::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'lesson': return Content_menu_lesson::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'spasalon': return Content_menu_spasalon::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'tour': return Content_menu_tour::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'ticket': return Content_menu_ticket::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'hairsalon': return Content_menu_hairsalon::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'stay': return Content_menu_stay::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'studio': return Content_menu_studio::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'kaigi': return Content_menu_kaigi::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'hotel': return Content_menu_hotel::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'recruit': return Content_menu_recruit::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
      case 'divination': return Content_menu_divination::whereIn('id',$whereIn)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->take(200)->get(); break;
    }
  }elseif($count){
    switch ($service){
      case 'food': return Content_menu_food::where('content_id',$content_id)->count(); break;
      case 'active': return Content_menu_active::where('content_id',$content_id)->count(); break;
      case 'experience': return Content_menu_experience::where('content_id',$content_id)->count(); break;
      case 'lesson': return Content_menu_lesson::where('content_id',$content_id)->count(); break;
      case 'spasalon': return Content_menu_spasalon::where('content_id',$content_id)->count(); break;
      case 'tour': return Content_menu_tour::where('content_id',$content_id)->count(); break;
      case 'ticket': return Content_menu_ticket::where('content_id',$content_id)->count(); break;
      case 'hairsalon': return Content_menu_hairsalon::where('content_id',$content_id)->count(); break;
      case 'stay': return Content_menu_stay::where('content_id',$content_id)->count(); break;
      case 'studio': return Content_menu_studio::where('content_id',$content_id)->count(); break;
      case 'kaigi': return Content_menu_kaigi::where('content_id',$content_id)->count(); break;
      case 'hotel': return Content_menu_hotel::where('content_id',$content_id)->count(); break;
      case 'recruit': return Content_menu_recruit::where('content_id',$content_id)->count(); break;
      case 'divination': return Content_menu_divination::where('content_id',$content_id)->count(); break;
    }
  }else{
    switch ($service){
      case 'food':
        if(!$data = Content_menu_food::where('content_id',$content_id)
          ->orderBy('element_number','asc')
          ->orderBy('type','desc')
          ->orderBy('name','asc')
          ->orderBy('pic','desc')
          ->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'active':
        if(!$data = Content_menu_active::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'experience':
        if(!$data = Content_menu_experience::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'lesson':
        if(!$data = Content_menu_lesson::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          [];
        }
        return $data;
        break;
      case 'spasalon':
        if(!$data = Content_menu_spasalon::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'tour':
        if(!$data = Content_menu_tour::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'ticket':
        if(!$data = Content_menu_ticket::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'hairsalon':
        if(!$data = Content_menu_hairsalon::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'stay':
        if(!$data = Content_menu_stay::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'studio':
        if(!$data = Content_menu_studio::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'kaigi':
        if(!$data = Content_menu_kaigi::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'hotel':
        if(!$data = Content_menu_hotel::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
      case 'recruit':
        if(!$data = Content_menu_recruit::where('content_id',$content_id)->first()){
          $data = [];
        }
        return $data;
        break;
      case 'divination':
        if(!$data = Content_menu_divination::where('content_id',$content_id)->orderBy('element_number','asc')->orderBy('type','desc')->orderBy('name','asc')->orderBy('pic','desc')->orderBy('updated_at','desc')->take(400)->get()){
          $data = [];
        }
        return $data;
        break;
    }
  }

}

public static function getContentStep($content_id, $service, $pic, $count, $find)
{

  if($pic){
    switch ($service){
      case 'food': return Content_step_food::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'active': return Content_step_active::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'experience': return Content_step_experience::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'lesson': return Content_step_lesson::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'spasalon': return Content_step_spasalon::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'tour': return Content_step_tour::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'ticket': return Content_step_ticket::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'hairsalon': return Content_step_hairsalon::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'stay': return Content_step_stay::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'studio': return Content_step_studio::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'kaigi': return Content_step_kaigi::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'hotel': return Content_step_hotel::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'recruit': return Content_step_recruit::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
      case 'divination': return Content_step_divination::select('id','element_number','pic','updated_at')->where('content_id',$content_id)->take(20)->get(); break;
    }
  }elseif($find){
    switch ($service){
      case 'food': return Content_step_food::find($find); break;
      case 'active': return Content_step_active::find($find); break;
      case 'experience': return Content_step_experience::find($find); break;
      case 'lesson': return Content_step_lesson::find($find); break;
      case 'spasalon': return Content_step_spasalon::find($find); break;
      case 'tour': return Content_step_tour::find($find); break;
      case 'ticket': return Content_step_ticket::find($find); break;
      case 'hairsalon': return Content_step_hairsalon::find($find); break;
      case 'stay': return Content_step_stay::find($find); break;
      case 'studio': return Content_step_studio::find($find); break;
      case 'kaigi': return Content_step_kaigi::find($find); break;
      case 'hotel': return Content_step_hotel::find($find); break;
      case 'recruit': return Content_step_recruit::find($find); break;
      case 'divination': return Content_step_divination::find($find); break;
    }
  }elseif($count){
    switch ($service){
      case 'food': return Content_step_food::where('content_id',$content_id)->count(); break;
      case 'active': return Content_step_active::where('content_id',$content_id)->count(); break;
      case 'experience': return Content_step_experience::where('content_id',$content_id)->count(); break;
      case 'lesson': return Content_step_lesson::where('content_id',$content_id)->count(); break;
      case 'spasalon': return Content_step_spasalon::where('content_id',$content_id)->count(); break;
      case 'tour': return Content_step_tour::where('content_id',$content_id)->count(); break;
      case 'ticket': return Content_step_ticket::where('content_id',$content_id)->count(); break;
      case 'hairsalon': return Content_step_hairsalon::where('content_id',$content_id)->count(); break;
      case 'stay': return Content_step_stay::where('content_id',$content_id)->count(); break;
      case 'studio': return Content_step_studio::where('content_id',$content_id)->count(); break;
      case 'kaigi': return Content_step_kaigi::where('content_id',$content_id)->count(); break;
      case 'hotel': return Content_step_hotel::where('content_id',$content_id)->get(); break;
      case 'recruit': return Content_step_recruit::where('content_id',$content_id)->count(); break;
      case 'divination': return Content_step_divination::where('content_id',$content_id)->count(); break;
    }
  }else{
    switch ($service){
      case 'food':  return Content_step_food::where('content_id',$content_id)->get(); break;
      case 'active':  return Content_step_active::where('content_id',$content_id)->get(); break;
      case 'experience':  return Content_step_experience::where('content_id',$content_id)->get(); break;
      case 'lesson':  return Content_step_lesson::where('content_id',$content_id)->get(); break;
      case 'spasalon':  return Content_step_spasalon::where('content_id',$content_id)->get(); break;
      case 'tour':  return Content_step_tour::where('content_id',$content_id)->get(); break;
      case 'ticket':  return Content_step_ticket::where('content_id',$content_id)->get(); break;
      case 'hairsalon':  return Content_step_hairsalon::where('content_id',$content_id)->get(); break;
      case 'stay':  return Content_step_stay::where('content_id',$content_id)->get(); break;
      case 'studio': return Content_step_studio::where('content_id',$content_id)->get(); break;
      case 'kaigi': return Content_step_kaigi::where('content_id',$content_id)->get(); break;
      case 'hotel': return Content_step_hotel::where('content_id',$content_id)->get(); break;
      case 'recruit': return Content_step_recruit::where('content_id',$content_id)->get(); break;
      case 'divination': return Content_step_divination::where('content_id',$content_id)->get(); break;
    }
  }

}



public static function getMenuType($service, $key)
{

  switch ($service){
    case 1  : $tag = [1=>'単品',2=>'コース']; break;
    case 2  : $tag = [1=>'単品',2=>'コース']; break;
    case 3  : $tag = [1=>'単品',2=>'コース']; break;
    case 4  : $tag = [1=>'単品',2=>'コース']; break;
    case 5  : $tag = [1=>'単品',2=>'コース']; break;
    case 6  : $tag = [1=>'単品',2=>'コース']; break;
    case 7  : $tag = [1=>'単品',2=>'コース']; break;
    case 8  : $tag = [1=>'単品',2=>'コース']; break;
    case 9  : $tag = [1=>'単品',2=>'コース']; break;
    case 10 : $tag = [1=>'単品',2=>'コース']; break;
    case 11 : $tag = [1=>'単品',2=>'コース']; break;
    case 12 : $tag = [1=>'単品',2=>'コース']; break;
    case 13 : $tag = [1=>'単品',2=>'コース']; break;
    case 14 : $tag = [1=>'単品',2=>'コース']; break;
    case 15 : $tag = [1=>'単品',2=>'コース']; break;
    case 16 : $tag = [1=>'単品',2=>'コース']; break;
    case 17 : $tag = [1=>'単品',2=>'コース']; break;
    case 18 : $tag = [1=>'単品',2=>'コース']; break;
    case 19 : $tag = [1=>'単品',2=>'コース']; break;
    case 20 : $tag = [1=>'単品',2=>'コース']; break;
    case 21 : $tag = [1=>'単品',2=>'コース']; break;
    case 22 : $tag = [1=>'単品',2=>'コース']; break;
    case 23 : $tag = [1=>'単品',2=>'コース']; break;
    case 24 : $tag = [1=>'単品',2=>'コース']; break;
    case 25 : $tag = [1=>'単品',2=>'コース']; break;
    case 26 : $tag = [1=>'単品',2=>'コース']; break;
    case 27 : $tag = [1=>'単品',2=>'コース']; break;
    case 28 : $tag = [1=>'単品',2=>'コース']; break;
    case 29 : $tag = [1=>'単品',2=>'コース']; break;
    case 30 : $tag = [1=>'単品',2=>'コース']; break;
    case 31 : $tag = [1=>'単品',2=>'コース']; break;
    case 32 : $tag = [1=>'単品',2=>'コース']; break;
    case 33 : $tag = [1=>'単品',2=>'コース']; break;
    case 34 : $tag = [1=>'単品',2=>'コース']; break;
    case 35 : $tag = [1=>'単品',2=>'コース']; break;
    case 36 : $tag = [1=>'単品',2=>'コース']; break;
    case 37 : $tag = [1=>'単品',2=>'コース']; break;
    case 38 : $tag = []; break;
    case 39 : $tag = []; break;
    case 40 : $tag = []; break;
    case 41 : $tag = []; break;
    case 42 : $tag = []; break;
    case 43 : $tag = []; break;
    case 44 : $tag = []; break;
    case 45 : $tag = []; break;
    case 46 : $tag = []; break;
    case 47 : $tag = []; break;
    case 48 : $tag = []; break;
    case 49 : $tag = []; break;
    case 50 : $tag = []; break;
    case 51 : $tag = []; break;
    case 52 : $tag = []; break;
    case 53 : $tag = []; break;
    case 54 : $tag = []; break;
    case 55 : $tag = []; break;
    case 56 : $tag = []; break;
    case 57 : $tag = []; break;
    case 58 : $tag = []; break;
    case 59 : $tag = []; break;
    case 60 : $tag = []; break;
    case 61 : $tag = []; break;
    case 62 : $tag = [1=>'趣味',2=>'スポーツ',3=>'学習',4=>'演奏',40=>'その他レッスン・学び']; break;
    case 63 : $tag = []; break;
    case 64 : $tag = []; break;
    case 65 : $tag = [1=>'マッサージ',2=>'フェイススパ',3=>'ボディスパ',4=>'フェイススパ',5=>'ヘッドスパ',9=>'その他スパメニュー']; break;
    case 66 : $tag = []; break;
    case 67 : $tag = []; break;
    case 68 : $tag = []; break;
    case 69 : $tag = []; break;
    case 70 : $tag = []; break;
    case 71 : $tag = []; break;
    case 72 : $tag = []; break;
    case 73 : $tag = []; break;
    case 74 : $tag = []; break;
    case 75 : $tag = []; break;
    case 76 : $tag = []; break;
    case 77 : $tag = [1=>'カット',2=>'カラーリング',9=>'その他美容メニュー']; break;
    case 78 : $tag = []; break;
    case 79 : $tag = []; break;
    case 80 : $tag = []; break;
    case 81 : $tag = [1=>'ディナー',2=>'ランチ',3=>'朝食',9=>'その他メニュー']; break;
    case 82 : $tag = []; break;
    case 83 : $tag = []; break;
    case 84 : $tag = []; break;
    case 85 : $tag = []; break;
    case 86 : $tag = []; break;
    case 87 : $tag = []; break;
    case 88 : $tag = []; break;
    case 89 : $tag = []; break;
    case 90 : $tag = [1=> '姓名判断',2=> '手相占い',3=> '人相占い',4=> '印相占い',5=> '夢占い',6=> '風水',7=> 'ヴァーストゥ・シャーストラ',8=> '家相',9=> '周易',10=>'六壬神課',11=>'奇門遁甲',12=>'ルーン占い',13=>'タロット占い',14=>'ジプシー占い',15=>'カード占い',16=>'水晶占い',17=>'ダウジング',18=>'御神籤',19=>'阿弥陀籤',20=>'辻占い',21=>'ジオマンシー',22=>'ポエ占い',23=>'四柱推命',24=>'紫微斗数',25=>'星座占い',26=>'占星術',27=>'西洋占星術',28=>'数秘術',29=>'九星気学',30=>'算命学',31=>'0学占い',32=>'六星占術',33=>'動物占い','その他']; break;
    case 91 : $tag = []; break;
  }
  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}




public static function getCapacityType($service, $key)
{
  switch ($service){

    case 1  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 2  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 3  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 4  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 5  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 6  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 7  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 8  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 9  : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 10 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 11 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 12 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 13 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 14 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 15 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 16 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 17 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 18 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 19 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 20 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 21 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 22 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 23 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 24 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 25 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 26 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 27 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 28 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 29 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 30 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 31 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 32 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 33 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 34 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 35 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 36 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 37 : $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷']; break;
    case 38 : $tag = []; break;
    case 39 : $tag = [1=>'ダーツ',2=>'卓球',3=>'テニス',4=>'‎ビリヤード',5=>'‎ボルダリング',6=>'‎ジム',7=>'‎プール',8=>'すべて',9=>'その他アクティブ']; break;
    case 40 : $tag = []; break;
    case 41 : $tag = []; break;
    case 42 : $tag = []; break;
    case 43 : $tag = []; break;
    case 44 : $tag = []; break;
    case 45 : $tag = []; break;
    case 46 : $tag = []; break;
    case 47 : $tag = []; break;
    case 48 : $tag = []; break;
    case 49 : $tag = []; break;
    case 50 : $tag = []; break;
    case 51 : $tag = []; break;
    case 52 : $tag = []; break;
    case 53 : $tag = []; break;
    case 54 : $tag = []; break;
    case 55 : $tag = []; break;
    case 56 : $tag = []; break;
    case 57 : $tag = []; break;
    case 58 : $tag = []; break;
    case 59 : $tag = []; break;
    case 60 : $tag = []; break;
    case 61 : $tag = []; break;
    case 62 : $tag = [1=>'趣味',2=>'演奏',3=>'スポーツ',4=>'学習',9=>'その他レッスン・学び']; break;
    case 63 : $tag = []; break;
    case 64 : $tag = []; break;
    case 65 : $tag = [1=>'マッサージ',2=>'ボディスパ',3=>'フェイススパ',4=>'ネイル',9=>'その他スパスペース']; break;
    case 66 : $tag = []; break;
    case 67 : $tag = []; break;
    case 68 : $tag = []; break;
    case 69 : $tag = []; break;
    case 70 : $tag = []; break;
    case 71 : $tag = []; break;
    case 72 : $tag = []; break;
    case 73 : $tag = []; break;
    case 74 : $tag = []; break;
    case 75 : $tag = []; break;
    case 76 : $tag = []; break;
    case 77 : $tag = [1=>'カット席',2=>'カラーリング席',3=>'カット／カラーリング兼用',9=>'その他美容スペース']; break;
    case 78 : $tag = []; break;
    case 79 : $tag = []; break;
    case 80 : $tag = []; break;
    case 81 : $tag = [1=>'宿泊ルーム',2=>'共有スペース']; break;
    case 82 : $tag = []; break;
    case 83 : $tag = []; break;
    case 84 : $tag = []; break;
    case 85 : $tag = [1=>'撮影',2=>'音楽',3=>'ライブ',4=>'キッチン',9=>'その他スタジオ']; break;
    case 86 : $tag = []; break;
    case 87 : $tag = []; break;
    case 88 : $tag = []; break;
    case 89 : $tag = []; break;
    case 90 : $tag = []; break;
    case 91 : $tag = []; break;
  }
  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}






public static function getCapacityTypeIcon($service, $key, $size)
{

  switch ($service){
    case 15:  $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷',4=>'レンタル']; break;
    case 39:  $tag = [
      1=>'<i class="icon icon-arrow-down-bold-hexagon-outline ' . $size . ' text-red-500" title="ダーツ" alt="ダーツ"></i>',
      2=>'<i class="icon icon-table ' . $size . ' text-blue-500" title="卓球" alt="卓球"></i>',
      3=>'<i class="icon icon-tennis ' . $size . ' text-teal-500" title="テニス" alt="テニス"></i>',
      4=>'<i class="icon icon-run ' . $size . ' text-yellow-500" title="ダンス" alt="ダンス"></i>',
      5=>'<i class="icon icon-seat-flat-angled ' . $size . ' text-amber-500" title="ヨガ" alt="ヨガ"></i>',
      6=>'<i class="icon icon-picture ' . $size . ' text-cyan-500" title="展覧・美術館・ミュージアム" alt="展覧・美術館・ミュージアム"></i>',
      7=>'<i class="icon icon-home-variant ' . $size . ' text-deep-purple-500" title="室内" alt="室内"></i>',
      8=>'<i class="icon icon-weather-sunny ' . $size . ' text-indigo-500" title="野外" alt="野外"></i>',
      9=>'',
    ]; break;
    case 85: $tag = [
      1=>'<i class="icon icon-camcorder-box ' . $size . ' text-grey-800" title="撮影スタジオ" alt="撮影スタジオ"></i>',
      2=>'<i class="icon icon-music-box-outline ' . $size . ' text-blue-500" title="音楽スタジオ" alt="音楽スタジオ"></i>',
      3=>'<i class="icon icon-music ' . $size . ' text-red-500" title="ライブスタジオ" alt="ライブスタジオ"></i>',
      4=>'<i class="icon icon-food ' . $size . ' text-orange-500" title="キッチンスタジオ" alt="キッチンスタジオ"></i>',
      5=>'<i class="icon icon-folder-star ' . $size . ' text-purple-500" title="その他スタジオ" alt="その他スタジオ"></i>'
    ];break;
  }
  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}






public static function getServiceTypeGobi($service, $key, $menuOrCapacity)
{

  if($menuOrCapacity==='capacity'){
    switch ($service){
      case 15:  $tag = [1=>'カウンター席',2=>'テーブル席',3=>'お座敷',4=>'レンタル']; break;
      //case 2:  $tag = [1=>'ダーツ',2=>'卓球',3=>'テニス',4=>'‎ビリヤード',5=>'‎ボルダリング',6=>'‎ジム',7=>'‎プール',9=>'その他アクティブ']; break;
      case 39:  $tag = [1=>'台',2=>'台',3=>'コート',4=>'台',5=>'名様',6=>'名様',7=>'名様',8=>'名様',9=>'名様']; break;
      //case 3:  $tag = [1=>'お仕事',2=>'美活動',3=>'趣味',4=>'演奏',5=>'スポーツ',6=>'学習',9=>'その他体験']; break;
      //case 4:  $tag = [1=>'趣味',2=>'演奏',3=>'スポーツ',4=>'学習',9=>'その他レッスン・学び']; break;
      //case 5:  $tag = [1=>'マッサージ',2=>'ボディスパ',3=>'フェイススパ',4=>'ネイル',9=>'その他スパスペース']; break;
      //case 6:  $tag = []; break;
      //case 7:  $tag = []; break;
      //case 8:  $tag = [1=>'カット席',2=>'カラーリング席',3=>'カット／カラーリング兼用',9=>'その他美容スペース']; break;
      //case 9:  $tag = []; break;
      //case 10: $tag = [1=>'撮影',2=>'音楽',3=>'ライブ',4=>'キッチン',9=>'その他スタジオ']; break;
      //case 11: $tag = []; break;
      //case 12: $tag = []; break;
    }
  }
  
  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}














public static function getContentMenuStep($content_id, $service, $menu_id, $pic, $count, $find)
{

  if($pic){
    switch ($service){
      case 'lesson': return Content_menu_step_lesson::select('id','name','pic','updated_at')->where('menu_id',$menu_id)->take(20)->get(); break;
      case 'tour': return Content_menu_step_tour::select('id','name','pic','updated_at')->where('menu_id',$menu_id)->take(20)->get(); break;
      case 'ticket': return Content_menu_step_ticket::select('id','name','pic','updated_at')->where('menu_id',$menu_id)->take(20)->get(); break;
    }
  }elseif($find){
    switch ($service){
      case 'lesson': return Content_menu_step_lesson::find($find); break;
      case 'tour': return Content_menu_step_tour::find($find); break;
      case 'ticket': return Content_menu_step_ticket::find($find); break;
    }
  }elseif($count){
    switch ($service){
      case 'lesson': return Content_menu_step_lesson::where('menu_id',$menu_id)->count(); break;
      case 'tour': return Content_menu_step_tour::where('menu_id',$menu_id)->count(); break;
      case 'ticket': return Content_menu_step_ticket::where('menu_id',$menu_id)->count(); break;
    }
  }else{
    switch ($service){
      case 'lesson': return Content_menu_step_lesson::where('menu_id',$menu_id)->get(); break;
      case 'tour': return Content_menu_step_tour::where('menu_id',$menu_id)->get(); break;
      case 'ticket': return Content_menu_step_ticket::where('menu_id',$menu_id)->get(); break;
    }
  }

}






public static function getPic($type, $back, $pic, $id, $size, $value_id)
{
  //$type = user, group, place, contents, company

  if(!$pic){
    $path = '/storage/global/img/';
    switch ($type){
      case 'user': $pic = ($back) ? 'user1_back.jpeg' : 'user1.jpeg'; break;
      case 'place_owner': $pic = ($back) ? 'company1_back.jpeg' : 'company1.jpeg'; break;
      case 'company': $pic = ($back) ? 'company1_back.jpeg' : 'company1.jpeg'; break;
      case 'recommend': return null; break;
      case 'place': $pic = ($back) ? 'place1_back.jpeg' : 'place1.jpeg'; break;
      default: return null;
    }
  }else{
    switch ($type){
      case 'user': $path = '/storage/uploads/users/' . $id . '/'; break;
      case 'place_owner': $path = '/storage/uploads/users/' . $id . '/place/' . $value_id . '/'; break;
      case 'company': $path = '/storage/uploads/users/' . $id . '/company/'; break;
      case 'recommend': $path = '/storage/uploads/users/' . $id . '/recommend/' . $value_id . '/'; break;
      case 'place': $path = '/storage/uploads/contents/' . $id . '/place/'; break;
      default: return null;
    }
  }

  $pos = strrpos($pic, '.');
  $pic = ($pos) ? substr($pic, 0, $pos).'_'.$size.substr($pic, $pos) : $pic.'_'.$size;
  return $path . $pic;

}


public static function getPicLicense($size)
{

  $type = [
    1 =>'active',
    2 =>'capa_active',
    3 =>'capa_divination',
    4 =>'capa_experience',
    5 =>'capa_food',
    6 =>'capa_hairsalon',
    7 =>'capa_hotel',
    8 =>'capa_kaigi',
    9 =>'capa_lesson',
    10=>'capa_spasalon',
    11=>'capa_stay',
    12=>'capa_studio',
    13=>'capa_ticket',
    14=>'capa_tour',
    15=>'company',
    16=>'content',
    17=>'divination',
    18=>'experience',
    19=>'food',
    20=>'hairsalon',
    21=>'hotel',
    22=>'kaigi',
    23=>'lesson',
    24=>'spasalon',
    25=>'stay',
    26=>'studio',
    27=>'ticket',
    28=>'tour',
    29=>'company',
    30=>'place',
    31=>'uranai'
  ];
  
  $path = '/storage/global/img/';
  $pic=$type[rand( 1, 31 )].'1'.'.jpeg';
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}

public static function getAnswerNumber($key)
{

  switch ($key){
    case 0: return 'ア'; break;
    case 1: return 'イ'; break;
    case 2: return 'ウ'; break;
    case 3: return 'エ'; break;
    case 4: return 'オ'; break;
    case 5: return 'カ'; break;
    case 6: return 'キ'; break;
    case 7: return 'ク'; break;
  }
  return '';

}


public static function getPicLicenseQuestionFigure($pic, $license_id, $license_question_id, $size=null)
{

  if(!$pic){
    return null;
  }else{
    $path = '/storage/uploads/license/' . $license_id . '/question/'. $license_question_id . '/';
  }
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}

public static function getPicLicenseQuestionThemeFigure($pic, $license_id, $license_question_theme_id, $size=null)
{

  if(!$pic){
    return null;
  }else{
    $path = '/storage/uploads/license/' . $license_id . '/question/theme/'. $license_question_theme_id . '/';
  }
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}

public static function getPicLicenseQuestionContentsFigure($pic, $license_id, $license_question_id, $license_question_contents_id, $size=null)
{

  if(!$pic){
    return null;
  }else{
    $path = '/storage/uploads/license/' . $license_id . '/question/' . $license_question_id . '/contents/' . $license_question_contents_id . '/';
  }
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}

public static function getPicContent($type, $back, $pic, $id, $size)
{

  if(!$pic){
    $path = '/storage/global/img/';
    if($back){
      $pic=$type . rand( 1, 10 ) . '.jpeg';
    }else{
      $pic=$type . rand( 1, 10 ) . '.jpeg';
    }
  }else{
    $path = '/storage/uploads/contents/' . $id . '/';
  }
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}




public static function getPicMenu($type, $back, $pic, $content_id, $size, $menu_id)
{

  if(!$pic){
    $path = '/storage/global/img/';
    //$number = rand( 1, 4 );
    $number = 1;
    if($back){
      $pic=$type . $number . '_back_pic.jpeg';
    }else{
      $pic=$type . $number . '.jpeg';
    }
  }else{
    $path = '/storage/uploads/contents/' . $content_id . '/menu/' . $menu_id . '/';
  }
  if($size){
    $pos = strrpos($pic, '.');
    if ($pos){
      $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
    }else{
      $pic = $pic.'_'.$size;
    }
  }

  $pic = $path . $pic;
  return $pic;

}

public static function getPicCapa($type, $back, $pic, $id, $size, $second_id)
{
  if($type==='capa'){
    if(!$pic){
      $path = '/storage/global/img/';
      if($back){
        $pic='content1_back_pic.jpeg';
      }else{
        $pic='content1_pic.jpeg';
      }
    }else{
      $path = '/storage/uploads/contents/' . $id .  '/capacity/' . $second_id . '/';
    }
    if($size){
      $pos = strrpos($pic, '.');
      if ($pos){
        $pic = substr($pic, 0, $pos).'_'.$size.substr($pic, $pos);
      }else{
        $pic = $pic.'_'.$size;
      }
    }
  }else{
    return;
  }
  $pic = $path . $pic;
  return $pic;

}

public static function getDayJp($time)
{
  
  $time    = new DateTime($time);
  $current = new DateTime('now');
  $DT_time = new DateTime($time->format('Y-m-d 00:00:00'));
  $DT_current = new DateTime($current->format('Y-m-d 00:00:00'));
  $diff    = $DT_current->diff($DT_time);
  
  if($diff->days===0){
    return '本日';
  }elseif($diff->days===1){
    return '明日';
  }elseif($diff->days===2){
    return '明後日';
  }else{
    return $time->format('m/d');
  }
  return '';

}




public static function getOverTimeJp($time)
{
  $time    = new DateTime($time);
  $current = new DateTime('now');
  $diff    = $current->diff($time);

  if($diff->y){ return $diff->y . '年前';}
  if($diff->m){ return $diff->m . 'ヶ月前';}
  if($diff->d>1){ return $diff->d . '日前';}
  if($diff->d===1){ return '昨日';}
  if($diff->h){ return $diff->h . '時間前';}
  if($diff->i>1){ return $diff->i . '分前';}
  return 'さっき';
}


public static function Stay_days_jp($start_time, $end_time)
{

    $start_day = date("Y-m-d", strtotime($start_time));
    $end_day =   date("Y-m-d", strtotime($end_time));
    $start_hour =date("H", strtotime($start_time));
    $end_hour =  date("H", strtotime($end_time));
    
    // 日付をUNIXタイムスタンプに変換
    $timestamp1 = strtotime($start_day);
    $timestamp2 = strtotime($end_day);
    
    // 何秒離れているかを計算
    $seconddiff = abs($timestamp2 - $timestamp1);
    
    // 日数に変換
    $days = $seconddiff / (60 * 60 * 24);

    //all hour fun
    $all_hour = 24*$days+$end_hour-$start_hour;
    
    if($all_hour < 6){       return '半日';
    }elseif($all_hour < 18){ return '一日';
    }elseif($all_hour < 42){ return '1泊';
    }elseif($all_hour < 66){ return '2泊';
    }elseif($all_hour < 90){ return '3泊';
    }elseif($all_hour < 114){return '4泊';
    }elseif($all_hour < 138){return '5泊';
    }elseif($all_hour < 162){return '6泊';
    }elseif($all_hour < 186){return '7泊';
    }elseif($all_hour < 210){return '8泊';
    }elseif($all_hour < 234){return '9泊';
    }elseif($all_hour < 258){return '10泊';
    }elseif($all_hour < 282){return '11泊';
    }elseif($all_hour < 306){return '12泊';
    }elseif($all_hour < 330){return '13泊';
    }elseif($all_hour < 354){return '14泊';
    }elseif($all_hour < 378){return '15泊';
    }elseif($all_hour < 402){return '16泊';
    }elseif($all_hour < 426){return '17泊';
    }elseif($all_hour < 450){return '18泊';
    }elseif($all_hour < 474){return '19泊';
    }elseif($all_hour < 498){return '20泊';
    }elseif($all_hour < 522){return '21泊';
    }elseif($all_hour < 546){return '22泊';
    }elseif($all_hour < 570){return '23泊';
    }elseif($all_hour < 594){return '24泊';
    }elseif($all_hour < 618){return '25泊';
    }elseif($all_hour < 642){return '26泊';
    }elseif($all_hour < 666){return '27泊';
    }elseif($all_hour < 690){return '28泊';
    }elseif($all_hour < 714){return '29泊';
    }elseif($all_hour < 738){return '30泊';
    }elseif($all_hour < 738){return '31泊';
    }else{            return '数ヶ月';
    }
}








public static function Stay_days($start_time, $end_time){

    $start_day = date("Y-m-d", strtotime($start_time));
    $end_day =   date("Y-m-d", strtotime($end_time));
    $start_hour =date("H", strtotime($start_time));
    $end_hour =  date("H", strtotime($end_time));
    
    // 日付をUNIXタイムスタンプに変換
    $timestamp1 = strtotime($start_day);
    $timestamp2 = strtotime($end_day);
    
    // 何秒離れているかを計算
    $seconddiff = abs($timestamp2 - $timestamp1);
    
    // 日数に変換
    $days = $seconddiff / (60 * 60 * 24);

    //all hour fun
    $all_hour = 24*$days+$end_hour-$start_hour;
    
    return $all_hour/24;

}







//GPSなどの緯度経度の２点間の直線距離を求める（世界測地系）
//$lat1, $lon1 --- A地点の緯度経度
//$lat2, $lon2 --- B地点の緯度経度
public static function location_distance($lat1, $lon1, $lat2, $lon2){
	$lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );//２点の緯度の平均
	$lat_difference = deg2rad( $lat1 - $lat2 );//２点の緯度差
	$lon_difference = deg2rad( $lon1 - $lon2 );//２点の経度差
	$curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
	$meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
	$prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径
	
	//２点間の距離
	$distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
	$distance = sqrt($distance);
	
	$distance_unit = round($distance);
	if($distance_unit < 1000){//1000m以下ならメートル表記
		$distance_unit = $distance_unit."m";
	}else{//1000m以上ならkm表記
		$distance_unit = round($distance_unit / 100);
		$distance_unit = ($distance_unit / 10)."km";
	}
	
	//$hoge['distance']で小数点付きの直線距離を返す（メートル）
	//$hoge['distance_unit']で整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以下は小数点第一位以上の数をkmで記述 例：2.8km）
	return array("distance" => $distance, "distance_unit" => $distance_unit);

}
//$hoge=location_distance($lat1, $lon1, $lat2, $lon2);
//$hoge[distance]が小数点付きの直線距離を返します（メートル単位）。
//$hoge[distance_unit]が整形された直線距離を返す（1000m以下ならメートルで記述 例：836m ｜ 1000m以上は小数点第一位以上の数をkmで記述 例：2.8km）






public static function recommend_star($point, $size)
{
  $star = '';
  if($point<0.3){
   $star='<i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=0.3 && $point<0.7){
   $star='<i class="f' . $size . ' icon-star-half text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=0.7 && $point<1.3){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=1.3 && $point<1.7){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-half text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=1.7 && $point<2.3){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=2.3 && $point<2.7){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-half text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=2.7 && $point<3.3){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=3.3 && $point<3.7){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-half text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=3.7 && $point<4.3){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-outline text-amber-600"></i>';
  }else if($point>=4.3 && $point<4.7){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star-half text-amber-600"></i>';
  }else if($point>=4.7){
   $star='<i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i><i class="f' . $size . ' icon-star text-amber-600"></i>';
  }
  return $star;
}




//pointBonus
public static function  pointBonus($table, $id, $type)
{
  /*
    $table === content or recommend
    $id === id
    $type === good or bad
  */
  if($table==='content'){
    $key = 'content_id';
  }else{
    $key = 'recommend_id';
  }
  $point_sum = DB::table($table.'_'.$type)
    ->where($key, $id)
    ->sum('point');
  if($table==='content'){$table = 'contents';}
  DB::table($table)
    ->where('id', $id)
    ->update([ $type . '_number'=>$point_sum ]);
  return $point_sum;
  /*
  if($good_number===10){
    $val = ['point'=>$good_number, 'content_id'=>$content_id, 'name'=>$good_number . 'ナイプラ達成ボーナス', 'add'=>10,  'good_number'=> $good_number+10];
  }elseif($good_number===50){
    $val = ['point'=>$good_number, 'content_id'=>$content_id, 'name'=>$good_number . 'ナイプラ達成ボーナス', 'add'=>50,  'good_number'=> $good_number+50];
  }elseif($good_number===200){
    $val = ['point'=>$good_number, 'content_id'=>$content_id, 'name'=>$good_number . 'ナイプラ達成ボーナス', 'add'=>100, 'good_number'=> $good_number+100];
  }elseif($good_number===500){
    $val = ['point'=>$good_number, 'content_id'=>$content_id, 'name'=>$good_number . 'ナイプラ達成ボーナス', 'add'=>250, 'good_number'=> $good_number+250];
  }elseif($good_number%1000===0){
    $val = ['point'=>$good_number, 'content_id'=>$content_id, 'name'=>$good_number . 'ナイプラ達成ボーナス', 'add'=>500, 'good_number'=> $good_number+500];
  }else{
    $val = null;
  }
  if($val){
    $this->niceBonusMail($val);
    if($ans = DB::table('content'.'_good')
      ->select('point')
      ->where('content_id', $content_id)
      ->where('user_id', 1)
      ->first())
    {
      $finallyAdminPoint = $ans['point']+$val['add'];
      DB::table('content'.'_good')
        ->where('content_id', $content_id)
        ->where('user_id', 1)
        ->update([ 'point'=>$finallyAdminPoint ]);
    }else{
      DB::table('content'.'_good')
        ->insert(['content_id'=>$content_id, 'user_id' => 1, 'point' => $val['add'] ]);
    }
    Contents::where('id', $content_id)
      ->update([ 'good_number'=>$val['good_number'] ]);
    return $val['good_number'];
  }else{
    Contents::where('id', $content_id)
      ->update([ 'good_number'=>$good_number ]);
    return $good_number;
  }
  */
}


/*
Jan
Feb
Mar
Apr
May
Jun
Jul
Aug
Sep
Oct
Nov
Dec
*/

public static function monthClassNameReturn(){
  switch (date('m')){
    case '01': return 'Jan'; break;
    case '02': return 'Feb'; break;
    case '03': return 'Mar'; break;
    case '04': return 'Apr'; break;
    case '05': return 'May'; break;
    case '06': return 'Jun'; break;
    case '07': return 'Jul'; break;
    case '08': return 'Aug'; break;
    case '09': return 'Sep'; break;
    case '10': return 'Oct'; break;
    case '11': return 'Nov'; break;
    case '12': return 'Dec'; break;
  }
}

public static function truncateHeaderName($str,$type)
{

  if(!$str) return '';
  //英語only max 28, multbyte Only max 18
  //22 間とって。

  if($type==='pc'){
    if(!preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $str)) { //日本語のみ
      $num = 10;
    }elseif(strlen($str) === mb_strlen($str, "UTF-8")){ //英語のみ
      $num = 22;
    }else{ //混合
      $num = 12;
    }
  }elseif($type==='smartphone'){
    if(!preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $str)) { //日本語のみ
      $num = 13;
    }elseif(strlen($str) === mb_strlen($str, "UTF-8")){ //英語のみ
      $num = 23;
    }else{ //混合
      $num = 15;
    }
  }else{ //page
    if(!preg_match("/(?:\xEF\xBD[\xA1-\xBF]|\xEF\xBE[\x80-\x9F])|[\x20-\x7E]/", $str)) { //日本語のみ
      $num = 18;
    }elseif(strlen($str) === mb_strlen($str, "UTF-8")){ //英語のみ
      $num = 28;
    }else{ //混合
      $num = 20;
    }
  }

  //logger($num);

  if(mb_strlen($str) <= $num){
    return $str;
  }else{
    $tmp = $str;
    $tmp = Util::insertStr2($tmp, '\n', $num);
    //logger($tmp);
    $exp = explode('\n',$tmp);
    //logger($exp);

    if( $ans = mb_strrpos($exp[0],'　') ){
      //logger('aru: ' . $ans);
    }elseif( $ans = mb_strrpos($exp[0],' ') ){
      //logger('hankaku space aru: ' . $ans);
    }else{
      //logger('nai');
      $ans = $num;
    }
    $str = Util::insertStr2($str,'\n',$ans);
  }

  $str = explode('\n',$str);
  
  if(mb_strlen($str[1]) <= $num){
    return $str[0] . '<br />' . $str[1];
  }else{
    $tmp = Util::insertStr2($str[1],'\n',$num);
    $tmp = explode('\n',$tmp);
    return $str[0] . '<br />' . $tmp[0] . '...';
  }

}

public static function insertStr($str, $add, $num){
  return substr($str, 0, $num).$add.substr($str, $num, strlen($str));
}
public static function insertStr2($str, $add, $num){
  return preg_replace("/^.{0,$num}+\K/us", $add, $str);
}





public static function getWhatDaytime($start, $end)
{

  $start   = new DateTime($start);
  $end     = new DateTime($end);
  $current = new DateTime('now');
  $diff    = $current->diff($start);
  return ( $end <= $current ) ? ['done'=>1,'days'=>$diff->days, 'hour'=>$diff->h] : ['done'=>0,'days'=>$diff->days, 'hour'=>$diff->h];

}




public static function getPlaceTypeList($key,$type)
{

  if($type==="name"){
    $tag = [
      'world_heritage'                        =>   '世界遺産',
      'country'                               =>   '国',
      'accounting'                            =>   '会計',
      'airport'                               =>   '空港',
      'amusement_park'                        =>   '遊園地',
      'aquarium'                              =>   '水族館',
      'art_gallery'                           =>   '芸術展覧',
      'atm'                                   =>   '気圧',
      'bakery'                                =>   'ベーカリー',
      'bank'                                  =>   '銀行',
      'bar'                                   =>   'バー',
      'beauty_salon'                          =>   'ビューティーサロン',
      'bicycle_store'                         =>   '自転車',
      'book_store'                            =>   '本屋',
      'bowling_alley'                         =>   'ボーリング場',
      'bus_station'                           =>   'バス停',
      'cafe'                                  =>   'カフェ',
      'campground'                            =>   'キャンプ場',
      'car dealer'                            =>   '車ディーラー',
      'car_rental'                            =>   'レンタカー',
      'car_repair'                            =>   '自動車修理',
      'car_wash'                              =>   '洗車',
      'casino'                                =>   'カジノ',
      'cemetery'                              =>   '墓地',
      'church'                                =>   '教会',
      'city_hall'                             =>   '市役所',
      'clothing_store'                        =>   '洋服店',
      'convenience_store'                     =>   'コンビニ',
      'courthouse'                            =>   '裁判所',
      'dentist'                               =>   '歯科医',
      'department_store'                      =>   'デパート',
      'doctor'                                =>   '医師',
      'electrician'                           =>   '電気技師',
      'electronics store'                     =>   '電器店',
      'embassy'                               =>   '大使館',
      'establishment'                         =>   '施設',
      'finance'                               =>   'ファイナンス',
      'fire_station'                          =>   '消防署',
      'florist'                               =>   '花屋',
      'food'                                  =>   'フード',
      'funeral_home'                          =>   '葬儀場',
      'furniture_store'                       =>   '家具屋',
      'gas_station'                           =>   'ガソリンスタンド',
      'general_contractor'                    =>   'ゼネコン',
      'grocery_or_supermarket'                =>   'スーパーマーケット',
      'gym'                                   =>   'ジム',
      'hair_care'                             =>   'ヘアケア',
      'hardware_store'                        =>   'ホームセンター',
      'health'                                =>   '健康',
      'hindu_temple'                          =>   'ヒンドゥー寺院',
      'home_goods_store'                      =>   '家庭用品店',
      'hospital'                              =>   '病院',
      'insurance_agency'                      =>   '保険代理店',
      'jewelry_store'                         =>   '宝石店',
      'laundry'                               =>   'ランドリー',
      'lawyer'                                =>   '弁護士',
      'library'                               =>   '図書館',
      'liquor_store'                          =>   '酒屋',
      'local_government_office'               =>   '市町村役場',
      'locksmith'                             =>   '錠前屋',
      'lodging'                               =>   '宿泊',
      'meal_delivery'                         =>   'フード配達',
      'meal_takeaway'                         =>   'フードテイクアウト',
      'mosque'                                =>   'イスラム教礼拝堂',
      'movie_rental'                          =>   '映画レンタル',
      'movie_theater'                         =>   '映画館',
      'moving_company'                        =>   '引っ越し会社',
      'museum'                                =>   '博物館',
      'night_club'                            =>   'ナイトクラブ',
      'painter'                               =>   '画家',
      'park'                                  =>   'パーク',
      'parking'                               =>   'パーキング',
      'pet_store'                             =>   'ペットショップ',
      'pharmacy'                              =>   '薬局',
      'physiotherapist'                       =>   '理学療法士',
      'place_of_worship'                      =>   '礼拝所',
      'plumber'                               =>   '配管工',
      'police'                                =>   '警察',
      'post_office'                           =>   '郵便局',
      'real_estate_agency'                    =>   '不動産会社',
      'restaurant'                            =>   'レストラン',
      'roofing_contractor'                    =>   '屋根業者',
      'rv_park'                               =>   'RVパーク(キャンピングカー専用滞在施設)',
      'school'                                =>   '学校',
      'shoe_store'                            =>   '靴屋',
      'shopping_mall'                         =>   'ショッピングモール',
      'spa'                                   =>   'スパ',
      'stadium'                               =>   'スタジアム',
      'storage'                               =>   'ストレージ',
      'store'                                 =>   '倉庫',
      'subway_station'                        =>   '地下鉄',
      'synagogue'                             =>   'ユダヤ教会堂',
      'taxi_stand'                            =>   'タクシー乗り場',
      'train_station'                         =>   '鉄道駅',
      'travel_agency'                         =>   '旅行会社',
      'university'                            =>   '大学',
      'veterinary_care'                       =>   '獣医医療',
      'zoo'                                   =>   '動物園'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }

  return '';

}









public static function getContentServices($key,$type,$size)
{

  //$type = key or name or desc
  if($type==='key'){
    $tag = [
      1 => 'food',
      2 => 'active',
      //3 => 'experience',
      4 => 'lesson',
      5 => 'spasalon',
      6 => 'tour',
      7 => 'ticket',
      8 => 'hairsalon',
      9 => 'stay',
      10=> 'studio',
      11=> 'kaigi',
      //12=> 'hotel',
      13=> 'recruit',
      14=> 'divination'
    ];
  }elseif($type==='name'){
    $tag = [
      1 => '飲食店・レストラン',
      2 => 'レジャー・スポーツ・アクティブ',
      //3 => '体験',
      4 => 'スクール・レッスン',
      5 => 'スパ・エステ',
      6 => 'ツアー',
      7 => 'チケット',
      8 => 'ヘアーサロン・美容院',
      9 => '旅館・ホテル',
      10=> 'スタジオ',
      11=> '会議室',
      //12=> 'レンタルホテル'
      13=> '求人',
      14=> '占い'
    ];
  }elseif($type==='golistTitle'){
    $tag = [
      1 => '所在地',
      2 => '所在地',
      //3 => '所在地',
      4 => '所在地',
      5 => '所在地',
      6 => '目的地',
      7 => '開催地',
      8 => '所在地',
      9 => '所在地',
      10=> '所在地',
      11=> '所在地',
      //12=> '所在地'
      13=> '所在地',
      14=> '所在地'
    ];
  }elseif($type==='capacityFooterButton'){
    $tag = [
      1 => 'テーブル',
      2 => 'アクティブスペース',
      //3 => '体験スペース',
      4 => 'レッスンスペース',
      5 => '施術スペース',
      6 => '行先リスト',
      7 => '開催地',
      8 => '施術席',
      9 => 'お部屋',
      10=> 'スタジオ',
      11=> '会議室',
      //12=> '所在地'
      13=> '面接ルーム',
      14=> '占いルーム'
    ];
  }elseif($type==='icon'){
    $a1  = '<i class="icon icon-food-fork-drink ' . $size . ' text-deep-orange-900" title="飲食店" alt="飲食店"></i>';
    $a2  = '<i class="icon icon-run ' . $size . ' text-purple-500" title="アクティブ" alt="アクティブ"></i>';
    //$a3  = '<i class="icon icon-weather-night ' . $size . ' text-purple-500" title="アクティブ" alt="アクティブ"></i>';
    $a4  = '<i class="icon icon-library ' . $size . ' text-blue-900" title="スクール" alt="スクール"></i>';
    $a5  = '<i class="icon icon-lamp ' . $size . ' text-yellow-700" title="美容・スパサロン" alt="美容・スパサロン"></i>';
    $a6  = '<i class="icon icon-gondola ' . $size . ' text-green-700" title="ツアー" alt="ツアー"></i>';
    $a7  = '<i class="icon icon-ticket-star ' . $size . ' text-pink-900" title="チケット" alt="チケット"></i>';
    $a8  = '<i class="icon icon-content-cut ' . $size . ' text-brown-900" title="ヘアーサロン" alt="ヘアーサロン"></i>';
    $a9  = '<i class="icon icon-home-modern ' . $size . ' text-indigo-900" title="旅館・ホテル" alt="旅館・ホテル"></i>';
    $a10 = '<i class="icon icon-movie ' . $size . ' text-red-900" title="スタジオ" alt="スタジオ"></i>';
    $a11 = '<i class="icon icon-store ' . $size . ' text-green-900" title="会議室" alt="会議室"></i>';
    //$a12 = '<i class="icon icon-castle ' . $size . ' text-purple-900" title="レンタルホテル" alt="レンタルホテル"></i>';
    $a13 = '<i class="icon icon-person-box ' . $size . ' text-cyan-700" title="面接" alt="面接"></i>';
    $a14 = '<i class="icon icon-account-search ' . $size . ' text-teal-600" title="占い" alt="占い"></i>';
    $tag = [
      1 => $a1,
      2 => $a2,
      //3 => $a3,
      4 => $a4,
      5 => $a5,
      6 => $a6,
      7 => $a7,
      8 => $a8,
      9 => $a9,
      10=> $a10,
      11=> $a11,
      //12=> $a12,
      13=> $a13,
      14=> $a14
    ];
  }elseif('desc'){
    $tag = [
      1 => '飲食店: 和食、寿司、魚介・海鮮料理、そば（蕎麦）、うどん、うなぎ、焼き鳥、とんかつ、串揚げ、天ぷら、お好み焼き、もんじゃ焼、しゃぶしゃぶ、沖縄料理、洋食、フレンチ、イタリアン、スペイン料理、パスタ、ピザ、ステーキ、ハンバーグ、ハンバーガー、中華料理、餃子、韓国料理、タイ料理、ラーメン、カレー、焼肉、ホルモン、鍋、もつ鍋、居酒屋、バイキング、カフェ、パン、スイーツ、バー・お酒',
      2 => 'アクティブ: ダーツ、卓球、テニス、‎ビリヤード、ボルダリング、ジム、プール、その他アクティブ',
      //3 => '体験: お仕事、美活動、趣味、演奏、スポーツ、学習、その他体験',
      4 => 'スクール・レッスン: 趣味、演奏、スポーツ、学習、その他レッスン・スクール',
      5 => 'エステ・スパ: マッサージ、ボディスパ、フェイススパ、ネイル、メンズ可、駅近、駐車場有',
      6 => '旅行ツアー: 人気スポット、世界遺産、観光、大自然(山・川・海)、ビーチリゾート、スキーリゾート、温泉、ご当地グルメ、展覧・美術館・ミュージアム、お城・寺・教会、水族館・動物園・遊園地・植物園、体験スポット',
      7 => 'チケット: 音楽、演劇・ミュージカル、スポーツ、展覧会、イベント、その他チケット',
      8 => '美容院: カット専門、カラーリング専門、美容院、理容院、駅近、駐車場有',
      9 => '旅館、ホテル宿泊: 温泉、リゾート、朝食付き、ビジネス、駅近',
      10=> 'スタジオ: フォトスタジオ、音楽スタジオ、ライブスタジオ、駅近、駐車場有',
      11=> '会議室: 駅近、駐車場有',
      13=> '求人面接: 求人面接',
      14=> '占い'
    ];
  }

  if(is_null($key)){
    return $tag;
  }elseif($key>=0){
    if(isset($tag[$key])){
      return $tag[$key];
    }
  }
  
  return '';

}





}

