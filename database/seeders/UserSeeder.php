<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'data' => [
                    'name' => 'Admin',
                    'email' => 'admin@local.com',
                    'password' => 'password',
                ],
                'roles' => ['admin']
            ],
            [
                'data' => [
                    'name' => 'User1',
                    'email' => 'user1@local.com',
                    'password' => 'password',
                ],
                'roles' => []
            ],
            [
                'data' => [
                    'name' => 'User2',
                    'email' => 'user2@local.com',
                    'password' => 'password',
                ],
                'roles' => []
            ],
        ];

        foreach($users as $user) {
            $user = User::factory($user['data'])
                ->create()
                ->syncRoles($user['roles']);
        }
    }
}
