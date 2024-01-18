<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('docenten.toetsen', ['tests' => Test::all()]);
    }
}
