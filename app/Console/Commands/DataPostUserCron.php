<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PostsApiController;
use App\Http\Controllers\UsersApiController;

class DataPostUserCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dataPostUser:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extrae informacion de post y usuarios de apis externas y las ingresa a la BD';

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
     * @return int
     */
    public function handle()
    {
        echo "----------------INICIO INSERT POST--------------------".PHP_EOL;   
        PostsApiController::insertPost();
        echo "----------------FIN  INSERT POST--------------------".PHP_EOL;  
        echo "----------------INICIO INSERT USUARIOS--------------------".PHP_EOL;  
        UsersApiController::insertUser();
        echo "----------------FIN INSERT USUARIOS--------------------".PHP_EOL;    
        return 0;
    }
}
