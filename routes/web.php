<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogImageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(SetLocale::class)->group(function() {
    Route::controller(FrontController::class)->group(function() {
        Route::get('/', 'index')->name('home');
        Route::get('about', 'about')->name('about');
        Route::get('contact', 'contact')->name('contact');
    });
    Route::post('send', [MessageController::class, 'store'])->name('send');

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
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

        Route::resource('portfolio', PortfolioController::class);
        Route::prefix('portfolio')->name('portfolio.')->group(function() {
            Route::post('status', [PortfolioController::class, 'status'])->name('status');
            Route::controller(PortfolioImageController::class)->prefix('{id}/images')->name('images.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store');
                Route::post('status', 'status')->name('status');
                Route::put('/', 'featured')->name('featured');
                Route::delete('/', 'delete')->name('delete');
            });
        });

        Route::resource('tag', TagController::class);
        Route::post('tag/status', [TagController::class, 'status'])->name('tag.status');

        Route::resource('blog', BlogController::class);
        Route::prefix('blog')->name('blog.')->group(function() {
            Route::post('status', [BlogController::class, 'status'])->name('status');
            Route::controller(BlogImageController::class)->prefix('{id}/images')->name('images.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store');
                Route::post('status', 'status')->name('status');
                Route::put('/', 'featured')->name('featured');
                Route::delete('/', 'delete')->name('delete');
            });
        });

        Route::controller(MessageController::class)->prefix('message')->name('message.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'delete')->name('delete');
        });

        Route::controller(BannerController::class)->prefix('banner')->name('banner')->group(function() {
            Route::get('/', 'index');
            Route::put('/', 'update');
        });

        Route::resource('client', ClientController::class);
        Route::post('client/status', [ClientController::class, 'status'])->name('client.status');
    });
});

Auth::routes();
