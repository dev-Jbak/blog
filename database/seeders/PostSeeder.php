<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::get('id');

        foreach($users as $user) {
            foreach(range(1, 30) as $count) {
                Post::factory()
                    ->create([
                        'user_id' => $users->random()
                    ]);
            }
        }
    }
}
