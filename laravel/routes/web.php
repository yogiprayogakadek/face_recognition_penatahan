<?php

use App\Http\Controllers\Main\AuthController;
use App\Http\Controllers\Main\PegawaiController;
use App\Http\Controllers\Main\RuleController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->middleware('guest');
    Route::post('/login', 'login')->name('login');

    Route::get('/logout', 'logout');
});

// PEGAWAI
Route::prefix('pegawai')
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

// PEGAWAI
Route::prefix('rule')
    ->controller(RuleController::class)
    ->name('rule.')
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

Route::view('/', 'index')->name('dashboard');
