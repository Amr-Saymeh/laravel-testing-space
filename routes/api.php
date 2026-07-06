<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{$id}', [UserController::class, 'show']);
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/books', [BookController::class, 'store']);
    });
    Route::middleware('role:user')->group(function () {
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/books/{$id}', [BookController::class, 'show']);
        Route::post('/borrow', [BorrowController::class, 'borrow_book']);
        Route::post('/return', [BorrowController::class, 'return_book']);
    });
});




