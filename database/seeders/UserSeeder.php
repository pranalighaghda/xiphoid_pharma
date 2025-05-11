<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($users as $user) {
            $existingUser = User::where('email', $user['email'])->first();

            if (!$existingUser) {
                User::create($user);
            }
        }
    }
}