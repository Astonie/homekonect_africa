<?php

namespace App\Listeners;

use App\Notifications\WelcomeNotification;
use Illuminate\Auth\Events\Verified;

class SendWelcomeAfterEmailVerified
{
    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        // $event->user is the verified user
        $user = $event->user;

        // Only send once (if you anticipate re-verification flows)
        // You can guard with a flag on the user model if needed.
        $user->notify(new WelcomeNotification());
    }
}
