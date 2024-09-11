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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

$locale = RequestFacade::segment(1);
if(in_array($locale, ['az', 'ru'])) {
    $locale = RequestFacade::segment(1);
} else {
    $locale = 'en';
}

Route::post('/update-locale', static function(Request $request) {
    $locale = $request->input('locale');
    Session::put('locale', $locale);

    return Response::json(['success' => true]);
})->name('update-locale');

Route::get('/{locale?}', static function($locale = 'en') {
    if($locale === 'en') {
        return Redirect::route('home_en');
    }

    if($locale) {
        Session::put('locale', $locale);
    }

    return Redirect::route('home_' . $locale);
})->where('locale', '[a-zA-Z]{2}');

Route::group(['prefix' => $locale, function($locale = null) {
    return $locale;
}, 'where' => ['locale' => '[a-zA-Z]{2}']], static function() {
    Route::middleware(SetLocale::class)->group(function() {
        Route::controller(FrontController::class)->group(function() {
            Route::get('home', 'index')->name('home_en');
            Route::get('ana-sehife', 'index')->name('home_az');
            Route::get('glavnaya', 'index')->name('home_ru');

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
                Route::get('taq/{slug}', 'blogTag')->name('tag_az');
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

            Route::controller(FirstSectionController::class)->prefix('first-section')->name('first-section')->group(function() {
                Route::get('/', 'index');
                Route::put('/', 'update');
            });

            Route::controller(SecondSectionController::class)->prefix('second-section')->name('second-section')->group(function() {
                Route::get('/', 'index');
                Route::put('/', 'update');
            });

            Route::controller(ConsultantController::class)->prefix('consultant')->name('consultant.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::delete('{id}', 'delete')->name('delete');
            });

            Route::controller(TitleController::class)->prefix('titles')->name('titles')->group(function() {
                Route::get('/', 'index');
                Route::put('/', 'update');
            });
        });
    });
});

Auth::routes();
