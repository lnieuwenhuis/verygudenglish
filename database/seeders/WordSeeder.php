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
            ['words' => 'netwerkbeheerder', 'answers' => 'network administrator', 'list_id' => 1],
            ['words' => 'ict-beheerder', 'answers' => 'ICT administrator / IT administrator', 'list_id' => 1],
            ['words' => 'ict-medewerker', 'answers' => 'ICT assistant / IT assistant', 'list_id' => 2],
            ['words' => 'applicatieontwikkelaar', 'answers' => 'application developer', 'list_id' => 2],
            ['words' => 'een bedrijf bezoeken', 'answers' => 'visit a company', 'list_id' => 3],
            ['words' => 'plaatsnemen', 'answers' => 'take a seat', 'list_id' => 3],
            ['words' => 'een formulier invullen', 'answers' => 'fill in a form / complete a form', 'list_id' => 4],
            ['words' => 'afdeling', 'answers' => 'department', 'list_id' => 4],
            ['words' => 'receptiebalie', 'answers' => 'reception desk', 'list_id' => 5],
            ['words' => 'buitenlandse gast', 'answers' => 'foreign visitor/guest', 'list_id' => 5],
        ];

        foreach ($words as $word) {
            Word::create($word);
        }
    }
}
