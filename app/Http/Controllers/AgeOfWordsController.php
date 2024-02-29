<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Student;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgeOfWordsController extends Controller
{
    public function ageofwords(Request $request, $list_id)
    {
        $wordList = WordList::findOrFail($list_id);
        $periode = Period::findOrFail($wordList->period_id);

        if ($periode->is_locked === 1) {
            return redirect()->route('students.periods')->with('message', 'Die Periode is gesloten!');
        } else {

            $words = Word::where('list_id', $request->list_id)->get();

            $userId = Auth::id();

            return view('games.ageofwords', ['words' => $words, 'period_id' => $wordList->period_id, 'list_id' => $wordList->id, 'user_id' => $userId]);
        }
    }
}
