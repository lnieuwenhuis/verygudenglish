<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class wordController extends Controller
{
    public function index()
    {
        return view('docenten.woorden', ['words' => Word::all()]);
    }
    public function create()
    {
        return view('docenten.create.woorden');
    }
    public function store(Request $request)
    {
        $request->validate([
            'words' => 'required',
            'answers' => 'required',
            'list_id' => 'required'
        ]);

        $word = new Word;
        $word->words = $request->get('words');
        $word->answers = $request->get('answers');
        $word->list_id = (int)$request->get('list_id');
        $word->save();

        return redirect()->back()->with('message', 'Words Stored in Word List');
    }
    public function edit(Request $id)
    {
        return view('docenten.edit.woorden', ['words' => Word::where('list_id', $id)->findOrFail()]);

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
