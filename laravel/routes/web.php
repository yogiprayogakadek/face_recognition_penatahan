<?php

use App\Http\Controllers\Main\AuthController;
use App\Http\Controllers\Main\DashboardController;
use App\Http\Controllers\Main\FaceEncodingController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Main\PegawaiController;
use App\Http\Controllers\Main\RuleController;
use Illuminate\Support\Facades\Route;

// MAIN PRESENCE
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'showAbsensiPage');
    Route::post('/verify', 'verifyFace')->name('face.verify');
});

// AUTH
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->middleware('guest');
    Route::post('/login', 'login')->name('login');

    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    // DASHBOARD
    Route::controller(DashboardController::class)->group(function () {
        // Route::get('/', 'index')->name('dashboard');
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // PEGAWAI
    Route::prefix('pegawai')
        ->middleware('role:admin')
        ->controller(PegawaiController::class)
        ->name('pegawai.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::put('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
            Route::get('/restore', 'showRestore')->name('showRestore');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // RULE
    Route::prefix('rule')
        ->middleware('role:admin')
        ->controller(RuleController::class)
        ->name('rule.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{role_group_id}', 'update')->name('update');
            Route::put('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
            Route::get('/restore', 'showRestore')->name('showRestore');
            Route::post('/{id}/restore', 'restore')->name('restore');
        });

    // FACE ENCODING
    Route::prefix('face')
        // ->middleware('role:admin')
        ->controller(FaceEncodingController::class)
        ->name('face.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create/{id}', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');


            // NEW
            Route::post('/register', 'registerFace')->name('register');

            // PEGAWAI
            // Route::get('/create', 'create')->name('create');
        });
});
