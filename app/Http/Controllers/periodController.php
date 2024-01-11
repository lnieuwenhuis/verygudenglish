<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;

class periodController extends Controller
{
    public function index()
    {
        return view("docenten.periods", ['periods' => Period::all()]);
    }
    public function create()
    {
        return view('docenten.periods.create');
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'period' => 'required|max:1',
        ]);

        $period = new Period;
        $period->title = $request->get('period');
        $period->save();

        return redirect()->back()->with('message', 'Period Stored in DB');
    }
    public function edit($id)
    {
        return view('docent.period.edit', ['period' => Period::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'period' => 'required|max:1',
        ]);

        $period = Period::findOrFail($id);
        $period->period = $request->get('period');

        $period->save();
    }
    public function delete($id)
    {
        $period = new Period;

        $period = Period::findOrFail($id);
        $period->wordlist()->detach();
        $period->delete();

        return redirect()->back()->with('message', 'Periode verwijderd');
    }
}
