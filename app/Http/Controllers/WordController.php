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
        return view('docenten.words.create');
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
    public function edit(Request $id)
    {
        return view('docenten.words.edit', ['word' => Word::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'word' => 'required',
            'wordlist' => 'required'
        ]);

        $word = Word::findOrFail($id);
        $word->word = $request->get('word');
        $word->wordlist = $request->get('wordlist');

        $word->save();

        $word->wordlist()->detach();
        $word->wordlist()->attach($request->get('wordlist'));
    }
    public function delete(Request $id)
    {
        $word = new Word;
        $word = Word::findOrFail($id);

        $word->wordlist()->detach();
        $word->delete();

        return redirect()->back()->with('message', 'Word Deleted');
    }
}
