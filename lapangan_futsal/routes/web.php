<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ReservasionController;
use App\Http\Controllers\ScheduleController;
use App\Models\User;
use App\Http\Controllers\UserController;


Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::delete('/logout', [AuthController::class, 'logout']);

Route::middleware("auth")->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);

    Route::get('/fields', [FieldController::class, 'index']);
    Route::get('/schedules', [ScheduleController::class, 'index']);
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/create', [UserController::class, 'create']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{id}/edit', [UserController::class, 'edit']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });

    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/reservations', [ReservasionController::class, 'index']);

        Route::get('/fields/create', [FieldController::class, 'create']);
        Route::post('/fields', [FieldController::class, 'store']);
        Route::get('/fields/{id}/edit', [FieldController::class, 'edit']);
        Route::put('/fields/{id}', [FieldController::class, 'update']);
        Route::delete('/fields/{id}', [FieldController::class, 'destroy']);

        Route::get('/schedules/create', [ScheduleController::class, 'create']);
        Route::post('/schedules', [ScheduleController::class, 'store']);
        Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit']);
        Route::put('/schedules/{id}', [ScheduleController::class, 'update']);
        Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);
    });

    Route::middleware('role:user')->group(function () {
        Route::get('/reservations/my', [ReservasionController::class, 'findByUser']);
        Route::post('/reservations', [ReservasionController::class, 'store']);
        Route::get('/reservations/{id}', [ReservasionController::class, 'show']);
        Route::put('/reservations/{id}', [ReservasionController::class, 'update']);
        Route::delete('/reservations/{id}', [ReservasionController::class, 'destroy']);
    });
});
