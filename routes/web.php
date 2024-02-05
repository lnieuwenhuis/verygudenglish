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

Route::get('/studenten/periode/{toetsen}', [PeriodController::class, 'student_periode'])->name('studenten.period');

Route::get("/studenten/toets", [TestController::class, 'student_test'])->name('test.index');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/resultaten", [ResultController::class, "student_index"])->name('studenten.resultaten');

Route::get('/studenten/resultaten/fouten', [ResultController::class, 'student_mistakes'])->name('studenten.results.mistakes');


//Routes voor docenten
Route::get("/docenten", function () {
    return view('docenten.index');
})->name('docenten');
// ->middleware(['auth', 'verified'])->name('docenten');

Route::resource('/docenten/studenten', UserController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/woordenlijsten', WordListController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/periodes', PeriodController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/toetsen', TestController::class);
// ->middleware(['auth', 'verified']);

Route::resource('/docenten/resultaten', ResultController::class);
// ->middleware(['auth', 'verified']);
Route::get('/docenten/resultaten/{}/fouten', [ResultController::class, 'ResultController@docent_fouten'])->name('resultaten.mistakes');

Route::resource('/docenten/woorden', wordController::class);
// ->middleware(['auth', 'verified']);

//Routes voor de games
Route::get("/ageofwords", function () {
    return view('games.ageofwords');
})->name('ageofwords');
// ->middleware(['auth', 'verified'])->name('ageofwords');

Route::get("/meteor/{id}", [\App\Http\Controllers\MeteorController::class, 'meteor'])->name('meteoriet');
// ->middleware(['auth', 'verified'])->name('meteoriet');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
