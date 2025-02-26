<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MeetingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
Route::middleware(['auth'])->prefix('masters')->group(function () {
    Route::get('/{master}', [MasterController::class, 'show'])->where('master', '[0-9]+')->name('masters.show');

    Route::get('/', [MasterController::class, 'index'])->name('masters.index');
    Route::get('/create', [MasterController::class, 'create'])->name('masters.create');
    Route::post('/', [MasterController::class, 'store'])->name('masters.store');

    Route::get('/{master}/clients', [MasterController::class, 'clients'])->name('masters.clients');
    Route::get('/{master}/edit', [MasterController::class, 'edit'])->name('masters.edit');
    Route::put('/{master}/meetings', [MasterController::class, 'updateMaster'])->name('masters.update');
    Route::delete('/{master}', [MasterController::class, 'destroyMaster'])->name('masters.destroy');

    Route::post('/{master}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/{master}/export/txt', [MasterController::class, 'export'])->name('masters.export.txt');
});

//
Route::prefix('categories')->group(function () {
    Route::get('/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::get('/meetings/create/{master}/{service}', [MeetingController::class, 'create'])->name('meetings.create');
Route::post('/meetings/store/{master}/{service}', [MeetingController::class, 'store'])->name('meetings.store');

Route::middleware(['auth'])->prefix('master')->group(function () {

    Route::get('/management', [MasterController::class, 'management'])->name('master.management');
    Route::get('/meetings/{meeting}', [MasterController::class, 'meetings'])->name('master.meetings');

    Route::get('/meetings/edit/{meeting}', [MasterController::class, 'editMeeting'])->name('master.editMeeting');
    Route::put('/meetings/{meeting}/update', [MasterController::class, 'update'])->name('master.meetings.update');
    Route::delete('/meetings/{meeting}', [MasterController::class, 'destroy'])->name('master.meetings.destroy');

    //Route::put('/master/meetings/{meeting}/confirm', [MasterController::class, 'confirmMeetings'])->name('master.meetings.confirm');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    //dd($githubUser);
    $user = User::where('name', $githubUser->getName())->first();

    if (!$user) {
        $user = User::updateOrCreate([
            'name' => $githubUser->name,
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'is_admin' => 'user',
            //'remember_token' => $githubUser->token,
            //'github_token' => $githubUser->token,
            //'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
    //dd($user);
    Auth::login($user);

    return redirect('/');
});
