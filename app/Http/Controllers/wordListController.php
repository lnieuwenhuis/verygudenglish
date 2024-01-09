<?php

namespace App\Http\Controllers;

use App\Models\WordList;
use Illuminate\Http\Request;

class wordListController extends Controller
{
    public function index()
    {
        return view("wordList");
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
        ]);

        $wordList = new WordList;
        $wordList->title = $request->get('title');
        $wordList->save();

        $wordList->words()->attach($request->get('words'));

        return redirect()->back()->with('message', 'Wordlist Stored in DB');
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
