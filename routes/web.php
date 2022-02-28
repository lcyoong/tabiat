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
});

Route::get('track/{date?}', [TrackController::class, 'show']);
Route::post('track', [TrackController::class, 'store']);
Route::post('track/delete', [TrackController::class, 'delete']);

Route::post('habit/delete/{habit}', [HabitController::class, 'destroy']);
Route::post('habit', [HabitController::class, 'store']);
