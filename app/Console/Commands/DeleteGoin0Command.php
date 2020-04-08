<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\models\Content_date_users;

use DB;

class DeleteGoin0Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteGoin0';

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

        logger('deleteGoin0 start');

        Content_date_users::where('goin',0)->where('created_at','<',date("Y-m-d H:i:s",strtotime("-3 hour")))->delete();

        logger('deleteGoin0 end');

    }
}
