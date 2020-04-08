<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;

class SpeakAICommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:speakAI';

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

        $this->info('start');
        
        //$rsss = UtilSpeak::rssCompanies(null);
        
        $now = new \DateTime(date("Y-m-d H:i:s"));
        $before_hour = $now->modify('-3 hours');     
        $before_hour_time = $before_hour->format('Y-m-d H:i:s');

        if(
            !$rss_speak_list = Rss::where('created_at','>',$before_hour_time)
            ->select('id','title')
            ->take(100)
            ->get()
        ){
            return 1;
        }

        mb_internal_encoding("UTF-8"); 
        mb_regex_encoding("UTF-8"); 
        
        foreach($rss_speak_list as $rss){

            if(rand(1, 5) === 2) continue;
            $token = []; 
            //logger($rss->title);
            $str = $rss->title;
            //preg_match_all('/[一-龠]+/', $rss->title, $match);
            //mb_ereg("[一-龠]+", $rss->title, $match);
            while(1){ 
                $bytes = mb_ereg("[一-龠]+|[ぁ-んー]+|[ァ-ヶー]+", $str, $match); 
                if ($bytes == FALSE) { 
                    break; 
                } else { 
                    $match = $match[0]; 
                    array_push($token, $match); 
                } 
                $pos = strpos($str, $match); 
                $str = substr($str, $pos+$bytes); 
            } 
            //logger($token);
            $kidoairaku_key = null;
            foreach($token as $val){
              if($kidoairaku_key = DB::table('kidoairaku_keys')->select('type','key')->where('key','=',$val)->first()){
                    //logger('same: '.$val);
                    break;
              }
            }
            if(!$kidoairaku_key){
                continue;
            }
            $kidoairaku_word = DB::table('kidoairaku_words')->select('speak')->where('type',$kidoairaku_key->type)->inRandomOrder()->first();
            
            DB::table('rss_messages')->insert([
                'rss_id'=>$rss->id,
                'message'=>$kidoairaku_word->speak,
                'created_at' => date("Y-m-d H:i:s")
            ]);

        }

        $this->info('end');

    }
}
