<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TrackController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('track/{date?}', [TrackController::class, 'show'])->name('track.index');
    Route::post('track', [TrackController::class, 'store'])->name('track.store');
    Route::post('track/delete', [TrackController::class, 'delete'])->name('track.delete');

    Route::post('habit', [HabitController::class, 'store'])->name('habit.store');
    Route::post('habit/{habit}', [HabitController::class, 'update'])->name('habit.update');
    Route::delete('habit/{habit}', [HabitController::class, 'destroy'])->name('habit.delete');

    Route::get('achievements', [AchievementController::class, 'index'])->name('achievement.index');

    Route::get('account/profile', [AccountController::class, 'profile'])->name('account.profile');
});

Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.login');

Route::get('/auth/linkedin/callback', function () {
    $ouser = Socialite::driver('linkedin')->stateless()->user();

    // Get or create new user based on email
    $user = User::updateOrCreate(['email' => $ouser->email], [
        'email' => $ouser->email,
        'name' => $ouser->name,
        'password' => bcrypt(Str::random(40)),
        'avatar' => $ouser->avatar,
    ]);

    // Login the user
    Auth::login($user);

    return redirect()->route('track.index');
})->name('linkedin.callback');
