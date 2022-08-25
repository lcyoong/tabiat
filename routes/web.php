<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\TrackPhotoController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\FacebookAuthController;
use App\Http\Controllers\LinkedInAuthController;
use App\Http\Controllers\AccountProfileController;

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
    Route::get('goal', [GoalController::class, 'index'])->name('goal.index');
    Route::get('goal/new', [GoalController::class, 'create'])->name('goal.create');

    Route::get('track/{date?}', [TrackController::class, 'show'])->name('track.index');
    Route::post('track', [TrackController::class, 'store'])->name('track.store');
    Route::post('track/delete', [TrackController::class, 'delete'])->name('track.delete');
    Route::post('track/photos', [TrackPhotoController::class, 'store'])->name('track.photo.store');

    Route::post('habit', [HabitController::class, 'store'])->name('habit.store');
    Route::post('habit/{habit}', [HabitController::class, 'update'])->name('habit.update');
    Route::delete('habit/{habit}', [HabitController::class, 'destroy'])->name('habit.delete');

    Route::get('achievements', [AchievementController::class, 'index'])->name('achievement.index');

    Route::get('account/profile', [AccountProfileController::class, 'show'])->name('profile.show');
    Route::post('account/profile', [AccountProfileController::class, 'update'])->name('profile.update');

});

Route::get('/auth/linkedin/redirect', [LinkedInAuthController::class, 'redirect'])->name('linkedin.login');
Route::get('/auth/linkedin/callback', [LinkedInAuthController::class, 'callback'])->name('linkedin.callback');

Route::get('/auth/facebook/redirect', [FacebookAuthController::class, 'redirect'])->name('facebook.login');
Route::get('/auth/facebook/callback', [FacebookAuthController::class, 'callback'])->name('facebook.callback');
