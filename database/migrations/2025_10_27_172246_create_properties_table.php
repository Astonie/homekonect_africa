<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Owner (landlord/agent)
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['apartment', 'house', 'condo', 'townhouse', 'studio', 'villa', 'commercial']);
            $table->enum('listing_type', ['rent', 'sale'])->default('rent');
            
            // Location
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country')->default('USA');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Property Details
            $table->integer('bedrooms');
            $table->decimal('bathrooms', 3, 1);
            $table->integer('square_feet');
            $table->integer('year_built')->nullable();
            $table->integer('floors')->default(1);
            $table->boolean('furnished')->default(false);
            
            // Pricing
            $table->decimal('price', 10, 2); // Monthly rent or sale price
            $table->decimal('security_deposit', 10, 2)->nullable();
            $table->decimal('maintenance_fee', 10, 2)->nullable();
            
            // Amenities (JSON)
            $table->json('amenities')->nullable();
            
            // Media
            $table->json('images')->nullable(); // Array of image paths
            $table->json('videos')->nullable(); // Array of video paths
            $table->string('virtual_tour_url')->nullable();
            
            // Availability
            $table->enum('status', ['available', 'rented', 'sold', 'pending', 'inactive'])->default('available');
            $table->date('available_from')->nullable();
            $table->integer('lease_duration')->nullable(); // In months
            
            // SEO & Analytics
            $table->string('slug')->unique();
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            
            // Timestamps
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('type');
            $table->index('listing_type');
            $table->index('status');
            $table->index('city');
            $table->index('price');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
