<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PeriodSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ListSeeder::class);
        $this->call(WordSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(DocentSeeder::class);
        $this->call(ResultSeeder::class);
    }
}
