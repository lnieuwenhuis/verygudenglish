<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Test;
use Illuminate\Http\Request;

class periodController extends Controller
{
    public function index()
    {
        return view("docenten.periodes", ['periods' => Period::all()]);
    }
    public function create()
    {
        return view('docenten.create.periode');
    }
    public function store(Request $request)
    {
-
        $request->validate([
            'periode' => 'required',
            'is_locked' => 'required'
        ]);

        $islocked = (int) $request->get('is_locked');

        $period = new Period;
        $period->title = $request->get('periode');
        $period->is_locked = $islocked;

        $period->save();

        return redirect()->route('periodes.index')->with('message', 'Period Stored in DB');
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
