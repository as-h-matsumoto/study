<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;
use phpQuery;

class HakushoGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_hakusho';

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

        $this->info('hakusho get start');
        
        $content = file_get_contents('/Users/matsumoto/Desktop/111.html', false);
        print_r($content);
        exit;
        $doc = phpQuery::newDocument($content);
        foreach ($doc->find("article") as $article){
          $shop_urls[] = pq($article)->find("a:eq(0)")->attr("href");
          //echo pq($a)->text() . "<br>"; // a要素の中のテキストを取得して表示
        }

        /*
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
        */

        $this->info('itown get end');

    }
}
