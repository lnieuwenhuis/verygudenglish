<?php

use App\Http\Controllers\periodController;
use App\Http\Controllers\PeriodController as ControllersPeriodController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
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

Route::get('/inloggen/azure', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('auth.login');
Route::get('/inloggen/azure/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('auth.login.callback');

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Routes voor studenten
Route::get("/studenten", [UserController::class, 'studentPeriodes'])->middleware('student')->name('studenten.periode');

Route::get('/studenten/periode/{toetsen}', [PeriodController::class, 'student_periode'])->middleware('student')->name('studenten.period');

Route::get("/studenten/toets", [TestController::class, 'student_test'])->middleware('student')->name('test.index');
// ->middleware(['auth', 'verified'])->name('studenten_resultaten');

Route::get("/studenten/resultaten", [ResultController::class, "student_index"])->middleware('student')->name('studenten.resultaten');

Route::get('/studenten/resultaten/fouten', [ResultController::class, 'student_mistakes'])->middleware('student')->name('studenten.results.mistakes');

Route::get('/studenten/woordenlijst/{woordenlijst}', [wordListController::class, 'student_wordlist'])->middleware('student')->name('studenten.woordenlijst');

Route::get('/studenten/woordenlijst/geenlijst', [StudentController::class, 'student_geenlijst'])->middleware('student')->name('studenten.geenlijst');

//Routes voor docenten
Route::get("/docenten", function () {
    return view('docenten.index');
})->middleware(['admin'])->name('docenten');

Route::resource('/docenten/studenten', UserController::class)->middleware(['admin']);

Route::resource('/docenten/woordenlijsten', WordListController::class)->middleware(['admin']);

Route::resource('/docenten/periodes', PeriodController::class)->middleware(['admin']);

Route::resource('/docenten/toetsen', TestController::class)->middleware(['admin']);

Route::resource('/docenten/resultaten', ResultController::class)->middleware(['admin']);

Route::get('/docenten/resultaten/{}/fouten', [ResultController::class, 'ResultController@docent_fouten'])->middleware(['admin'])->name('resultaten.mistakes');

Route::resource('/docenten/woorden', wordController::class)->middleware(['admin']);

//Routes voor de games
Route::get("/ageofwords/{list_id}", [\App\Http\Controllers\AgeOfWordsController::class, 'ageofwords'])->middleware('student')->name('ageofwords');
// ->middleware(['auth', 'verified'])->name('ageofwords');

Route::get("/meteor/{list_id}", [\App\Http\Controllers\MeteorController::class, 'meteor'])->middleware('student')->name('meteoriet');
// ->middleware(['auth', 'verified'])->name('meteoriet');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
