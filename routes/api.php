<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{$id}', [UserController::class, 'show']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{$id}', [BookController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/books', [BookController::class, 'store']);
Route::post('/borrow', [BorrowController::class, 'store']);


