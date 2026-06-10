<?php

use App\Http\Controllers\PropertyLikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyRentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyReviewController;
use App\Http\Controllers\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return 'isso ta funcionando';
});

// Auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login',    [UserController::class, 'login']);
Route::get('/logout',    [UserController::class, 'logout'])->middleware('auth:sanctum');

// Públicas
Route::get('/properties',                      [PropertyController::class,       'index']);
Route::get('/property/{property}',             [PropertyController::class,       'show']);
Route::get('/properties/{property}/reviews',   [PropertyReviewController::class, 'index']);
Route::get('/user/{user}',                     [UserController::class,           'show']);

// Autenticadas
Route::middleware('auth:sanctum')->group(function () {

    // Properties
    Route::post('/property/store',                        [PropertyController::class, 'store']);
    Route::put('/property/update/{property}',             [PropertyController::class, 'update']);
    Route::delete('/property/delete/{property}',          [PropertyController::class, 'destroy']);
    Route::get('/my-properties',                          [PropertyController::class, 'myProperties']);
    Route::patch('/property/{property}/toggle-enabled',   [PropertyController::class, 'toggleEnableProperty']);

    // Rents
    Route::post('/properties/{property}/rent',            [PropertyRentController::class, 'store']);
    Route::get('/properties/{property}/rent',             [PropertyRentController::class, 'index']);
    Route::get('/my-properties/pending-rents',            [PropertyRentController::class, 'pendingRents']);
    Route::patch('/rents/{rent}/status',                  [PropertyRentController::class, 'updateStatus']);

    // Likes
    Route::post('/property/{property}/like',              [PropertyLikeController::class, 'toggleLike']);

    // Reviews
    Route::post('/properties/{property}/reviews',         [PropertyReviewController::class, 'store']);

    // Users
    Route::put('/user',          [UserController::class, 'updateMe']);
    Route::post('/user/photo',   [UserController::class, 'updatePhoto']);
    Route::post('/user/banner',  [UserController::class, 'updateBanner']);

    // Admin
    Route::prefix('admin')->group(function () {
        Route::get('/stats',               [AdminController::class, 'stats']);
        Route::get('/users',               [AdminController::class, 'listUsers']);
        Route::post('/create-admin',       [AdminController::class, 'createAdmin']);
        Route::patch('/users/{user}/role', [AdminController::class, 'changeRole']);
    });

    // Likes
    Route::get('/favorites', [PropertyLikeController::class, 'myLikes']);
});
