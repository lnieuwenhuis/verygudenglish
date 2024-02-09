<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    public function index()
    {
        return view('studenten');
    }
    public function studentPeriodes()
    {
        return view('studenten.periodes', ['periodes' => Period::all()]);
    }

    public function student_geenlijst()
    {
        return view('studenten.geenlijst');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);

        $user = new Student;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->remember_token = $request->get('remember_token');

        $user->save();

        return redirect()->back()->with('message', 'User Stored');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);

        $user = Student::findOrFail($id);
        $user->name = $request->get('name');

        $user->save();
    }
}
