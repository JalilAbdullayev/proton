<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Social;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        $settings = Settings::first();
        $socials = Social::whereStatus(1)->orderBy('order')->get();
        $contact = Contact::first();
        $services = Service::orderBy('order')->get();
        View::share('services', $services);
        View::share('contact', $contact);
        View::share('socials', $socials);
        View::share('settings', $settings);
        Paginator::useBootstrapFive();
    }
}
