<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TictactocController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



/*
|--------------------------------------------------------------------------
| Tic tac toc
|--------------------------------------------------------------------------
*/

    Route::get('/',                             			[TictactocController::class, 'index']);

    Route::get('/playing',                      			[TictactocController::class, 'toPlay'])->name('playing');
    Route::post('/playing',                     			[TictactocController::class, 'toPlay'])->name('playing');

    Route::post('/get-another-player/{code}',   			[TictactocController::class, 'getAnotherPlayer']);
    Route::post('/play',   									[TictactocController::class, 'play']);

    Route::get('/get-info-update-game/{code}/{player}',  	[TictactocController::class, 'getInfoUpdateGame']);

    Route::get('/test',                                     [TictactocController::class, 'test']);
    Route::post('/test-validate',                           [TictactocController::class, 'testValidate']);
/*
|--------------------------------------------------------------------------
| Tic tac toc
|--------------------------------------------------------------------------
*/