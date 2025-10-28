<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Console\Command;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration by sending a welcome email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            // Get first user
            $user = User::first();
            if (!$user) {
                $this->error('No users found in database. Please provide an email address.');
                return 1;
            }
        } else {
            // Find user by email
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("User with email {$email} not found.");
                return 1;
            }
        }

        $this->info("Sending test email to {$user->email}...");
        
        try {
            $user->notify(new WelcomeNotification());
            $this->info("✓ Email sent successfully to {$user->email}!");
            $this->info("Check your inbox (and spam folder).");
        } catch (\Exception $e) {
            $this->error("✗ Failed to send email: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
