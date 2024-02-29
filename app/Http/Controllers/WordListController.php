<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Result;
use App\Models\Word;
use App\Models\WordList;
use Illuminate\Http\Request;

class WordListController extends Controller
{
    public function index()
    {
        return view("teachers.wordlists", ['wordlists' => WordList::all(), 'periods' => Period::all()]);
    }

    public function student_wordlist($id)
    {
        return view('students.wordlist', ['wordlist' => WordList::findOrFail($id), 'words' => Word::where('list_id', $id)->get()]);
    }
    public function create()
    {
        return view('teachers.create.wordlist', ['periods' => Period::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'period_id' => 'required'
        ]);

        $wordList = new WordList;
        $wordList->title = $request->get('title');
        $wordList->period_id = $request->get('period_id');
        $wordList->save();

        return redirect()->route('woordenlijsten.index')->with('message', 'Woordenlijst opgeslagen');
    }
    public function edit($id)
    {
        return view('teachers.edit.wordlist', ['wordlist' => WordList::findOrFail((int)$id), 'words' => Word::where('list_id', $id)->get(), 'periodes' => Period::all()]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'period_id' => 'required',
        ]);

        $wordList = WordList::findOrFail($id);
        $wordList->title = $request->get('title');
        $wordList->period_id = $request->get('period_id');

        $wordList->save();

        return redirect()->route('woordenlijsten.index')->with('message', 'Woordenlijst aangepast');
    }
    public function destroy($id)
    {
        $wordList = WordList::findOrFail($id);

        $wordList->words()->delete();
        $wordList->delete();

        return redirect()->route('woordenlijsten.index')->with('message', 'Woordenlijst verwijderd');
    }
}
