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
    public function ageofwords(Request $request, $period_id)
    {
        $words = Word::where('list_id', $request->list_id)->get();

        $periodId = WordList::findOrFail($period_id);
        $listId = WordList::findOrFail($request->list_id);
        $userId = Auth::id();

        return view('games.ageofwords', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId, 'user_id' => $userId]);
    }
}
