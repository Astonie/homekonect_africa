<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PropertySeeder::class,
            KycVerificationSeeder::class,
        ]);

        $this->command->info('🎉 All seeders completed successfully!');
        $this->command->info('');
        $this->command->info('📧 Login credentials:');
        $this->command->info('   Admin: admin@homekonnect.com / password');
        $this->command->info('   Landlord: john.landlord@example.com / password');
        $this->command->info('   Agent: emily.agent@example.com / password');
        $this->command->info('   Tenant: robert.tenant@example.com / password');
    }
}
