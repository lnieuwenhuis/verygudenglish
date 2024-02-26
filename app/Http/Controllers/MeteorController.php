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
    public function meteor(Request $request, $period_id)
    {
        $periode = Period::findOrFail($period_id);
        if ($periode->is_locked == 1) {
            return redirect()->route('studenten.periode')->with('message', 'Die is gesloten!');
        } else {

            $words = Word::where('list_id', $request->list_id)->get();

            $periodId = WordList::findOrFail($period_id);
            $listId = WordList::findOrFail($request->list_id);
            $userId = Auth::id();

            return view('games.meteoriet', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId, 'user_id' => $userId]);
        }
    }
}
