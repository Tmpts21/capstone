<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\DailyHealthCheckController;


 
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('health_check', [DailyHealthCheckController::class, 'index'])->middleware(['auth', 'verified'])->name('health_check');


Route::get('/map', [MapController::class, 'index'])->middleware(['auth', 'verified'])->name('map');

 Route::get('/dataprivacy', function () {
     return Inertia::render('DataPrivacy');
 });

 Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified'])->name('profile');

 Route::post('/update/profile', [ProfileController::class, 'update'])->middleware(['auth','verified'])->name('update');



require __DIR__.'/auth.php';