<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', SetLocale::class])->group(function() {
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::controller(SettingsController::class)->prefix('settings')->name('settings')->group(function() {
        Route::get('/', 'index');
        Route::put('/', 'update');
    });

    Route::controller(AboutController::class)->prefix('about')->name('about')->group(function() {
        Route::get('/', 'index');
        Route::put('/', 'update');
    });

    Route::controller(ContactController::class)->prefix('contact')->name('contact')->group(function() {
        Route::get('/', 'index');
        Route::put('/', 'update');
    });
});

Auth::routes();
