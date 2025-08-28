<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConcessionaireController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\MeterReadingController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TariffRateController;
use App\Http\Controllers\NotificationController;
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

Route::middleware('api')->group(function () {
    // Authentication Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // Protected Routes
    // Route::middleware('auth:sanctum')->group(function () {
    //     // User Routes
    //     Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //     Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    //     Route::post('/users', [UserController::class, 'store'])->name('users.store');
    //     Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    //     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    //     // Concessionaire Routes
    //     Route::get('/concessionaires', [ConcessionaireController::class, 'index'])->name('concessionaires.index');
    //     Route::get('/concessionaires/{concessionaire}', [ConcessionaireController::class, 'show'])->name('concessionaires.show');
    //     Route::post('/concessionaires', [ConcessionaireController::class, 'store'])->name('concessionaires.store');
    //     Route::put('/concessionaires/{concessionaire}', [ConcessionaireController::class, 'update'])->name('concessionaires.update');
    //     Route::delete('/concessionaires/{concessionaire}', [ConcessionaireController::class, 'destroy'])->name('concessionaires.destroy');

    //     // Meter Routes
    //     Route::get('/meters', [MeterController::class, 'index'])->name('meters.index');
    //     Route::get('/meters/{meter}', [MeterController::class, 'show'])->name('meters.show');
    //     Route::post('/meters', [MeterController::class, 'store'])->name('meters.store');
    //     Route::put('/meters/{meter}', [MeterController::class, 'update'])->name('meters.update');
    //     Route::delete('/meters/{meter}', [MeterController::class, 'destroy'])->name('meters.destroy');

    //     // Meter Reading Routes
    //     Route::get('/meter-readings', [MeterReadingController::class, 'index'])->name('meter-readings.index');
    //     Route::get('/meter-readings/{meterReading}', [MeterReadingController::class, 'show'])->name('meter-readings.show');
    //     Route::post('/meter-readings', [MeterReadingController::class, 'store'])->name('meter-readings.store');
    //     Route::put('/meter-readings/{meterReading}', [MeterReadingController::class, 'update'])->name('meter-readings.update');
    //     Route::delete('/meter-readings/{meterReading}', [MeterReadingController::class, 'destroy'])->name('meter-readings.destroy');

    //     // Billing Routes
    //     Route::get('/billings', [BillingController::class, 'index'])->name('billings.index');
    //     Route::get('/billings/{billing}', [BillingController::class, 'show'])->name('billings.show');
    //     Route::post('/billings', [BillingController::class, 'store'])->name('billings.store');
    //     Route::put('/billings/{billing}', [BillingController::class, 'update'])->name('billings.update');
    //     Route::delete('/billings/{billing}', [BillingController::class, 'destroy'])->name('billings.destroy');

    //     // Payment Routes
    //     Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    //     Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    //     Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    //     Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    //     Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    //     // Tariff Rate Routes
    //     Route::get('/tariff-rates', [TariffRateController::class, 'index'])->name('tariff-rates.index');
    //     Route::get('/tariff-rates/{tariffRate}', [TariffRateController::class, 'show'])->name('tariff-rates.show');
    //     Route::post('/tariff-rates', [TariffRateController::class, 'store'])->name('tariff-rates.store');
    //     Route::put('/tariff-rates/{tariffRate}', [TariffRateController::class, 'update'])->name('tariff-rates.update');
    //     Route::delete('/tariff-rates/{tariffRate}', [TariffRateController::class, 'destroy'])->name('tariff-rates.destroy');

    //     // Notification Routes
    //     Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    //     Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    //     Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    //     Route::put('/notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    //     Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    // });
});
