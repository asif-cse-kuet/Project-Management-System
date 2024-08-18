<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('layout.index');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/showprojects', [ProjectController::class, 'index'])->name('showprojects');
Route::get('/userDetails', [AuthController::class, 'finduser'])->name('userDetails');

Route::middleware('auth')->group(function () {
    Route::get('AdminDashboard', [ProjectController::class, 'index'])->name('AdminDashboard');
    Route::get('UserDashboard', function () {
        return view('user.index');
    });

    Route::get('/search-users', [AuthController::class, 'search_user'])->name('search-users');

    Route::post('/taskCreate', [TaskController::class, 'store'])->name('taskCreate');
    Route::put('/taskUpdate/{taskid}', [TaskController::class, 'update'])->name('taskUpdate');
    Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/updateProject/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/deleteProject', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
