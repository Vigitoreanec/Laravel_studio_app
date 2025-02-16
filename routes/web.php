<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// Главная
Route::get('/', [PageController::class, 'index'])->name('index');
//
Route::get('/masters', [MasterController::class, 'index'])->name('masters.index');
Route::get('/masters/{master}', [MasterController::class, 'show'])->where('master', '[0-9]+')->name('masters.show');
Route::get('/masters/{master}/clients', [MasterController::class, 'clients'])->name('masters.clients');

Route::get('/meetings/create/{master}/{service}', [MeetingController::class, 'create'])->name('meetings.create');
Route::post('/meetings/store/{master}/{service}', [MeetingController::class, 'store'])->name('meetings.store');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/master/management', [MasterController::class, 'management'])->name('master.management');
    Route::get('/master/meetings', [MasterController::class, 'meetings'])->name('master.meetings');
    Route::put('/master/meetings/{meeting}/confirm', [MasterController::class, 'confirmMeetings'])->name('master.meetings.confirm');
});





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
