<?php

namespace App\Console\Commands;

use App\Model\Login_log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Cron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//php artisan cron:clear
    protected $signature = 'Cron:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron';

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
        Log::info(date('H:i:s'));
        Log::info('开始执行清理登录空log');
        Login_log::clear();
        Log::info('执行完成');
    }
}
