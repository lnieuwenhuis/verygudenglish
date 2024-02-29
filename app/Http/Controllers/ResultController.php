<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Period;
use App\Models\Result;
use App\Models\Student;
use App\Models\WordList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    //docenten gedeelte
    public function index()
    {
        return view('docenten.resultaten', ['results' => Result::all(), 'students' => User::where('type', 'student')->get(), 'wordlists' => WordList::all(), 'periods' => Period::all()]);
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
            'list_id' => 'required',
            'user_id' => 'required'
        ]);

        $period_id = (int)$request->get('period_id');
        $list_id = (int)$request->get('list_id');
        $user_id = (int)$request->get('user_id');

        // dd($user_id);

        $result = new Result;
        $result->title = $request->get('title');
        $result->period_id = $period_id;
        $result->wordlist_id = $list_id;
        $result->student_id = $user_id;

        $result->result = $request->get('result');
        $result->mistakes = "";

        $test = $result->save();

        return route('studenten.periode');
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
        return view('students.results', ['results' => Result::all(), 'student' => Auth::id()]);
    }
}
