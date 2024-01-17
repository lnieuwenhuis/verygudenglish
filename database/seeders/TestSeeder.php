<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = [
            ['title' => 'Test 1', 'period_id' => 1],
            ['title' => 'Test 2', 'period_id' => 2],
            ['title' => 'Test 3', 'period_id' => 3],
            ['title' => 'Test 4', 'period_id' => 4],
        ];

        foreach ($tests as $test) {
            Test::create($test);
        }
    }
}
