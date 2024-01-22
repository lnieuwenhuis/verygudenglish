<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('docenten.toetsen', ['toetsen' => Test::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'period_id' => 'required',
            'wordlist' => 'required',
        ]);

        $test = new Test;
        $test->title = $request->get('title');
        $test->period_id = $request->get('period_id');
        $test->wordlist = $request->get('wordlist');

        $test->save();

        return redirect()->back()->with('message', 'Test Stored');
    }
    public function edit($id)
    {
        return view('docenten.toetsen.edit', ['toets' => Test::findOrFail($id)]);
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
