<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'company_name',
                'value' => 'HomeKonnectAfrica',
                'type' => 'text',
                'group' => 'general',
                'description' => 'The name of your company',
            ],
            [
                'key' => 'company_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'The main logo of your website',
            ],
            
            // Hero Section Settings
            [
                'key' => 'hero_title',
                'value' => 'Find Your Dream Home Across Africa',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'The main heading text on the home page',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Connect with verified properties, trusted agents, and secure transactions across 8+ African cities',
                'type' => 'textarea',
                'group' => 'hero',
                'description' => 'The subtitle text on the home page',
            ],
            [
                'key' => 'hero_image',
                'value' => null,
                'type' => 'image',
                'group' => 'hero',
                'description' => 'The background image for the hero section',
            ],

            // Contact Settings
            [
                'key' => 'contact_email',
                'value' => 'support@homekonnect.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Main contact email address',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+250 788 123 456',
                'type' => 'phone',
                'group' => 'contact',
                'description' => 'Main contact phone number',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Kigali, Rwanda',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Physical office address',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
