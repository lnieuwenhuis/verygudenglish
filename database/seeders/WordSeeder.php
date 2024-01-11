<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            ['word' => 'netwerkbeheerder', 'answer' => 'network administrator'],
            ['word' => 'ict-beheerder', 'answer' => 'ICT administrator / IT administrator'],
            ['word' => 'ict-medewerker', 'answer' => 'ICT assistant / IT assistant'],
            ['word' => 'applicatieontwikkelaar', 'answer' => 'application developer'],
            ['word' => 'een bedrijf bezoeken', 'answer' => 'visit a company'],
            ['word' => 'plaatsnemen', 'answer' => 'take a seat'],
            ['word' => 'een formulier invullen', 'answer' => 'fill in a form / complete a form'],
            ['word' => 'afdeling', 'answer' => 'department'],
            ['word' => 'receptiebalie', 'answer' => 'reception desk'],
            ['word' => 'buitenlandse gast', 'answer' => 'foreign visitor/guest'],
        ];
    }
}
