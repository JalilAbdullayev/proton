<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogImageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ConsultantController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FirstSectionController;
use App\Http\Controllers\Admin\TitleController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SecondSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

$locale = Request::segment(1);

if(in_array($locale, ['en', 'ru'])) {
    $locale = Request::segment(1);
} else {
    $locale = '';
}

Route::group(['prefix' => $locale, function($locale = null) {
    return $locale;
}, 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => SetLocale::class], function() {
    Route::controller(FrontController::class)->group(function() {
        Route::get('/', 'index')->name('home');

        Route::get('about', 'about')->name('about_en');
        Route::get('haqqimizda', 'about')->name('about_az');
        Route::get('o-nas', 'about')->name('about_ru');

        Route::get('contact', 'contact')->name('contact_en');
        Route::get('elaqe', 'contact')->name('contact_az');
        Route::get('svyaz', 'contact')->name('contact_ru');

        Route::get('service/{slug}', 'service')->name('service_en');
        Route::get('xidmet/{slug}', 'service')->name('service_az');
        Route::get('usluga/{slug}', 'service')->name('service_ru');

        Route::prefix('portfolio')->name('portfolio.')->group(function() {
            Route::get('/', 'portfolio')->name('index');

            Route::get('category/{slug}', 'portfolioCategory')->name('category_en');
            Route::get('kateqoriya/{slug}', 'portfolioCategory')->name('category_az');
            Route::get('kateqoria/{slug}', 'portfolioCategory')->name('category_ru');
        });

        Route::get('project/{slug}', 'project')->name('project_en');
        Route::get('layihe/{slug}', 'project')->name('project_az');
        Route::get('proyekt/{slug}', 'project')->name('project_ru');

        Route::prefix('blog')->name('blog.')->group(function() {
            Route::get('/', 'blog')->name('index');

            Route::get('category/{slug}', 'blogCategory')->name('category_en');
            Route::get('kateqoriya/{slug}', 'blogCategory')->name('category_az');
            Route::get('kateqoria/{slug}', 'blogCategory')->name('category_ru');

            Route::get('tag/{slug}', 'blogTag')->name('tag_en');
            Route::get('etiket/{slug}', 'blogTag')->name('tag_az');
            Route::get('teq/{slug}', 'blogTag')->name('tag_ru');

            Route::get('search', 'blogSearch')->name('search_en');
            Route::get('axtar', 'blogSearch')->name('search_az');
            Route::get('poisk', 'blogSearch')->name('search_ru');
        });
        Route::get('article/{slug}', 'article')->name('article_en');
        Route::get('meqale/{slug}', 'article')->name('article_az');
        Route::get('statya/{slug}', 'article')->name('article_ru');

        Route::get('search', 'search')->name('search_en');
        Route::get('axtar', 'search')->name('search_az');
        Route::get('poisk', 'search')->name('search_ru');
    });

    Route::post('send', [MessageController::class, 'store'])->name('send');
    Route::post('consult', [ConsultantController::class, 'store'])->name('consult');

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('index');

        shortRoute(SettingsController::class, 'settings');
        shortRoute(AboutController::class, 'about');
        shortRoute(ContactController::class, 'contact');
        shortRoute(BannerController::class, 'banner');
        shortRoute(FirstSectionController::class, 'first-section');
        shortRoute(SecondSectionController::class, 'second-section');
        shortRoute(TitleController::class, 'titles');

        Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
            Route::get('delete', 'delete')->name('delete');
        });

        Route::resources([
            'users' => UserController::class,
            'team' => TeamController::class,
            'services' => ServiceController::class,
            'socials' => SocialController::class,
            'category' => CategoryController::class,
            'portfolio' => PortfolioController::class,
            'tag' => TagController::class,
            'blog' => BlogController::class,
            'client' => ClientController::class
        ]);

        Route::post('team/sort', [TeamController::class, 'sort'])->name('team.sort');
        Route::post('services/sort', [ServiceController::class, 'sort'])->name('services.sort');

        Route::post('socials/status', [SocialController::class, 'status'])->name('socials.status');
        Route::post('socials/sort', [SocialController::class, 'sort'])->name('socials.sort');

        Route::post('category/status', [CategoryController::class, 'status'])->name('category.status');
        Route::post('tag/status', [TagController::class, 'status'])->name('tag.status');

        longRoute('portfolio', PortfolioController::class, PortfolioImageController::class);
        longRoute('blog', BlogController::class, BlogImageController::class);

        Route::post('client/status', [ClientController::class, 'status'])->name('client.status');
        Route::post('client/sort', [ClientController::class, 'sort'])->name('client.sort');

        Route::controller(MessageController::class)->prefix('message')->name('message.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('{id}', 'show')->name('show');
            Route::delete('{id}', 'delete')->name('delete');
        });

        Route::controller(ConsultantController::class)->prefix('consultant')->name('consultant.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::delete('{id}', 'delete')->name('delete');
        });
    });
});

Route::get('sitemap-generate', function() {
    Artisan::call('sitemap:generate');
});

function shortRoute($controller, $prefix): void {
    Route::controller($controller)->prefix($prefix)->name($prefix)->group(function() {
        Route::get('/', 'index');
        Route::put('/', 'update');
    });
}

function longRoute($prefix, $controller, $imageController): void {
    Route::prefix($prefix)->name("$prefix.")->group(function() use ($imageController, $controller) {
        Route::post('status', [$controller, 'status'])->name('status');
        Route::post('sort', [$controller, 'sort'])->name('sort');

        Route::controller($imageController)->prefix('{id}/images')->name('images.')->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store');
            Route::post('status', 'status')->name('status');
            Route::put('/', 'featured')->name('featured');
            Route::delete('/', 'delete')->name('delete');
            Route::post('sort', 'sort')->name('sort');
        });
    });
}

Auth::routes();
