<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendNewBlogEmail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new SendNewBlogEmail());
    }
}
