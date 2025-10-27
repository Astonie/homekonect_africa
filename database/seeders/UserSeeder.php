<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@homekonnect.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '+1-555-0100',
            'bio' => 'Platform Administrator',
            'is_verified' => true,
            'verification_status' => 'verified',
            'verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create Verified Landlords
        $landlords = [
            [
                'name' => 'John Smith',
                'email' => 'john.landlord@example.com',
                'phone' => '+1-555-0101',
                'bio' => 'Experienced property owner with 10+ years in real estate. Specializing in residential properties.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.landlord@example.com',
                'phone' => '+1-555-0102',
                'bio' => 'Commercial and residential property investor. Owner of multiple properties across the city.',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.landlord@example.com',
                'phone' => '+1-555-0103',
                'bio' => 'Family-owned property business. Focus on quality housing and tenant satisfaction.',
            ],
        ];

        foreach ($landlords as $landlord) {
            User::create(array_merge($landlord, [
                'password' => Hash::make('password'),
                'role' => 'landlord',
                'is_verified' => true,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'email_verified_at' => now(),
            ]));
        }

        // Create Verified Agents
        $agents = [
            [
                'name' => 'Emily Davis',
                'email' => 'emily.agent@example.com',
                'phone' => '+1-555-0201',
                'bio' => 'Licensed real estate agent with 8 years of experience. Specializing in luxury properties.',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.agent@example.com',
                'phone' => '+1-555-0202',
                'bio' => 'Real estate professional focused on first-time buyers and renters. Excellent customer service.',
            ],
            [
                'name' => 'Lisa Martinez',
                'email' => 'lisa.agent@example.com',
                'phone' => '+1-555-0203',
                'bio' => 'Award-winning agent with expertise in commercial and residential real estate.',
            ],
        ];

        foreach ($agents as $agent) {
            User::create(array_merge($agent, [
                'password' => Hash::make('password'),
                'role' => 'agent',
                'is_verified' => true,
                'verification_status' => 'verified',
                'verified_at' => now(),
                'email_verified_at' => now(),
            ]));
        }

        // Create Tenants
        $tenants = [
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.tenant@example.com',
                'phone' => '+1-555-0301',
                'bio' => 'Young professional looking for a comfortable apartment.',
            ],
            [
                'name' => 'Jennifer Anderson',
                'email' => 'jennifer.tenant@example.com',
                'phone' => '+1-555-0302',
                'bio' => 'Family of four seeking a spacious home.',
            ],
            [
                'name' => 'James Thomas',
                'email' => 'james.tenant@example.com',
                'phone' => '+1-555-0303',
                'bio' => 'Student looking for affordable housing near campus.',
            ],
            [
                'name' => 'Patricia White',
                'email' => 'patricia.tenant@example.com',
                'phone' => '+1-555-0304',
                'bio' => 'Relocating professional seeking temporary accommodation.',
            ],
        ];

        foreach ($tenants as $tenant) {
            User::create(array_merge($tenant, [
                'password' => Hash::make('password'),
                'role' => 'tenant',
                'is_verified' => false,
                'verification_status' => 'unverified',
                'email_verified_at' => now(),
            ]));
        }

        // Create Unverified Landlord (pending KYC)
        User::create([
            'name' => 'Mark Pending',
            'email' => 'pending.landlord@example.com',
            'password' => Hash::make('password'),
            'role' => 'landlord',
            'phone' => '+1-555-0104',
            'bio' => 'New landlord awaiting verification.',
            'is_verified' => false,
            'verification_status' => 'pending',
            'email_verified_at' => now(),
        ]);

        // Create Unverified Agent (pending KYC)
        User::create([
            'name' => 'Anna Pending',
            'email' => 'pending.agent@example.com',
            'password' => Hash::make('password'),
            'role' => 'agent',
            'phone' => '+1-555-0204',
            'bio' => 'New agent awaiting verification.',
            'is_verified' => false,
            'verification_status' => 'pending',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Users seeded successfully!');
        $this->command->info('📧 Admin: admin@homekonnect.com | Password: password');
        $this->command->info('📧 Test users created with email format: {name}.{role}@example.com | Password: password');
    }
}
