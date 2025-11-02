<?php

namespace App\Providers;

use App\Listeners\SendWelcomeAfterEmailVerified;
use App\Models\Setting;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Send a welcome email after a user verifies their email address
        Event::listen(
            Verified::class,
            [SendWelcomeAfterEmailVerified::class, 'handle']
        );

        // Share settings with all views
        try {
            View::share('siteSettings', [
                'contact_email' => setting('contact_email', 'support@homekonnect.com'),
                'contact_phone' => setting('contact_phone'),
                'contact_address' => setting('contact_address'),
                'contact_hours' => setting('contact_hours', 'Mon–Fri, 9:00AM–6:00PM CAT'),
                'company_name' => setting('company_name', 'HomeKonnect Africa'),
                'company_description' => setting('company_description', 'Your trusted partner in finding the perfect home across Africa'),
            ]);
        } catch (\Exception $e) {
            // Settings table might not exist yet during migration
            View::share('siteSettings', [
                'contact_email' => 'support@homekonnect.com',
                'contact_phone' => null,
                'contact_address' => null,
                'contact_hours' => 'Mon–Fri, 9:00AM–6:00PM CAT',
                'company_name' => 'HomeKonnect Africa',
                'company_description' => 'Your trusted partner in finding the perfect home across Africa',
            ]);
        }
    }
}
