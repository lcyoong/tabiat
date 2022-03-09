<?php

use App\Http\Controllers\HabitController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('track/{date?}', [TrackController::class, 'show'])->name('track.index');
Route::post('track', [TrackController::class, 'store']);
Route::post('track/delete', [TrackController::class, 'delete']);

Route::post('habit', [HabitController::class, 'store']);
Route::delete('habit/{habit}', [HabitController::class, 'destroy']);
