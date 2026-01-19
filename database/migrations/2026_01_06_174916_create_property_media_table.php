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
        Schema::create('property_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            
            // Media Details
            $table->enum('type', ['image', 'video', 'drone_image', 'drone_video', 'floor_plan', '360_photo', 'document'])->default('image');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size'); // In bytes
            
            // Image/Video Metadata
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('duration')->nullable(); // For videos in seconds
            $table->string('thumbnail_path')->nullable();
            
            // Organization
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_cover')->default(false);
            
            // Descriptions & Tags
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('caption')->nullable();
            $table->json('tags')->nullable();
            
            // Location within property
            $table->string('room_type')->nullable(); // Living room, bedroom, kitchen, etc.
            $table->string('view_type')->nullable(); // Interior, exterior, aerial, street, etc.
            
            // Technical Details for 360 Images
            $table->boolean('is_360')->default(false);
            $table->json('exif_data')->nullable(); // Camera settings, GPS, etc.
            
            // Processing Status
            $table->enum('processing_status', ['pending', 'processing', 'completed', 'failed'])->default('completed');
            $table->text('processing_error')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('property_id');
            $table->index('type');
            $table->index('display_order');
            $table->index('is_featured');
            $table->index('is_cover');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_media');
    }
};
