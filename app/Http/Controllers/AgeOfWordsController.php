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
        $periode = Period::findOrFail($period_id);
        if ($periode->is_locked == 1) {
            return redirect()->route('studenten.periode')->with('message', 'Die is gesloten!');
        } else {
            $words = Word::where('list_id', $request->list_id)->get();

            $periodId = WordList::findOrFail($period_id);
            $listId = WordList::findOrFail($request->list_id);

            return view('games.ageofwords', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId]);
        }
    }
}
