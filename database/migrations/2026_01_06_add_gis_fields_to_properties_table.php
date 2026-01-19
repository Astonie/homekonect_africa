<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Check if columns don't already exist
            if (!Schema::hasColumn('properties', 'virtual_tour_type')) {
                $table->string('virtual_tour_type')->nullable()->after('virtual_tour_url');
            }
            if (!Schema::hasColumn('properties', 'has_drone_imagery')) {
                $table->boolean('has_drone_imagery')->default(false)->after('virtual_tour_type');
            }
            if (!Schema::hasColumn('properties', 'has_street_view')) {
                $table->boolean('has_street_view')->default(false)->after('has_drone_imagery');
            }
            if (!Schema::hasColumn('properties', 'street_view_metadata')) {
                $table->text('street_view_metadata')->nullable()->after('has_street_view');
            }
        });

        Schema::table('property_media', function (Blueprint $table) {
            if (!Schema::hasColumn('property_media', 'media_type')) {
                $table->string('media_type')->default('photo')->after('file_path');
            }
            if (!Schema::hasColumn('property_media', 'order')) {
                $table->integer('order')->default(0)->after('media_type');
            }
            if (!Schema::hasColumn('property_media', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('order');
            }
            if (!Schema::hasColumn('property_media', 'metadata')) {
                $table->text('metadata')->nullable()->after('is_featured');
            }
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'virtual_tour_url',
                'virtual_tour_type',
                'has_drone_imagery',
                'has_street_view',
                'street_view_metadata'
            ]);
        });

        Schema::table('property_media', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'order', 'is_featured', 'metadata']);
        });
    }
};
