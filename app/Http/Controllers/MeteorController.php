<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;

class MeteorController extends Controller
{
    public function meteor($id, $period_id)
    {
        $words = Word::where('list_id', $id)->get();

        $periodId = Period::where('period_id', $period_id)->get();
        $listId = WordList::where('id', $id)->get();

        return view('games.meteoriet', ['words' => $words, 'period_id' => $periodId, 'list_id' => $listId]);
    }
}
