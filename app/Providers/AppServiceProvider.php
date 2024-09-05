<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Settings;
use App\Models\Social;
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
        $settings = Settings::firstOrFail();
        $socials = Social::all();
        $contact = Contact::first();
        View::share('contact', $contact);
        View::share('socials', $socials);
        View::share('settings', $settings);
    }
}
