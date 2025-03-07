<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

//Donors Routes
Route::post('/donor/login', [AuthController::class, 'loginDonor']);
Route::post('/donor/register', [AuthController::class, 'RegisterDonor']);


Route::middleware('auth:jwt,user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

