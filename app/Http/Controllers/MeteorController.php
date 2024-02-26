<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Student;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MeteorController extends Controller
{
    public function meteor(Request $request, $list_id)
    {
        $wordList = WordList::findOrFail($list_id);
        $periode = Period::findOrFail($wordList->period_id);
        //$periode = Period::findOrFail($list_id);

        if ($periode->is_locked === 1) {
            return redirect()->route('studenten.periode')->with('message', 'Die is gesloten!');
        } else {

            $words = Word::where('list_id', $request->list_id)->get();

           // $listId = WordList::findOrFail($request->list_id);
            $userId = Auth::id();

            return view('games.meteoriet', ['words' => $words, 'period_id' => $wordList->period_id, 'list_id' => $wordList->id, 'user_id' => $userId]);
        }
    }
}
