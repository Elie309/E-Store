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
            CategorySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            AddressSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
