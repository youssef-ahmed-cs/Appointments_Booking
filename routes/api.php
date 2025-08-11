<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AppointmentController::class)->group(function () {
    Route::get('appointments', 'index')->name('appointments.index');
    Route::post('appointments', 'store')->name('appointments.store');
    Route::get('appointments/{appointment}', 'show')->name('appointments.show');
    Route::put('appointments/{appointment}', 'update')->name('appointments.update');
    Route::delete('appointments/{appointment}', 'destroy')->name('appointments.destroy');
});

Route::controller(ServiceController::class)->group(function () {
    Route::get('services', 'index')->name('services.index');
    Route::post('services', 'store')->name('services.store');
    Route::get('services/{service}', 'show')->name('services.show');
    Route::put('services/{service}', 'update')->name('services.update');
    Route::delete('services/{service}', 'destroy')->name('services.destroy');
});

