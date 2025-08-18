<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AvailableSlotController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Aut JWT Authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('auth.register');
    Route::post('login', 'login')->name('auth.login');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout')->name('auth.logout');
        Route::get('user', 'getUser')->name('auth.getUser');
    });
});

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

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::post('users', 'store')->name('users.store');
        Route::get('users/{id}', 'show')->name('users.show');
        Route::put('users/{id}', 'update')->name('users.update');
        Route::delete('users/{id}', 'destroy')->name('users.destroy');
    });

    Route::controller(AvailableSlotController::class)->group(function () {
        Route::get('available-slots', 'index')->name('available_slots.index');
        Route::post('available-slots', 'store')->name('available_slots.store');
        Route::get('available-slots/{id}', 'show')->name('available_slots.show');
        Route::patch('available-slots/{id}', 'update')->name('available_slots.update');
        Route::delete('available-slots/{id}', 'destroy')->name('available_slots.destroy');
    });


// functionalities
    Route::get('available-slots/provider/{providerId}', [AvailableSlotController::class, 'getByProvider'])
        ->name('available_slots.get_by_provider');

    Route::get('appointment/client/{id}', [AppointmentController::class, 'getByClientId'])
        ->name('appointment.client.get_by_client');

    Route::get('appointment/provider/{id}', [AppointmentController::class, 'getByProviderId'])
        ->name('available_appointment.get_by_provider');

    Route::get('appointment/service/{id}', [AppointmentController::class, 'getByServiceId'])
        ->name('available_appointment.services');

    Route::get('services/provider/{id}', [ServiceController::class, 'getServicesByProviderId'])
        ->name('available_services.get_by_provider');

