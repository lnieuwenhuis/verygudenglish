<?php

namespace Database\Seeders;

use App\Models\Result;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $results = [
            ['title' => 'Test 1', 'period_id' => 1, 'wordlist_id' => 1, 'student_id' => 1, 'result' => 100],
            ['title' => 'Test 2', 'period_id' => 2, 'wordlist_id' => 2, 'student_id' => 2, 'result' => 80],
            ['title' => 'Test 3', 'period_id' => 3, 'wordlist_id' => 3, 'student_id' => 3, 'result' => 60],
            ['title' => 'Test 4', 'period_id' => 4, 'wordlist_id' => 4, 'student_id' => 4, 'result' => 40],
        ];

        foreach ($results as $result) {
            Result::create($result);
        }
    }
}
