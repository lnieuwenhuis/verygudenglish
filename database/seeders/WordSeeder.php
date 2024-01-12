<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
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
            ['words' => 'netwerkbeheerder', 'answers' => 'network administrator'],
            ['words' => 'ict-beheerder', 'answers' => 'ICT administrator / IT administrator'],
            ['words' => 'ict-medewerker', 'answers' => 'ICT assistant / IT assistant'],
            ['words' => 'applicatieontwikkelaar', 'answers' => 'application developer'],
            ['words' => 'een bedrijf bezoeken', 'answers' => 'visit a company'],
            ['words' => 'plaatsnemen', 'answers' => 'take a seat'],
            ['words' => 'een formulier invullen', 'answers' => 'fill in a form / complete a form'],
            ['words' => 'afdeling', 'answers' => 'department'],
            ['words' => 'receptiebalie', 'answers' => 'reception desk'],
            ['words' => 'buitenlandse gast', 'answers' => 'foreign visitor/guest'],
        ];

        foreach ($words as $word) {
            Word::create($word);
        }
    }
}
