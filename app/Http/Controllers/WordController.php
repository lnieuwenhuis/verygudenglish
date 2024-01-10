<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class wordController extends Controller
{
    public function index()
    {
        return view('docenten.wordlists.words', ['words' => Word::all()]);
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required',
            'wordlist' => 'required'
        ]);

        $word = new Word;
        $word->word = $request->get('word');
        $word->wordlist = $request->get('wordlist');
        $word->save();

        $word->wordlist()->attach($request->get('wordlist'));

        return redirect()->back()->with('message', 'Words Stored in Word List');
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
