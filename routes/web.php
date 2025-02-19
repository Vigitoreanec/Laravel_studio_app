<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
Route::prefix('masters')->group(function () {
    Route::get('/', [MasterController::class, 'index'])->name('masters.index');
    Route::get('/create', [MasterController::class, 'create'])->name('masters.create');
    Route::post('/', [MasterController::class, 'store'])->name('masters.store');
    Route::get('/{master}', [MasterController::class, 'show'])->where('master', '[0-9]+')->name('masters.show');
    Route::get('/{master}/clients', [MasterController::class, 'clients'])->name('masters.clients');
    Route::get('/{master}/edit', [MasterController::class, 'edit'])->name('masters.edit');
    Route::delete('/{master}', [MasterController::class, 'destroyMaster'])->name('masters.destroy');
    // поправить пути
    Route::put('/{master}', [MasterController::class, 'updateMaster'])->name('masters.update');
});
//
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/meetings/create/{master}/{service}', [MeetingController::class, 'create'])->name('meetings.create');
Route::post('/meetings/store/{master}/{service}', [MeetingController::class, 'store'])->name('meetings.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/master/management', [MasterController::class, 'management'])->name('master.management');
    Route::get('/master/meetings', [MasterController::class, 'meetings'])->name('master.meetings');

    Route::put('/master/meetings/{meeting}/confirm', [MasterController::class, 'confirmMeetings'])->name('master.meetings.confirm');
    Route::put('/master/meetings/{meeting}', [MasterController::class, 'update'])->name('master.meetings.update');
    Route::delete('/master/meetings/{meeting}', [MasterController::class, 'destroy'])->name('master.meetings.destroy');
});





Route::get('/home', [HomeController::class, 'index'])->name('home');
