<?php

namespace Database\Seeders;

use App\Models\KycVerification;
use App\Models\User;
use Illuminate\Database\Seeder;

class KycVerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get pending landlord
        $pendingLandlord = User::where('email', 'pending.landlord@example.com')->first();
        
        // Get pending agent
        $pendingAgent = User::where('email', 'pending.agent@example.com')->first();

        if (!$pendingLandlord && !$pendingAgent) {
            $this->command->error('❌ No pending users found. Please run UserSeeder first.');
            return;
        }

        // Create KYC verification for pending landlord
        if ($pendingLandlord) {
            KycVerification::create([
                'user_id' => $pendingLandlord->id,
                'business_name' => 'Mark Pending Properties LLC',
                'license_number' => null,
                'tax_id' => 'TAX-PL-123456',
                'business_address' => '789 Pending Street, Dallas, TX 75201',
                'id_type' => 'passport',
                'id_number' => 'P123456789',
                'id_front_image' => 'kyc/documents/pending_landlord_passport_front.pdf',
                'id_back_image' => null,
                'selfie_image' => 'kyc/documents/pending_landlord_selfie.jpg',
                'proof_of_address_type' => 'utility_bill',
                'proof_of_address_image' => 'kyc/documents/pending_landlord_utility_bill.pdf',
                'professional_license_image' => null,
                'certification_documents' => null,
                'property_ownership_documents' => json_encode([
                    'kyc/documents/pending_landlord_property_deed_1.pdf',
                    'kyc/documents/pending_landlord_property_deed_2.pdf',
                ]),
                'status' => 'pending',
                'rejection_reason' => null,
                'admin_notes' => null,
                'submitted_at' => now()->subDays(2),
            ]);

            $this->command->info('✅ KYC verification created for pending landlord');
        }

        // Create KYC verification for pending agent
        if ($pendingAgent) {
            KycVerification::create([
                'user_id' => $pendingAgent->id,
                'business_name' => 'Anna Pending Real Estate Services',
                'license_number' => 'RE-AZ-98765',
                'tax_id' => 'TAX-PA-789012',
                'business_address' => '456 Pending Avenue, Phoenix, AZ 85001',
                'id_type' => 'drivers_license',
                'id_number' => 'DL987654321',
                'id_front_image' => 'kyc/documents/pending_agent_license_front.jpg',
                'id_back_image' => 'kyc/documents/pending_agent_license_back.jpg',
                'selfie_image' => 'kyc/documents/pending_agent_selfie.jpg',
                'proof_of_address_type' => 'bank_statement',
                'proof_of_address_image' => 'kyc/documents/pending_agent_bank_statement.pdf',
                'professional_license_image' => 'kyc/documents/pending_agent_re_license.pdf',
                'certification_documents' => json_encode([
                    'kyc/documents/pending_agent_insurance.pdf',
                    'kyc/documents/pending_agent_bond.pdf',
                    'kyc/documents/pending_agent_certification.pdf',
                ]),
                'property_ownership_documents' => null,
                'status' => 'under_review',
                'rejection_reason' => null,
                'admin_notes' => 'Documents received. Awaiting verification with state licensing board.',
                'submitted_at' => now()->subDays(5),
            ]);

            $this->command->info('✅ KYC verification created for pending agent (under review)');
        }

        $this->command->info('📊 KYC verifications seeded successfully!');
    }
}
