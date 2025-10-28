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
        Schema::create('property_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Landlord who owns the document
            $table->string('title'); // Document name/title
            $table->string('document_type'); // e.g., 'ownership_deed', 'tax_receipt', 'noc', 'insurance', 'other'
            $table->string('file_path'); // Path to the stored file
            $table->string('file_name'); // Original filename
            $table->string('file_size'); // File size in bytes
            $table->string('file_extension'); // File extension (pdf, jpg, etc.)
            $table->text('description')->nullable(); // Optional description
            $table->date('expiry_date')->nullable(); // For documents that expire (insurance, etc.)
            $table->timestamps();
            
            $table->index(['user_id', 'document_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_documents');
    }
};
