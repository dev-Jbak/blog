<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Post;
use Mail;
use App\Mail\SendBlogPosts;

class SendNewBlogEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $posts = Post::whereNull('emailed_at');

        Mail::to('admin@local.com')
            ->send(new SendBlogPosts($posts->select('title')->get()));

        $posts->update([
            'emailed_at' => now()
        ]);
    }
}




