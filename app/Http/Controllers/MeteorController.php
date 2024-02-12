<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;

class MeteorController extends Controller
{
    public function meteor(Request $request, $period_id)
    {

        $words = Word::where('list_id', $request->list_id)->get();

        $periodId = Period::findOrFail($period_id);
        $listId = WordList::findOrFail($request->list_id);

        return view('games.meteoriet', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId]);
    }
}
