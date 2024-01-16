<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::get('id');
        $posts = Post::get('id');

        foreach($posts as $post) {
            foreach(range(1, 3) as $count) {
                Comment::factory()
                    ->create([
                        'post_id' => $post,
                        'user_id' => $users->random()
                    ]);
            }
        }
    }
}
