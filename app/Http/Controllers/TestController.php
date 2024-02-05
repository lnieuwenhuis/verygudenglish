<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Student;
use App\Models\Test;
use App\Models\WordList;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('docenten.toetsen', ['toetsen' => Test::all(), 'periodes' => Period::all()]);
    }
    public function create()
    {
        return view('docenten.create.toets', ['woordenlijsten' => WordList::all(), 'periodes' => Period::all()]);
    }

    public function student_test()
    {
        return view('test.index', ['tests' => Test::all(), 'students' => Student::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'periode' => 'required',
            'woordenlijst' => 'required',
        ]);

        $period_id = (int)$request->get('periode');
        $wordlist = (int)$request->get('woordenlijst');


        $test = new Test;
        $test->title = $request->get('title');
        $test->period_id = $period_id;
        $test->wordlist_id = $wordlist;

        $test->save();

        return redirect()->route('toetsen.index')->with('message', 'Test Stored');
    }
    public function edit($id)
    {
        return view('toetsen.edit', ['toets' => Test::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'wordlist' => 'required',
        ]);

        $test = Test::findOrFail($id);
        $test->title = $request->get('title');

        $test->save();
    }
    public function destroy($id)
    {
        $test = new Test;
        $test = Test::findOrFail($id);

        $test->delete();

        return redirect()->back()->with('message', 'Test Deleted');
    }
}
