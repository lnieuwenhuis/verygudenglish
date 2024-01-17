<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\wordListController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Routes voor studenten
Route::get("/studenten", function () {
    return view('studenten.index');
})->name('studenten');
// ->middleware(['auth', 'verified'])->name('studenten');

Route::get("/studenten/toetsen", function () {
    return view('studenten.toetsen');
})->name('studenten.toetsen');
// ->middleware(['auth', 'verified'])->name('studenten_toetsen');

Route::get("/studenten/resultaten", function () {
    return view('studenten.resultaten');
})->name('studenten.resultaten');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/periods", function () {
    return view('studenten.periodes');
})->name('studenten.periodes');
// ->middleware(['auth', 'verified'])->name('studenten_periodes');


//Routes voor docenten
Route::get("/docenten", function () {
    return view('docenten.index');
})->name('docenten');
// ->middleware(['auth', 'verified'])->name('docenten');

Route::resource('/docenten/studenten', UserController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/woordenlijsten', wordListController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/periodes', PeriodController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/toetsen', TestController::class);
// ->middleware(['auth', 'verified']);

//Routes voor de games
Route::get("/ageofwords", function () {
    return view('games.ageofwords');
})->name('ageofwords');
// ->middleware(['auth', 'verified'])->name('ageofwords');

Route::get("/meteor", function () {
    return view('games.meteoriet');
})->name('meteoriet');
// ->middleware(['auth', 'verified'])->name('meteoriet');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
