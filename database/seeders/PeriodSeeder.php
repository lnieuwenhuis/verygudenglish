<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            ['title' => 'Periode 1', 'is_locked' => '1'],
            ['title' => 'Periode 2', 'is_locked' => '0'],
            ['title' => 'Periode 3', 'is_locked' => '0'],
            ['title' => 'Periode 4', 'is_locked' => '1']
        ];

        foreach ($periods as $period) {
            Period::create($period);
        }
    }
}
