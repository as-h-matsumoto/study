<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;
use phpQuery;

class ITownFgetLessonCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_itown_lesson';

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

      $proxy_list = UtilSpeak::getProxyList();

        $this->info('get all itown lesson start');
        
        $shops = [];
        $shop_urls = [];
        $ken_urls = [];
        $city_urls = [];
        $town_urls = [];
  
        
        $url = 'https://itp.ne.jp/genre_dir/lesson/?ngr=1&num=50';
        for($i = 0; $i < 20; $i++) {
         //logger('try');
          $use_ipaddress = $proxy_list[rand(1, 60)];
          $content = UtilSpeak::tryFget($url,$use_ipaddress);
          if($content) break;
        }
        if(!$content){
         //logger('try 20 and none, so exit');
          exit;
        }

        $doc = phpQuery::newDocument($content['desc_data']);
        foreach ($doc->find("ul.list-link-01 li") as $link){
          $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
          if(strpos($tmp_url, 'javascript')!==false) continue;
          $tmp_url = str_replace('&nad=1', '', $tmp_url);
          $tmp_url = str_replace('&sr=1', '', $tmp_url);
          $tmp_url = str_replace('&evdc=1', '', $tmp_url);
          $ken_urls[] = $tmp_url;
        }
       //logger($ken_urls);
        

        $skip_ken_first = true;
        $skip_city_first = true;
        $skip_sscity_first = true;
        $skip_town_first = true;

        //
        // ken
        //
        $skip_ken = true;
        foreach($ken_urls as $ken_url){

          if($skip_ken_first){
            ///tokyo/13112/13112055/13112055001
            if(strpos($ken_url, 'tokyo')!==false){
              $skip_ken = false;
              $skip_ken_first = false;
            }
            if($skip_ken){
             //logger('skip_ken');
              continue;
            }
          }

          for($i = 0; $i < 20; $i++) {
           //logger('try ken: '.$ken_url);
            $use_ipaddress = $proxy_list[rand(1, 60)];
            $content = UtilSpeak::tryFget('https://itp.ne.jp'.$ken_url,$use_ipaddress);
            if($content) break;
          }
          if(!$content){
           //logger('try 20 and none ken, so exit');
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
         //logger($cities_urls);



          //
          // city
          //
          $skip_city = true;
          foreach($cities_urls as $city_url){
  
            if($skip_city_first){
              ///tokyo/13112/13112055/13112055001
              if(strpos($city_url, '13112')!==false){
                $skip_city = false;
                $skip_city_first = false;
              }
              if($skip_city){
               //logger('skip_city');
                continue;
              }
            }
            
            for($i = 0; $i < 20; $i++) {
             //logger('try city: '.$city_url);
              $use_ipaddress = $proxy_list[rand(1, 60)];
              $content = UtilSpeak::tryFget('https://itp.ne.jp'.$city_url,$use_ipaddress);
              if($content) break;
            }
            if(!$content){
             //logger('try 20 and none city, so exit');
              exit;
            }
    
            $sscities_urls = [];
            $doc = phpQuery::newDocument($content['desc_data']);
            foreach ($doc->find("ul.list-link-01 li") as $link){
              $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
              if(strpos($tmp_url, 'javascript')!==false) continue;
              $sscities_urls[] = pq($link)->find("a:eq(0)")->attr("href");
            }
           //logger($sscities_urls);
  

            //
            // sscity
            //
            $skip_sscity = true;
            foreach($sscities_urls as $sscity_url){
    
              if($skip_sscity_first){
                ///tokyo/13112/13112055/13112055001
                if(strpos($sscity_url, '13112055')!==false){
                  $skip_sscity = false;
                  $skip_sscity_first = false;
                }
                if($skip_sscity){
                 //logger('skip_sscity');
                  continue;
                }
              }

              for($i = 0; $i < 20; $i++) {
               //logger('try sscity: '.$sscity_url);
                $use_ipaddress = $proxy_list[rand(1, 60)];
                $content = UtilSpeak::tryFget('https://itp.ne.jp'.$sscity_url,$use_ipaddress);
                if($content) break;
              }
              if(!$content){
               //logger('try 20 and none sscity, so exit');
                exit;
              }
      
              $town_urls = [];
              $doc = phpQuery::newDocument($content['desc_data']);
              foreach ($doc->find("ul.list-link-01 li") as $link){
                $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
                if(strpos($tmp_url, 'javascript')!==false) continue;
                $town_urls[] = pq($link)->find("a:eq(0)")->attr("href");
              }
             //logger($town_urls);
  
              //
              // town
              //
              $skip_town = true;
              foreach($town_urls as $town_url){

                if($skip_town_first){
                  ///tokyo/13112/13112055/13112055001
                  if(strpos($town_url, '13112055001')!==false){
                    $skip_town = false;
                    $skip_town_first = false;
                  }
                  if($skip_town){
                   //logger('skip_town');
                    continue;
                  }
                }
      
                $current_flug = false;
                $next_access_page = false;
                $page_urls = [];
                $first_town = true;
                
                //
                //page access
                //
                $skip_page = true;
                while(true){

                  $skip_page = false;
                  if($skip_page) continue;

                  if($first_town) $next_access_page = $town_url;
                  $first_town = false;

                  for($i = 0; $i < 20; $i++) {
                   //logger('try town: '.$town_url);
                    $use_ipaddress = $proxy_list[rand(1, 60)];
                    $content = UtilSpeak::tryFget('https://itp.ne.jp'.$next_access_page,$use_ipaddress);
                    if($content) break;
                  }
                  if(!$content){
                   //logger('try 20 and none town, so exit');
                    exit;
                  }

                  $doc = phpQuery::newDocument($content['desc_data']);
                  foreach ($doc->find("article") as $article){
                    $shop_urls[] = pq($article)->find("a:eq(0)")->attr("href");
                    //echo pq($a)->text() . "<br>"; // a要素の中のテキストを取得して表示
                  }
                  foreach($shop_urls as $shop_url){
                    if(strpos($shop_url, '?')!==false){
                      $tmp = explode('?',$shop_url);
                      $shop_url = $tmp[0];
                    }
                    if($check_itown_url = DB::table('itownpage')->select('id')->where('itown_url','=',$shop_url)->first()){
                       //logger('found same url');
                        continue;
                    }
                    $url_shop_desc = 'https://itp.ne.jp'.$shop_url.'shop';
                    
                    for($i = 0; $i < 20; $i++) {
                     //logger('try shop desc: '.$shop_url);
                      $use_ipaddress = $proxy_list[rand(1, 60)];
                      $content = UtilSpeak::tryFget($url_shop_desc,$use_ipaddress);
                      if($content) break;
                    }
                    if(!$content){
                     //logger('try 20 and none shop desc, so exit');
                      exit;
                    }

                    $content_desc = phpQuery::newDocument($content['desc_data']);
                    if(!isset($content['desc_header'][0])){
                     //logger('none set header');
                      continue;
                    }

                    $ans_insert = UtilSpeak::InsertItownpage($content_desc,$content['desc_header'],$shop_url);
                   //logger($ans_insert['message']);

                  }

                  
                  //search next page
                  $current_flug = false;
                  $next_access_page = false;
                  foreach ($doc->find("div.bottomNav ul li") as $link){
                    if($current_flug){
                      $next_access_page = pq($link)->find("a:eq(0)")->attr("href");
                      break;
                    }
                    $tmp_url = pq($link)->find("a:eq(0)")->attr("href");
                    if(strpos($tmp_url, 'javascript')!==false){
                      $current_flug = true;
                      continue;
                    }
                  }
                  if($next_access_page){
                   //logger($next_access_page);
                  }else{
                   //logger('none next page done break');
                    break;
                  }

                }
    
              }
  
            }

          }

        }
                   

        $this->info('itown get end');

    }
}
