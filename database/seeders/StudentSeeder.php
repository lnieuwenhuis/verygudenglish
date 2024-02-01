<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'group' => 'SD22', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'group' => 'SD23', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'group' => 'EX22', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'group' => 'EX23', 'remember_token' => 'true'],
            ['name' => Str::random('10'), 'email' => Str::random('10'), 'password' => Hash::make('password'), 'group' => 'SD22', 'remember_token' => 'true'],
        ];

        foreach ($users as $user) {
            Student::create($user);
        }
    }
}
