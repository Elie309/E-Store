<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(5)->get();
        $products = Product::where('is_active', true)->where('stock_status', 'in_stock')->get();

        foreach ($users as $user) {
            // Create cart for user
            $cart = Cart::create([
                'session_id' => Str::random(40),
                'user_id' => $user->id,
            ]);

            // Add 1-4 random products to cart
            $itemCount = rand(1, 4);
            $selectedProducts = $products->random($itemCount);

            foreach ($selectedProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $product->price,
                    'attributes' => json_encode([
                        'color' => 'blue',
                        'size' => 'medium'
                    ]),
                ]);
            }
        }

        // Create some abandoned carts (without user_id)
        for ($i = 0; $i < 5; $i++) {
            $cart = Cart::create([
                'session_id' => Str::random(40),
            ]);

            // Add 1-3 random products to cart
            $itemCount = rand(1, 3);
            $selectedProducts = $products->random($itemCount);

            foreach ($selectedProducts as $product) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 2),
                    'price' => $product->price,
                    'attributes' => json_encode([
                        'color' => 'red',
                        'size' => 'small'
                    ]),
                ]);
            }
        }
    }
}
