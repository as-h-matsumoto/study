<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;
use phpQuery;

class ITownFgetStudioCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_itown_studio';

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

      $getTypes = [3795];

      foreach($getTypes as $getType){



        $this->info('get all itown studio start');
        
        $shops = [];
        $shop_urls = [];
        $ken_urls = [];
        $city_urls = [];
        $town_urls = [];
  
        
        $url = 'https://itp.ne.jp/genre_dir/'.$getType.'/?ngr=1&num=50';
        for($i = 0; $i < 20; $i++) {
          logger('try');
          $use_ipaddress = $proxy_list[rand(1, 29)];
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

          ///*
          if($getType==3795){
            /////saitama/11202/11202058/genre_dir/3795/?ngr=1&num=50&nad=1&sr=1
            if($skip_ken_first){  
              if(strpos($ken_url, 'saitama')!==false){
                $skip_ken = false;
                $skip_ken_first = false;
              }
              if($skip_ken){
                logger('skip_ken');
                continue;
              }
            }

          }
          //*/

          for($i = 0; $i < 20; $i++) {
            logger('try ken: '.$ken_url);
            $use_ipaddress = $proxy_list[rand(1, 29)];
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
  
            ///*
            if($getType==3795){
              //saitama/11202/11202058/genre_dir/3795/?ngr=1&num=50&nad=1&sr=1
              if($skip_city_first){
                if(strpos($city_url, '11202')!==false){
                  $skip_city = false;
                  $skip_city_first = false;
                }
                if($skip_city){
                  logger('skip_city');
                  continue;
                }
              }
            }
            //*/
            
            for($i = 0; $i < 20; $i++) {
              logger('try city: '.$city_url);
              $use_ipaddress = $proxy_list[rand(1, 29)];
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
                logger('try sscity: '.$sscity_url);
                $use_ipaddress = $proxy_list[rand(1, 29)];
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
                   

        $this->info('itown get end');

      }

    }
}
