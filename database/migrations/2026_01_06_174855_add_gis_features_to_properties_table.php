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
        Schema::table('properties', function (Blueprint $table) {
            // Enhanced GIS and Location Data
            $table->string('google_place_id')->nullable()->after('longitude');
            $table->boolean('street_view_available')->default(false)->after('google_place_id');
            $table->decimal('street_view_heading', 5, 2)->nullable()->after('street_view_available');
            $table->decimal('street_view_pitch', 4, 2)->nullable()->after('street_view_heading');
            $table->integer('street_view_zoom')->nullable()->after('street_view_pitch');
            
            // 360 Virtual Tours
            $table->string('matterport_url')->nullable()->after('virtual_tour_url');
            $table->string('360_tour_provider')->nullable()->after('matterport_url'); // matterport, kuula, ricoh, etc.
            $table->json('360_tour_data')->nullable()->after('360_tour_provider'); // Additional tour metadata
            
            // Drone & Aerial Imagery
            $table->json('drone_images')->nullable()->after('videos');
            $table->json('drone_videos')->nullable()->after('drone_images');
            $table->string('aerial_view_url')->nullable()->after('drone_videos');
            
            // Map & Imagery Settings
            $table->integer('map_zoom_level')->default(15)->after('aerial_view_url');
            $table->enum('map_type', ['roadmap', 'satellite', 'hybrid', 'terrain'])->default('roadmap')->after('map_zoom_level');
            
            // Floor Plans and 3D Models
            $table->json('floor_plans')->nullable()->after('map_type');
            $table->string('3d_model_url')->nullable()->after('floor_plans');
            
            // Media Gallery Settings
            $table->integer('featured_image_index')->default(0)->after('3d_model_url');
            $table->boolean('has_video_tour')->default(false)->after('featured_image_index');
            $table->boolean('has_360_tour')->default(false)->after('has_video_tour');
            $table->boolean('has_drone_footage')->default(false)->after('has_360_tour');
            
            // POI (Points of Interest) nearby
            $table->json('nearby_poi')->nullable()->after('has_drone_footage'); // Schools, hospitals, transport, etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'google_place_id',
                'street_view_available',
                'street_view_heading',
                'street_view_pitch',
                'street_view_zoom',
                'matterport_url',
                '360_tour_provider',
                '360_tour_data',
                'drone_images',
                'drone_videos',
                'aerial_view_url',
                'map_zoom_level',
                'map_type',
                'floor_plans',
                '3d_model_url',
                'featured_image_index',
                'has_video_tour',
                'has_360_tour',
                'has_drone_footage',
                'nearby_poi',
            ]);
        });
    }
};
