<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\models\Rss;
use UtilSpeak;

class CoordiyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:get_rss';

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
        
        $rsss = UtilSpeak::rssCompanies(null);

        foreach( $rsss as $company=>$rss ){

            if($time = Rss::where('company',$company)->select('created_at')->orderBy('created_at','desc')->first()){
                $old = new \DateTime($time->created_at);
            }else{
                $old = null;
            }
            $feed = \Feeds::make($rss['url']);
            //$file_get_contents = file_get_contents($rss['url'], false);
            //logger($file_get_contents);
            //continue;
            //logger($feed->get_items());
            foreach($feed->get_items() as $item){

                if($old){
                    $current = new \DateTime($item->get_date('Y-m-d H:i:s'));
                    if($old >= $current){
                        //logger('black in');
                        break;
                    }
                }

                //logger($old->format('Y-m-d H:i:s'));
                //logger($current->format('Y-m-d H:i:s'));
                //logger($item->get_title());

                $rss = new Rss;
                $rss->company = $company;
                $rss->link = $item->get_link();
                $rss->title = $item->get_title();
                $rss->description = $item->get_description();
                $rss->created_at = $item->get_date('Y-m-d H:i:s');
                $rss->save();
                //logger($rss->id);

            }

        }

        $this->info('end');

    }
}
