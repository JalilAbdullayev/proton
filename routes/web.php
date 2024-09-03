<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
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

    Route::resource('users', UserController::class);

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::patch('/', 'update')->name('update');
        Route::get('delete', 'delete')->name('delete');
    });

    Route::resource('team', TeamController::class);
    Route::resource('services', ServiceController::class);

    Route::resource('socials', SocialController::class);
    Route::post('socials/status', [SocialController::class, 'status'])->name('socials.status');

    Route::resource('category', CategoryController::class);
    Route::post('category/status', [CategoryController::class, 'status'])->name('category.status');
});

Auth::routes();
