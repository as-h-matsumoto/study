<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;
use phpQuery;

class ITownFgetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_itown';

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

        $this->info('itown get start');
        
        $shops = [];
        $shop_urls = [];
        
        $itownAreaNames = [
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

        $itownAreaIds = [
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

        $proxy_list = [
            1=>'tcp://140.227.31.245:3129',
            2=>'tcp://140.227.53.72:3129',
            3=>'tcp://140.227.69.54:3128',
            4=>'tcp://140.227.68.82:3128',
            5=>'tcp://140.227.70.51:3128',
            6=>'tcp://140.227.71.55:3128',
            7=>'tcp://140.227.79.52:3128',
            8=>'tcp://140.227.74.7:3128',
            9=>'tcp://140.227.80.50:3128',
            10=>'tcp://140.227.82.51:3128',
            11=>'tcp://140.227.78.54:3128',
            12=>'tcp://140.227.81.53:3128',
            13=>'tcp://153.222.84.148:3128',
            14=>'tcp://27.133.130.156:3128',
            15=>'tcp://140.227.8.115:3129',
            16=>'tcp://140.227.33.133:3129',
            17=>'tcp://140.227.10.230:3129',
            18=>'tcp://140.227.30.127:3129',
            19=>'tcp://192.244.104.105:3129',
            20=>'tcp://192.244.104.50:3129',
            21=>'tcp://192.244.99.128:3129',
            22=>'tcp://140.227.9.20:3129',
            23=>'tcp://140.227.30.97:3129',
            24=>'tcp://140.227.10.47:3129',
            25=>'tcp://192.244.104.55:3129',
            26=>'tcp://140.227.32.11:3129',
            27=>'tcp://140.227.11.219:3129',
            28=>'tcp://140.227.8.116:3129',
            29=>'tcp://140.227.69.92:3129',
            30=>'tcp://160.16.113.52:60088',
            31=>'tcp://160.16.201.57:60088',
            32=>'tcp://160.16.219.177:60088',
            33=>'tcp://163.43.28.172:60088',
            34=>'tcp://163.43.28.199:60088',
            35=>'tcp://163.43.29.93:60088',
            36=>'tcp://163.43.30.191:60088',
            37=>'tcp://163.43.30.200:60088',
            38=>'tcp://163.43.30.42:60088',
            39=>'tcp://163.43.31.107:60088',
            40=>'tcp://163.43.31.194:60088',
            41=>'tcp://27.133.132.80:60088',
            42=>'tcp://27.133.153.227:60088',
            43=>'tcp://27.133.155.162:60088',
            44=>'tcp://27.133.155.225:60088',
            45=>'tcp://59.106.209.106:60088',
            46=>'tcp://59.106.210.192:60088',
            47=>'tcp://59.106.213.216:60088',
            48=>'tcp://59.106.213.54:60088',
            49=>'tcp://59.106.213.57:60088',
            50=>'tcp://59.106.216.142:60088',
            51=>'tcp://59.106.216.158:60088',
            52=>'tcp://59.106.218.188:60088',
            53=>'tcp://59.106.220.187:60088',
            54=>'tcp://59.106.222.74:60088',
            55=>'tcp://59.106.223.171:60088',
            56=>'tcp://59.106.223.57:60088',
            57=>'tcp://59.106.218.101:60088',
            58=>'tcp://59.106.217.16:60088',
            59=>'tcp://163.43.30.69:60088',
            60=>'tcp://163.43.28.30:60088'          
          ];

        //家のＰＣでもやる場合は逆から実施
        //$itownAreaNames = array_reverse($itownAreaNames, true);





        
        foreach($itownAreaNames as $area_key=>$area_name){
        
          $ken_id = $itownAreaIds[$area_key];
          $cities = DB::table('city_address')->select('city_id')->where('ken_id',$ken_id)->get();
      
          $count = 1;
          foreach($cities as $city){
      
            if(mb_strlen($city->city_id) == 4){
              $city_id = '0'.$city->city_id;
            }else{
              $city_id = $city->city_id;
            }
            if(mb_strlen($count) == 1){
              $town_id = '00'.$count;
            }elseif(mb_strlen($count) == 2){
              $town_id = '0'.$count;
            }elseif(mb_strlen($count) == 3){
              $town_id = (string)$count;
            }
            $town_id = $city_id.$town_id;
            $count++;
      
            $page_number = 1;
            $first13101001 = true;
            
            while(true){
      
              if($town_id == '13101001'){
                  if($first13101001){
                    $page_number = 10;
                    $first13101001 = false;
                  }
              }
      
              $itonw_url = 'https://itp.ne.jp/'.$area_key.'/'.$city_id.'/'.$town_id.'/genre_dir/pg/'.$page_number.'/?ngr=1&nad=1&sr=1&evdc=1&sr=1&num=50';
             //logger($itonw_url);

              stream_context_set_default(
                array(
                 'http' => array(
                  'proxy' => $proxy_list[rand(1, 60)],
                  'request_fulluri' => true
                 )
                )
              );
              try{
                $content = file_get_contents($itonw_url, false);
              }catch(\Exception $e){
                //logger($e);
                continue;
              }
              
      
              if(strpos($content,'申し訳ございません。') !== false){
                break 1;
              }
              if(strpos($content,'ご指定のページは一時的に利用できない') !== false){
                break 2;
              }
      
              $doc = phpQuery::newDocument($content);
              foreach ($doc->find("article") as $article){
                $shop_urls[] = pq($article)->find("a:eq(0)")->attr("href");
                //echo pq($a)->text() . "<br>"; // a要素の中のテキストを取得して表示
              }
                      
              foreach($shop_urls as $shop_url){
      
                $name = '';
                $address = '';
                $tell = '';
                $bussiness_type = '';
                $homepage = '';
                $itown_url = '';
                $fax = '';
                $paing = '';
                $parking = '';
                $email = '';
      
                if(strpos($shop_url, '?')!==false){
                  $tmp = explode('?',$shop_url);
                  $shop_url = $tmp[0];
                }
                $url_shop_desc = 'https://itp.ne.jp'.$shop_url.'shop';
                if($check_itown_url = DB::table('itownpage')->select('id')->where('itown_url','=',$shop_url)->first()){
                   //logger('found same url');
                    continue;
                }

               //logger($url_shop_desc);
                stream_context_set_default(
                    array(
                     'http' => array(
                      'proxy' => $proxy_list[rand(1, 60)],
                      'request_fulluri' => true
                     )
                    )
                );
                try{
                    $doc = file_get_contents($url_shop_desc, false);
                }catch(\Exception $e){
                   //logger('exception continue');
                    continue;
                }
                $content_desc = phpQuery::newDocument($doc);
                if(!isset($http_response_header[0])){
                   //logger('none set header');
                    continue;
                }
                
                if(strpos($http_response_header[0],'302') !== false){
                  $name = $content_desc['div#popupWrapper']->find('h1:eq(0)')->text();
                  foreach($content_desc['table.detailTable']->find('tr') as $tr){
                    $title = pq($tr)->find('th')->text();
                    switch ($title){
                      case '住所': $address = pq($tr)->find('td')->text(); break;
                      case 'TEL': $tell = pq($tr)->find('td')->text(); break;
                      case '業種': $bussiness_type = pq($tr)->find('td')->text(); break;
                      case 'ホームページ': $homepage = pq($tr)->find('td')->text(); break;
                    }
                  }
                }else{
                  foreach($content_desc['article.item-table']->find('dl') as $dl){
                    $title = pq($dl)->find('dt')->text();
                    switch ($title){
                      case '掲載名':   $name = pq($dl)->find('dd')->text(); break;
                      case '電話番号': $tell = pq($dl)->find('dd')->find('p:eq(0)')->text(); break;
                      case 'FAX番号':  $fax = pq($dl)->find('dd')->text(); break;
                      case '駐車場':   $parking = pq($dl)->find('dd')->find('p:eq(0)')->text(); break;
                      case '住所':     $address = pq($dl)->find('dd')->find('p:eq(0)')->text(); break;
                      case '現金以外の支払い方法': $paing = pq($dl)->find('dd')->find('p:eq(0)')->text(); break;
                      case 'ホームページ':   $homepage = pq($dl)->find('dd')->find('a:eq(0)')->attr("href"); break;
                      case 'E-mailアドレス': $email = pq($dl)->find('dd')->find('a:eq(0)')->attr("href"); break;
                      case '業種': $bussiness_type = pq($dl)->find('dd')->text(); break;
                    }
                  }
                }

                if( !($tell and $name and $address) ){
                   //logger('none name or tell or address');
                    continue;
                }else{
                    $name = trim($name);
                    $tell = trim($tell);
                    $address = trim($address);
                }
                if($bussiness_type) $bussiness_type = trim($bussiness_type);
                if($fax) $fax = trim($fax);
                if($paing) $paing = trim($paing);
                if($parking) $parking = trim($parking);
                if($email) $email = trim($email);

                //  <!-- F専 / (代) / F兼 / Q2 / (＃) -->
                if(strpos($tell, "F専")!==false){
                    $fax_in = false;
          
                    if($check_itown_content = DB::table('itownpage')
                      ->where('name','=',$name)
                      ->where('address','=',$address)
                      ->first()
                    ){
                        if(!$check_itown_content->fax){
                           //logger('add only fax');
                            $fax_in = true;
                            $fax = str_replace("F専", '', $tell);
                            DB::table('itownpage')->where('id',$check_itown_content->id)->update(['fax'=>$fax]);
                        }
                    }
                    if($fax_in){
                       //logger('add only fax');
                    }else{
                       //logger('add only fax none');
                    }
                    continue;
            
                }
                if( strpos($tell, "(代)")!==false ) $tell = str_replace("(代)", '', $tell);
                if( strpos($tell, "F兼")!==false ) $tell = str_replace("F兼", '', $tell);
                if( strpos($tell, "Q2")!==false ) $tell = str_replace("Q2", '', $tell);
                if( strpos($tell, "(＃)")!==false ) $tell = str_replace("(＃)", '', $tell);
                
                if($check_itown_content = DB::table('itownpage')
                    ->where('name','=',$name)
                    ->where('address','=',$address)
                    ->first()
                ){
                   //logger('found the same content');
                    continue;
                }
        
                DB::table('itownpage')->insert([
                  'name'=>$name,
                  'city_id'=>$city_id,
                  'bussiness_type'=>$bussiness_type,
                  'tell'=>$tell,
                  'fax'=>$fax,
                  'parking'=>$parking,
                  'paing'=>$paing,
                  'email'=>$email,
                  'homepage'=>$homepage,
                  'itown_url'=>$shop_url,
                  'address'=>$address,
                  'updated_at' => date("Y-m-d H:i:s")
                ]);

                sleep(1);
        
              }
      
              $page_number++;
            
            }
             
          }
                                  
        }                       

        $this->info('itown get end');

    }
}
