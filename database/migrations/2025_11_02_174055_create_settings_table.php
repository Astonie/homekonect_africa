<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, email, phone, textarea, url
            $table->string('group')->default('general'); // general, contact, social, etc.
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default contact settings
        DB::table('settings')->insert([
            [
                'key' => 'contact_email',
                'value' => 'support@homekonnect.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Primary contact email address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_phone',
                'value' => '+260 XXX XXX XXX',
                'type' => 'phone',
                'group' => 'contact',
                'description' => 'Primary contact phone number',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_address',
                'value' => 'Lusaka, Zambia',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Physical office address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_hours',
                'value' => 'Mon–Fri, 9:00AM–6:00PM CAT',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Business operating hours',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'company_name',
                'value' => 'HomeKonnect Africa',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Company name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'company_description',
                'value' => 'Your trusted partner in finding the perfect home across Africa',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Company description for footer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
