<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::where('is_active', true)->get();
        
        foreach ($users as $user) {
            // Add 0-5 products to wishlist
            $wishlistCount = rand(0, 5);
            $selectedProducts = $products->random($wishlistCount);
            
            foreach ($selectedProducts as $product) {
                Wishlist::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
