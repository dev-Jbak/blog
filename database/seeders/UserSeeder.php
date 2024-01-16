<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@local.com',
                'password' => 'password'
            ],
            [
                'name' => 'User1',
                'email' => 'user1@local.com',
                'password' => 'password'
            ],
            [
                'name' => 'User2',
                'email' => 'user2@local.com',
                'password' => 'password'
            ],
        ];

        foreach($users as $user) {
            User::factory($user)
                ->create();
        }
    }
}
