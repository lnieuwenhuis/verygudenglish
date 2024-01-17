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
            ['title' => 'lijst1'],
            ['title' => 'lijst2'],
            ['title' => 'lijst3'],
            ['title' => 'lijst4'],
            ['title' => 'lijst5'],
        ];

        foreach ($lists as $list) {
            WordList::create($list);
        }
    }
}
