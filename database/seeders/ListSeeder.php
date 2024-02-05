<?php

namespace Database\Seeders;

use App\Models\WordList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lists = [
            ['title' => 'lijst1', 'period_id' => 1],
            ['title' => 'lijst2', 'period_id' => 1],
            ['title' => 'lijst3', 'period_id' => 2],
            ['title' => 'lijst4', 'period_id' => 3],
            ['title' => 'lijst5', 'period_id' => 4],
        ];

        foreach ($lists as $list) {
            WordList::create($list);
        }
    }
}
