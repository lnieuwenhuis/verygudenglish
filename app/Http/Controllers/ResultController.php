<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Result;
use App\Models\Student;
use App\Models\WordList;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //docenten gedeelte
    public function index()
    {
        return view('docenten.resultaten', ['results' => Result::all(), 'students' => Student::all(), 'wordlists' => WordList::all(), 'periods' => Period::all()]);
    }

    public function docent_fouten(Request $id)
    {
        return view('docenten.fouten', ['results' => Result::findOrFail($id)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'period_id' => 'required',
            'wordlist_id' => 'required',
            'student_id' => 'required',
            'mistakes' => 'required',
        ]);

        $period_id = (int)$request->get('period_id');
        $wordlist_id = (int)$request->get('wordlist_id');
        $student_id = (int)$request->get('student_id');

        $result = new Result;
        $result->title = $request->get('title');
        $result->period_id = $period_id;
        $result->wordlist_id = $wordlist_id;
        $result->student_id = $student_id;
        $result->result = $request->get('result');
        $result->mistakes = $request->get('mistakes');

        $result->save();

        return redirect()->route('studenten.periodes');
    }

    public function destroy($id)
    {
        $result = new Result;
        $result = Result::findOrFail($id);

        $result->delete();

        return redirect()->back()->with('message', 'Result Deleted');
    }

    //studenten gedeelte

    public function student_index()
    {
        return view('studenten.resultaten', ['results' => Result::all(), 'student' => Student::findOrFail(1)]);
    }
}
