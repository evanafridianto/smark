<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoasController;
use App\Http\Controllers\API\SalesRecordController;
use App\Http\Controllers\API\UserProfileController;
use App\Http\Controllers\API\UserPasswordController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\BusinessProfileController;
use App\Http\Controllers\API\EmailNotificationController;

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


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::post('/logout', 'logout')->middleware(['auth:sanctum', 'user']);
});

Route::controller(UserPasswordController::class)->group(function () {
    Route::post('/forgot-password', 'passwordResetLink');
    Route::post('/reset-password/{token}', 'resetPassword');
    Route::put('/password', 'update')->middleware(['auth:sanctum', 'user']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(EmailNotificationController::class)->group(function () {
        Route::post('/email/verification-notification', 'sendLink')->middleware('throttle:6,1');
        // Route::post('/email/verification-notification', 'sendLink')->middleware('throttle:6,1');
    });
    Route::get('/emailIsVerified', function () {
        return response()->json(['emailIsVerified' => auth()->user()->hasVerifiedEmail()]);
    });



    Route::group(['middleware' => ['user', 'apiverified']], function () {
        Route::controller(UserProfileController::class)->group(function () {
            Route::get('/profile', 'show');
            Route::patch('/profile', 'update');
        });
        Route::controller(BusinessProfileController::class)->group(function () {
            Route::get('/business-profile', 'show');
            Route::put('/business-profile', 'update');
        });
        Route::controller(SalesRecordController::class)->group(function () {
            Route::get('/sales-record', 'index');
            Route::get('/sales-record/{id}', 'getById');
            Route::post('/sales-record', 'store');
            Route::put('/sales-record/{id}', 'update');
            Route::delete('/sales-record/{id}', 'destroy');
        });
        Route::controller(AdvertisementController::class)->group(function () {
            Route::get('/advertisement', 'index');
            Route::get('/advertisement/{id}', 'getById');
            Route::post('/advertisement', 'store');
            Route::put('/advertisement/{id}', 'update');
            Route::delete('/advertisement/{id}', 'destroy');
        });
        Route::controller(RoasController::class)->group(function () {
            Route::get('/roas', 'index');
            Route::get('/roas/{id}', 'getById');
            Route::post('/roas', 'store');
            Route::put('/roas/{id}', 'update');
            Route::delete('/roas/{id}', 'destroy');
        });
    });
});
Route::get('/business-category', [BusinessProfileController::class, 'businessCategory']);