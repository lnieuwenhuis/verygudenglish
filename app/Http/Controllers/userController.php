<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Period;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        return view('docenten.studenten', ['studenten' => Student::all()]);
    }

    public function studentPeriodes()
    {
        return view('studenten.index', ['periodes' => Period::all()]);
    }

    public function create()
    {
        return view('docenten.studenten.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->remember_token = $request->get('remember_token');

        $user->save();

        return redirect()->back()->with('message', 'User Stored');
    }
    public function edit(Request $id)
    {
        return view('docenten.studenten.edit', ['user' => User::findOrFail($id)]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');

        $user->save();
    }
    public function destroy($id)
    {

        $user = Student::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('message', 'User Deleted');
    }
}
