<?php

namespace App\Providers;

use App\Listeners\SendWelcomeAfterEmailVerified;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
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
    }
}
