<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\DailyHealthCheckController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;




 
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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified' , 'isUserEnabled'])->name('dashboard');



Route::get('/map', [MapController::class, 'index'])->middleware(['auth', 'verified' ,'isUserEnabled' ])->name('map');





// Profile Routes
 Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified' ,  'isUserEnabled' ])->name('profile');

 Route::post('/update/profile', [ProfileController::class, 'update'])->middleware(['auth','verified' , 'isUserEnabled' ])->name('update');

 Route::post('/add_tracing_log', [ProfileController::class, 'addTracingLog'])->middleware(['auth','verified' ,  'isUserEnabled' ])->name('add_tracing_log');

 Route::post('/add_medical_assesment', [ProfileController::class, 'addMedicalAssesment'])->middleware(['auth','verified' ,  'isUserEnabled' ])->name('add_medical_assesment');



 // Users route 

 Route::get('/users', [UserController::class, 'users'])->middleware(['auth', 'verified' ,  ])->name('users');

 Route::get('/create_user', [UserController::class, 'create_user'])->middleware(['auth', 'verified' ,  'isUserEnabled'  ])->name('create_user');

 Route::post('/store_user', [UserController::class, 'store_user'])->middleware(['auth', 'verified' ,  'isUserEnabled' ])->name('store_user');

 Route::post('/disable_user/{id}', [UserController::class, 'disable_user'])->middleware(['auth', 'verified' , ])->name('disable_user');

 Route::post('/enable_user/{id}', [UserController::class, 'enable_user'])->middleware(['auth', 'verified' , ])->name('enable_user');


 
 // Health Check routes 
 
 Route::get('health_check', [DailyHealthCheckController::class, 'index'])->middleware(['auth', 'verified', 'isUserEnabled'  ])->name('health_check');

 Route::post('check_health_form', [DailyHealthCheckController::class, 'checkHealthForm'])->middleware(['auth', 'verified', 'isUserEnabled' ])->name('check_health');

 Route::get('health_status', [DailyHealthCheckController::class, 'healthStatus'])->middleware(['auth', 'verified', 'isUserEnabled' ])->name('healthStatus');

 Route::post('update_data_privacy', [DashboardController::class, 'update_data_privacy'])->middleware(['auth', 'verified'])->name('update_data_privacy');

 
 

// Student Routes 

Route::get('/student/{id} ', [StudentController::class, 'show'])->middleware(['auth', 'verified', 'isUserEnabled'   ])->name('student');

Route::get('/student_reports', [StudentController::class, 'studentReports'])->middleware(['auth', 'verified' , 'isUserEnabled'  ])->name('student_reports');

Route::get('change_student_status', [StudentController::class, 'changeStudentStatus'])->middleware(['auth', 'verified' , 'isUserEnabled'   ])->name('change_student_status');

Route::get('contingecy_report/{id}', [StudentController::class, 'contingencyReport'])->middleware(['auth', 'verified' , 'isUserEnabled'  ])->name('contingency_report');

require __DIR__.'/auth.php';
