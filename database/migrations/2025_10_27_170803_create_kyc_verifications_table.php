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
        Schema::create('kyc_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal/Business Information
            $table->string('business_name')->nullable(); // For agents/landlords
            $table->string('license_number')->nullable(); // For agents
            $table->string('tax_id')->nullable();
            $table->text('business_address')->nullable();
            
            // Identity Documents
            $table->string('id_type'); // passport, drivers_license, national_id
            $table->string('id_number');
            $table->string('id_front_image'); // Path to uploaded document
            $table->string('id_back_image')->nullable();
            $table->string('selfie_image'); // Selfie with ID
            
            // Proof of Address
            $table->string('proof_of_address_type'); // utility_bill, bank_statement, etc.
            $table->string('proof_of_address_image');
            
            // For Agents - Professional Documents
            $table->string('professional_license_image')->nullable();
            $table->string('certification_documents')->nullable(); // JSON array of paths
            
            // For Landlords - Property Ownership Proof
            $table->string('property_ownership_documents')->nullable(); // JSON array of paths
            
            // Verification Status
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected', 'resubmission_required'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();
            
            // Verification Metadata
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_verifications');
    }
};
