<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/create', 'create')->name('category.create');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::put('/category/update', 'update')->name('category.update');
        Route::post('/category/store', 'store')->name('category.store');
        Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
    });

    // user
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/{data}/show/{id}', 'show')->name('user.show')->whereIn('data', ['user', 'business-profile', 'sales', 'advertisement', 'roas']);
        // Route::put('/category/update', 'update')->name('category.update');
        // Route::post('/category/store', 'store')->name('category.store');
        Route::delete('/user/destroy/{id}', 'destroy')->name('user.destroy');

        Route::get('/user/export', 'export')->name('user.export');
        Route::get('/user/exportById/{id}', 'exportById')->name('exportById.export');
    });
    Route::resource('businesses', UserController::class);
});



require __DIR__ . '/auth.php';