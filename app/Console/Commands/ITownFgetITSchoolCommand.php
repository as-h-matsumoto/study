<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;
use phpQuery;

class ITownFgetITSchoolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_itown_itschool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

/*
https://itp.ne.jp/genre_dir/1633/?evdc=1&num=20&ngr=1&sr=1
コンピュータースクール

https://itp.ne.jp/genre_dir/sports/?evdc=1&num=20&ngr=1&sr=1
スポーツクラブ（6889）
スポーツ教室（2780）
スイミング教室（2272）
空手（1811）
テニス教室（1302）
ゴルフ教室（930）
体操教室（772）
キックボクシングジム（203）
フットサルクラブ（157）
リズム教室（78）
バドミントンクラブ（47）
野球クラブ（43）
バレーボール教室（21）
スノーボードクラブ（21）
スノースポーツクラブ（16）
カンフー道場（14）
アーチェリークラブ（12）
トライアスロンクラブ（11）
サイクリングクラブ（11）
レスリングクラブ（10）
スケートクラブ（9）
ソフトボールクラブ（8）
ゲートボールクラブ（5）
フェンシングクラブ（3）
インラインスケートクラブ（3）
ケイビングクラブ（2）

https://itp.ne.jp/genre_dir/musicschool/?evdc=1&num=20&ngr=1&sr=1
音楽教室（7197）
ピアノ教室（5586）
ギター教室（1764）
バイオリン教室（1670）
フルート教室（1324）
声楽教室（1023）
ボイストレーニング教室（322）
チェロ教室（122）
大正琴教室（72）
作曲教室（56）
デスクトップミュージック教室（31）
小うた教室（30）
マリンバ教室（29）

https://itp.ne.jp/genre_dir/4331/?evdc=1&num=20&ngr=1&sr=1
フィットネスクラブ（3690）
ヨガ教室（1515）
加圧トレーニング（275）
ピラティス教室（257）
ホットヨガ教室（166）
フリークライミングクラブ（108）
ビリヤードクラブ（100）
ダーツクラブ（53）
レーシングカートクラブ（39）
スカイスポーツクラブ（23）
スポーツカートクラブ（19）
マウンテンバイククラブ（16）
登山クラブ（12）
スカイダイビングクラブ（8）
ハンググライダークラブ（8）
ハイキングクラブ（6）
航海トレーニング（4）


https://itp.ne.jp/genre_dir/171/?evdc=1&num=20&ngr=1&sr=1
着付（46479）
ダンス教室（3358）
バレエ教室（2339）
フラワーデザイン（2033）
カルチャーセンター（2027）
着付教室（2013）
フラワーデザイン教室（1895）
社交ダンス教室（1876）
ダイビングスクール（1482）
クラシックバレエ教室（1469）
絵画教室（1349）
陶芸教室（1077）
日本舞踊（988）
料理教室（915）
ジャズダンス教室（670）
手芸教室（647）
ヒップホップ教室（629）
囲碁教室（430）
モダンバレエ教室（309）
家庭料理教室（281）
菓子教室（276）
フラメンコ教室（269）
マージャン教室（186）
話し方教室（169）
占い教室（145）
マナー教室（133）
日本料理教室（130）
タップダンス教室（117）
パン教室（111）
イタリア料理教室（107）
中国料理教室（97）
フランス料理教室（96）
アクセサリー教室（90）
工芸教室（82）
ペン字教室（71）
押し花教室（71）
そば打ち教室（58）
舞踏教室（48）
画塾（45）
トールペインティング教室
フィッシングクラブ（20）
香道教授所（14）
エアラインスクール（13）
七宝焼教室（12）
フォークダンス教室（11）
ポーセリンペインティング教室（8）
バーテンダー教室（5）
喫茶教室（5）
韓国舞踊教室（3）
*/


      $proxy_list = UtilSpeak::getProxyList();

      $getTypes = ['1633'];

      foreach($getTypes as $getType){

        $this->info('get all itown itschool start');
        
        $shops = [];
        $shop_urls = [];
        $ken_urls = [];
        $city_urls = [];
        $town_urls = [];
  
        $url = 'https://itp.ne.jp/genre_dir/'.$getType.'/?ngr=1&num=50';
        for($i = 0; $i < 20; $i++) {
          $use_ipaddress = $proxy_list[rand(1, 50)];
          logger('try : '. $use_ipaddress);
          $content = UtilSpeak::tryFget($url,$use_ipaddress);
          if($content) break;
        }
        if(!$content){
          logger('try 20 and none, so exit');
          exit;
        }

        $doc = phpQuery::newDocument($content['desc_data']);
        foreach ($doc->find("ul.list-link-01 li") as $link){
          $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
          if(strpos($tmp_url, 'javascript')!==false) continue;
          $tmp_url = str_replace('&nad=1', '', $tmp_url);
          $tmp_url = str_replace('&sr=1', '', $tmp_url);
          $tmp_url = str_replace('&sr=1', '', $tmp_url);
          $tmp_url = str_replace('&sr=1', '', $tmp_url);
          $tmp_url = str_replace('&evdc=1', '', $tmp_url);
          $ken_urls[] = $tmp_url;
        }
        logger($ken_urls);

        
        

        $skip_ken_first = true;
        $skip_city_first = true;
        $skip_sscity_first = true;
        $skip_town_first = true;

        //
        // ken
        //
        $skip_ken = true;
        foreach($ken_urls as $ken_url){

          /*
          //if($getType==3795){
            ///chiba/12233/genre_dir/lovehotel/?ngr=1&num=50  
            if($skip_ken_first){  
              if(strpos($ken_url, 'chiba')!==false){
                $skip_ken = false;
                $skip_ken_first = false;
              }
              if($skip_ken){
                logger('skip_ken');
                continue;
              }
            }

          //}
          //*/

          for($i = 0; $i < 20; $i++) {
            $use_ipaddress = $proxy_list[rand(1, 50)];
            logger('try ken: '.$ken_url. ', useadd: '. $use_ipaddress);
            $content = UtilSpeak::tryFget('https://itp.ne.jp'.$ken_url,$use_ipaddress);
            if($content) break;
          }
          if(!$content){
            logger('try 20 and none ken, so exit');
            exit;
          }
          
          $cities_urls = [];
          $doc = phpQuery::newDocument($content['desc_data']);
          foreach ($doc->find("ul.list-link-01 li") as $link){
            $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
            if(strpos($tmp_url, 'javascript')!==false) continue;
            $tmp_url = str_replace('&nad=1', '', $tmp_url);
            $tmp_url = str_replace('&sr=1', '', $tmp_url);
            $tmp_url = str_replace('&evdc=1', '', $tmp_url);
            $cities_urls[] = $tmp_url;
          }
          logger($cities_urls);
          if(!$cities_urls){
            logger('none cities_urls, try getShopsDesc ken_url');
            UtilSpeak::getShopsDesc($ken_url,$proxy_list);
            continue;
          }



          //
          // city
          //
          $skip_city = true;
          foreach($cities_urls as $city_url){
  
            /*
            //if($getType==3795){
              //chiba/12233/genre_dir/lovehotel/?ngr=1&num=50  
              if($skip_city_first){
                if(strpos($city_url, '12233')!==false){
                  $skip_city = false;
                  $skip_city_first = false;
                }
                if($skip_city){
                  logger('skip_city');
                  continue;
                }
              }
            //}
            //*/
            
            for($i = 0; $i < 20; $i++) {
              $use_ipaddress = $proxy_list[rand(1, 50)];
              logger('try city: '.$city_url. ', useadd: '. $use_ipaddress);
              $content = UtilSpeak::tryFget('https://itp.ne.jp'.$city_url,$use_ipaddress);
              if($content) break;
            }
            if(!$content){
              logger('try 20 and none city, so exit');
              exit;
            }
    
            $sscities_urls = [];
            $doc = phpQuery::newDocument($content['desc_data']);
            foreach ($doc->find("ul.list-link-01 li") as $link){
              $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
              if(strpos($tmp_url, 'javascript')!==false) continue;
              $sscities_urls[] = pq($link)->find("a:eq(0)")->attr("href");
            }
            logger($sscities_urls);
            if(!$sscities_urls){
              logger('none sscities_urls, try getShopsDesc city_url');
              UtilSpeak::getShopsDesc($city_url,$proxy_list);
              continue;
            }
  

            //
            // sscity
            //
            $skip_sscity = true;
            foreach($sscities_urls as $sscity_url){
    
              /*
              if($getType==3795){
                ////oita/44201/44201108/44201108003/genre_dir/3795/?ngr=1&num=50&nad=1&sr=1
                if($skip_sscity_first){
                  if(strpos($sscity_url, '23105')!==false){
                    $skip_sscity = false;
                    $skip_sscity_first = false;
                  }
                  if($skip_sscity){
                     logger('skip_sscity');
                    continue;
                  }
                }
              }
              //*/

              for($i = 0; $i < 20; $i++) {
                $use_ipaddress = $proxy_list[rand(1, 50)];
                logger('try sscity: '.$sscity_url. ', useadd: '. $use_ipaddress);
                $content = UtilSpeak::tryFget('https://itp.ne.jp'.$sscity_url,$use_ipaddress);
                if($content) break;
              }
              if(!$content){
                logger('try 20 and none sscity, so exit');
                exit;
              }
      
              $town_urls = [];
              $doc = phpQuery::newDocument($content['desc_data']);
              foreach ($doc->find("ul.list-link-01 li") as $link){
                $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
                if(strpos($tmp_url, 'javascript')!==false) continue;
                $town_urls[] = pq($link)->find("a:eq(0)")->attr("href");
              }
              logger($town_urls);
              if(!$town_urls){
                logger('none town_urls, try getShopsDesc sscity_url');
                UtilSpeak::getShopsDesc($sscity_url,$proxy_list);
                continue;
              }
  
              //
              // town
              //
              $skip_town = true;
              foreach($town_urls as $town_url){

                UtilSpeak::getShopsDesc($town_url,$proxy_list);
    
              }
  
            }

          }

        }
                   

        $this->info('itown get hotel end');

      }

    }
}
