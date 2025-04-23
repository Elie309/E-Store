<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            // Create a default shipping address
            Address::create([
                'user_id' => $user->id,
                'address_line_1' => rand(100, 999) . ' Main Street',
                'address_line_2' => rand(0, 1) ? 'Apt ' . rand(1, 100) : null,
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'US',
                'phone' => '555-' . rand(100, 999) . '-' . rand(1000, 9999),
                'address_type' => 'shipping',
                'is_default' => true,
            ]);
            
            // Create a default billing address
            Address::create([
                'user_id' => $user->id,
                'address_line_1' => rand(100, 999) . ' Billing Avenue',
                'address_line_2' => rand(0, 1) ? 'Suite ' . rand(1, 100) : null,
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'US',
                'phone' => '555-' . rand(100, 999) . '-' . rand(1000, 9999),
                'address_type' => 'billing',
                'is_default' => true,
            ]);
            
            // Some users may have additional addresses
            if (rand(0, 1)) {
                Address::create([
                    'user_id' => $user->id,
                    'address_line_1' => rand(100, 999) . ' Secondary Street',
                    'address_line_2' => null,
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'postal_code' => '90001',
                    'country' => 'US',
                    'phone' => '555-' . rand(100, 999) . '-' . rand(1000, 9999),
                    'address_type' => 'shipping',
                    'is_default' => false,
                ]);
            }
        }
    }
}
