<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class MeteorController extends Controller
{
    public function meteor($id)
    {
        $words = Word::where('list_id', $id)->get();

        return view('games.meteoriet', ['words' => $words]);
    }
}
