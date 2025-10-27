<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get verified landlords and agents
        $landlords = User::where('role', 'landlord')
            ->where('is_verified', true)
            ->get();

        $agents = User::where('role', 'agent')
            ->where('is_verified', true)
            ->get();

        if ($landlords->isEmpty() && $agents->isEmpty()) {
            $this->command->error('❌ No verified landlords or agents found. Please run UserSeeder first.');
            return;
        }

        $properties = [
            // Luxury Properties
            [
                'title' => 'Modern Luxury Penthouse Downtown',
                'description' => 'Stunning penthouse with panoramic city views. Features floor-to-ceiling windows, smart home technology, and premium finishes throughout. Includes private rooftop terrace with infinity pool and outdoor kitchen.',
                'type' => 'apartment',
                'listing_type' => 'rent',
                'address' => '1234 Park Avenue, Floor 40',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10001',
                'bedrooms' => 3,
                'bathrooms' => 3.5,
                'square_feet' => 3500,
                'year_built' => 2023,
                'floors' => 1,
                'furnished' => true,
                'price' => 8500.00,
                'security_deposit' => 17000.00,
                'maintenance_fee' => 1200.00,
                'amenities' => ['pool', 'gym', 'concierge', 'parking', 'rooftop_terrace', 'smart_home', 'doorman'],
                'images' => [
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
                ],
                'status' => 'available',
                'available_from' => now()->addDays(15),
                'lease_duration' => 12,
                'is_featured' => true,
                'is_verified' => true,
                'published_at' => now(),
            ],
            
            // Family Homes
            [
                'title' => 'Spacious Family Home with Backyard',
                'description' => 'Beautiful 4-bedroom family home in quiet suburban neighborhood. Large backyard perfect for children and pets. Recently renovated kitchen with granite countertops and stainless steel appliances. Close to top-rated schools.',
                'type' => 'house',
                'listing_type' => 'rent',
                'address' => '567 Maple Street',
                'city' => 'Austin',
                'state' => 'TX',
                'zip_code' => '78701',
                'bedrooms' => 4,
                'bathrooms' => 2.5,
                'square_feet' => 2800,
                'year_built' => 2015,
                'floors' => 2,
                'furnished' => false,
                'price' => 3200.00,
                'security_deposit' => 3200.00,
                'maintenance_fee' => 0,
                'amenities' => ['backyard', 'garage', 'fireplace', 'central_ac', 'dishwasher', 'laundry'],
                'images' => [
                    'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800',
                ],
                'status' => 'available',
                'available_from' => now(),
                'lease_duration' => 12,
                'is_featured' => true,
                'is_verified' => true,
                'published_at' => now(),
            ],

            // Affordable Apartments
            [
                'title' => 'Cozy Studio Near University Campus',
                'description' => 'Perfect for students! Affordable studio apartment within walking distance of university. Includes all utilities. Bright and airy with efficient layout. Laundry facilities on-site.',
                'type' => 'studio',
                'listing_type' => 'rent',
                'address' => '890 College Avenue, Apt 3B',
                'city' => 'Boston',
                'state' => 'MA',
                'zip_code' => '02115',
                'bedrooms' => 0,
                'bathrooms' => 1,
                'square_feet' => 450,
                'year_built' => 2010,
                'floors' => 1,
                'furnished' => false,
                'price' => 1400.00,
                'security_deposit' => 1400.00,
                'maintenance_fee' => 100.00,
                'amenities' => ['laundry', 'internet', 'heating', 'near_transit'],
                'images' => [
                    'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
                ],
                'status' => 'available',
                'available_from' => now()->addDays(30),
                'lease_duration' => 9,
                'is_featured' => false,
                'is_verified' => true,
                'published_at' => now(),
            ],

            [
                'title' => 'Modern 2BR Apartment with City Views',
                'description' => 'Contemporary apartment featuring open floor plan, modern kitchen with island, and stunning city views. In-unit washer/dryer. Pet-friendly building with 24/7 security.',
                'type' => 'apartment',
                'listing_type' => 'rent',
                'address' => '456 Market Street, Unit 1205',
                'city' => 'San Francisco',
                'state' => 'CA',
                'zip_code' => '94102',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'square_feet' => 1200,
                'year_built' => 2020,
                'floors' => 1,
                'furnished' => false,
                'price' => 4500.00,
                'security_deposit' => 4500.00,
                'maintenance_fee' => 250.00,
                'amenities' => ['gym', 'parking', 'pet_friendly', 'laundry_in_unit', 'balcony', 'security'],
                'images' => [
                    'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
                    'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800',
                ],
                'status' => 'available',
                'available_from' => now()->addDays(7),
                'lease_duration' => 12,
                'is_featured' => true,
                'is_verified' => true,
                'published_at' => now(),
            ],

            // Condos
            [
                'title' => 'Waterfront Condo with Marina Access',
                'description' => 'Luxury waterfront living at its finest. Direct marina access for boat owners. Floor-to-ceiling windows overlooking the bay. Resort-style amenities including pool, spa, and fitness center.',
                'type' => 'condo',
                'listing_type' => 'sale',
                'address' => '789 Harbor Drive, Unit 501',
                'city' => 'Miami',
                'state' => 'FL',
                'zip_code' => '33131',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'square_feet' => 1800,
                'year_built' => 2021,
                'floors' => 1,
                'furnished' => false,
                'price' => 750000.00,
                'security_deposit' => 0,
                'maintenance_fee' => 450.00,
                'amenities' => ['pool', 'gym', 'spa', 'parking', 'marina', 'security', 'concierge'],
                'images' => [
                    'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
                    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
                ],
                'status' => 'available',
                'available_from' => now(),
                'lease_duration' => null,
                'is_featured' => true,
                'is_verified' => true,
                'published_at' => now(),
            ],

            // Townhouses
            [
                'title' => 'Charming Townhouse in Historic District',
                'description' => 'Beautifully restored townhouse in the heart of the historic district. Original hardwood floors and crown molding. Private patio and rooftop deck. Walking distance to restaurants and shops.',
                'type' => 'townhouse',
                'listing_type' => 'rent',
                'address' => '234 Heritage Lane',
                'city' => 'Charleston',
                'state' => 'SC',
                'zip_code' => '29401',
                'bedrooms' => 3,
                'bathrooms' => 2.5,
                'square_feet' => 2200,
                'year_built' => 1890,
                'floors' => 3,
                'furnished' => false,
                'price' => 2800.00,
                'security_deposit' => 2800.00,
                'maintenance_fee' => 0,
                'amenities' => ['patio', 'rooftop', 'hardwood_floors', 'fireplace', 'parking'],
                'images' => [
                    'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=800',
                ],
                'status' => 'available',
                'available_from' => now()->addDays(20),
                'lease_duration' => 12,
                'is_featured' => false,
                'is_verified' => true,
                'published_at' => now(),
            ],

            // Villa
            [
                'title' => 'Mediterranean Villa with Pool',
                'description' => 'Stunning Mediterranean-style villa featuring 5 bedrooms, gourmet kitchen, wine cellar, and home theater. Outdoor living at its finest with resort-style pool, spa, and summer kitchen. Lush landscaping and mountain views.',
                'type' => 'villa',
                'listing_type' => 'sale',
                'address' => '1000 Vista Point Drive',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'zip_code' => '90210',
                'bedrooms' => 5,
                'bathrooms' => 4.5,
                'square_feet' => 5500,
                'year_built' => 2019,
                'floors' => 2,
                'furnished' => false,
                'price' => 3500000.00,
                'security_deposit' => 0,
                'maintenance_fee' => 0,
                'amenities' => ['pool', 'spa', 'wine_cellar', 'home_theater', 'outdoor_kitchen', 'garage', 'smart_home', 'gym'],
                'images' => [
                    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800',
                ],
                'status' => 'available',
                'available_from' => now(),
                'lease_duration' => null,
                'is_featured' => true,
                'is_verified' => true,
                'published_at' => now(),
            ],

            // Pending/Rented Properties
            [
                'title' => 'Downtown Loft - Recently Rented',
                'description' => 'Industrial-style loft with exposed brick and high ceilings. Open concept living with modern updates. Great location in trendy downtown area.',
                'type' => 'apartment',
                'listing_type' => 'rent',
                'address' => '345 Industrial Boulevard, Loft 8',
                'city' => 'Seattle',
                'state' => 'WA',
                'zip_code' => '98101',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'square_feet' => 900,
                'year_built' => 2005,
                'floors' => 1,
                'furnished' => false,
                'price' => 2400.00,
                'security_deposit' => 2400.00,
                'maintenance_fee' => 150.00,
                'amenities' => ['parking', 'pet_friendly', 'laundry'],
                'images' => [
                    'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
                ],
                'status' => 'rented',
                'available_from' => now()->subDays(30),
                'lease_duration' => 12,
                'is_featured' => false,
                'is_verified' => true,
                'published_at' => now()->subDays(45),
            ],
        ];

        // Distribute properties among verified landlords and agents
        $owners = $landlords->merge($agents);
        
        foreach ($properties as $index => $propertyData) {
            $owner = $owners[$index % $owners->count()];
            
            Property::create(array_merge($propertyData, [
                'user_id' => $owner->id,
            ]));
        }

        $this->command->info('✅ Properties seeded successfully!');
        $this->command->info('📊 Created ' . count($properties) . ' properties');
    }
}
