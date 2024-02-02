<?php

use App\Http\Controllers\periodController;
use App\Http\Controllers\PeriodController as ControllersPeriodController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\wordController;
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
Route::get("/studenten", [UserController::class, 'studentPeriodes'])->name('studenten.periode');
// ->middleware(['auth', 'verified'])->name('studenten');

Route::get("/studenten/periode1", function () {
    return view('studenten.periode1');
})->name('studenten.periode1');
// ->middleware(['auth', 'verified'])->name('studenten_toetsen');

Route::get("/studenten/periode2", function () {
    return view('studenten.periode2');
})->name('studenten.periode2');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/periode3", function () {
    return view('studenten.periode3');
})->name('studenten.periode3');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/periode4", function () {
    return view('studenten.periode4');
})->name('studenten.periode4');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/toets", function () {
    return view('studenten.toets');
})->name('studenten.toets');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/resultaten", [ResultController::class, 'student_index', 1])->name('studenten.resultaten');


//Routes voor docenten
Route::get("/docenten", function () {
    return view('docenten.index');
})->name('docenten');
// ->middleware(['auth', 'verified'])->name('docenten');

Route::resource('/docenten/studenten', UserController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/woordenlijsten', WordListController::class);
// ->middleware(['auth', 'verified']);]

Route::resource('/docenten/periodes', PeriodController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/toetsen', TestController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/resultaten', ResultController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/woorden', wordController::class);
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
