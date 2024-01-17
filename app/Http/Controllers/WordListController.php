<?php

namespace App\Http\Controllers;

use App\Models\WordList;
use Illuminate\Http\Request;

class wordListController extends Controller
{
    public function index()
    {
        return view("docenten.woordenlijsten", ['wordlists' => WordList::all()]);
    }
    public function create()
    {
        return view('docenten.wordlists.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'period' => 'required|max:1',
            'words' => 'required',
        ]);

        $wordList = new WordList;
        $wordList->title = $request->get('title');
        $wordList->save();

        $wordList->words()->attach($request->get('words'));
        $wordList->periods()->attach($request->get('period'));

        return redirect()->back()->with('message', 'Wordlist Stored in DB');
    }
    public function edit(Request $id)
    {
        return view('docenten.wordlists.edit', ['wordlist' => WordList::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
        ]);

        $wordList = new WordList;
        $wordList = WordList::findOrFail($id);
        $wordList->title = $request->get('title');

        $wordList->save();

        $wordList->words()->detach();
        $wordList->words()->attach($request->get('words'));
    }
    public function delete(Request $id)
    {
        $wordList = new WordList;

        $wordList = WordList::findOrFail($id);
        $wordList->words()->detach();
        $wordList->delete();

        return redirect()->back()->with('message', 'Woordenlijst verwijderd');
    }
}
