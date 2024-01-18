<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'type' => 'student', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'type' => 'student', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'type' => 'student', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'type' => 'student', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'type' => 'student', 'remember_token' => 'true'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
