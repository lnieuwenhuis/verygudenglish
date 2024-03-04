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

Route::middleware('admin')->group(function () {
    Route::get('/docenten', [UserController::class, 'teacherIndex'])->name('docenten');
    Route::resource('/docenten/studenten', UserController::class);
    Route::resource('/docenten/woordenlijsten', WordListController::class);
    Route::resource('/docenten/periodes', PeriodController::class);
    Route::resource('/docenten/resultaten', ResultController::class);
    Route::resource('/docenten/woorden', wordController::class);
});

Route::middleware('student')->group(function () {
    Route::get('/studenten', [UserController::class, 'studentIndex'])->name('studenten.periode');
    Route::get('/studenten/periode/{id}', [PeriodController::class, 'studentPeriod'])->name('studenten.period');
    Route::get('/studenten/resultaten', [ResultController::class, 'student_index'])->name('studenten.resultaten');
    Route::get('/studenten/resultaten/fouten', [ResultController::class, 'student_mistakes'])->name('studenten.results.mistakes');
    Route::get('/studenten/woordenlijst/{woordenlijst}', [wordListController::class, 'student_wordlist'])->name('studenten.woordenlijst');
    Route::get('/studenten/woordenlijst/geenlijst', [UserController::class, 'student_geenlijst'])->name('studenten.geenlijst');
    Route::get("/ageofwords/{list_id}", [\App\Http\Controllers\AgeOfWordsController::class, 'ageofwords'])->name('ageofwords');
    Route::get("/meteor/{list_id}", [\App\Http\Controllers\MeteorController::class, 'meteor'])->name('meteoriet');
});

Route::post('/docenten/resultaten', [ResultController::class, 'store'])->middleware(['admin', 'student'])->name('results.store');

require __DIR__ . '/auth.php';
