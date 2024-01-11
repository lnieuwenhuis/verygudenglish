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
            ['title' => Str::random('5'), 'is_locked' => '1'],
            ['title' => Str::random('5'), 'is_locked' => '0'],
            ['title' => Str::random('5'), 'is_locked' => '0'],
            ['title' => Str::random('5'), 'is_locked' => '1']
        ];

        foreach ($periods as $period) {
            Period::create($period);
        }
    }
}
