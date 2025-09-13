<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('ping', function() {
    return response()->json(['message' => 'pong'], 200);
});

Route::middleware('api')->group(function () {
    // Authentication Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        // Protected routes can be added here
        Route::get('/meter-details/{accountNumber}', [BillingController::class, 'getMeterDetails']);
        Route::post('/calculate-amount-due', [BillingController::class, 'calculateAmountDue']);
    });
});
