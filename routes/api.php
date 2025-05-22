<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

Route::apiResource('books', BookController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\UserController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);
});

use App\Http\Controllers\AdminBorrowTransactionController;

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('admin/borrow-transactions', [AdminBorrowTransactionController::class, 'index']);
    Route::get('admin/borrow-transactions/{id}', [AdminBorrowTransactionController::class, 'show']);
    Route::put('admin/borrow-transactions/{id}', [AdminBorrowTransactionController::class, 'update']);
    Route::delete('admin/borrow-transactions/{id}', [AdminBorrowTransactionController::class, 'destroy']);
});
