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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
               $table->string('code', 3)->unique(); // ZAR, NGN, KES, etc.
               $table->string('name'); // South African Rand, Nigerian Naira, etc.
               $table->string('symbol'); // R, ₦, KSh, etc.
               $table->string('country'); // South Africa, Nigeria, Kenya, etc.
               $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
