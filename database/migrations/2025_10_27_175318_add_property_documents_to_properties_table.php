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
            // Property verification documents
            $table->string('ownership_document')->nullable()->after('virtual_tour_url'); // Title deed, lease agreement
            $table->string('tax_receipt')->nullable(); // Property tax receipt
            $table->string('insurance_document')->nullable(); // Property insurance
            $table->string('building_permit')->nullable(); // Building/construction permits
            $table->json('additional_documents')->nullable(); // Array of additional document paths
            
            // Verification fields
            $table->boolean('documents_submitted')->default(false);
            $table->timestamp('documents_submitted_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who verified
            $table->text('verification_notes')->nullable(); // Admin notes on verification
            $table->text('rejection_reason')->nullable(); // Reason if documents rejected
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn([
                'ownership_document',
                'tax_receipt',
                'insurance_document',
                'building_permit',
                'additional_documents',
                'documents_submitted',
                'documents_submitted_at',
                'verified_by',
                'verification_notes',
                'rejection_reason',
            ]);
        });
    }
};
