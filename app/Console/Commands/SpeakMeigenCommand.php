<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use UtilSpeak;
use DB;

class SpeakMeigenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:speakMeigen';

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
            ->take(300)
            ->get()
        ){
            return 1;
        }
        
        foreach($rss_speak_list as $rss){

            if(rand(1, 20) !== 5) continue;

            $meigen = DB::table('meigen')->select('person','speak')->inRandomOrder()->first();
            $person = UtilSpeak::getMeigenPerson($meigen->person);
            DB::table('rss_messages')->insert([
                'rss_id'=>$rss->id,
                'message'=>$meigen->speak . ' by ' . $person,
                'created_at' => date("Y-m-d H:i:s")
            ]);

        }

        $this->info('end');

    }
}
