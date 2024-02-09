<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;

class AgeOfWordsController extends Controller
{
    public function ageofwords(Request $request, $period_id)
    {
        $words = Word::where('list_id', $request->list_id)->get();

        $periodId = Period::where('id', $period_id)->get();
        $listId = WordList::where('id', $request->list_id)->get();

        return view('games.ageofwords', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId]);
    }
}
