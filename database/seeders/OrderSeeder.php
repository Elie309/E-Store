<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(5)->get();
        $products = Product::where('is_active', true)->get();
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer'];
        $paymentStatuses = ['paid', 'pending', 'failed'];

        foreach ($users as $user) {
            // Create 1-3 orders per user
            $orderCount = rand(1, 3);
            
            for ($i = 0; $i < $orderCount; $i++) {
                $status = $statuses[array_rand($statuses)];
                $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
                $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
                
                // Calculate some random values for order financials
                $subtotal = 0;
                $tax = 0;
                $shipping = rand(5, 15);
                $discount = rand(0, 10);
                
                // Create order
                $order = Order::create([
                    'order_number' => 'ORD-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                    'user_id' => $user->id,
                    'status' => $status,
                    'subtotal' => $subtotal, // Will be updated after adding items
                    'tax' => $tax,
                    'shipping' => $shipping,
                    'discount' => $discount,
                    'total' => $subtotal + $tax + $shipping - $discount,
                    'payment_method' => $paymentMethod,
                    'payment_status' => $paymentStatus,
                    'currency' => 'USD',
                    'shipping_name' => $user->name,
                    'shipping_address' => '123 Shipping Street',
                    'shipping_city' => 'Shipping City',
                    'shipping_state' => 'Shipping State',
                    'shipping_postal_code' => '12345',
                    'shipping_country' => 'US',
                    'shipping_phone' => '555-123-4567',
                    'billing_name' => $user->name,
                    'billing_address' => '123 Billing Street',
                    'billing_city' => 'Billing City',
                    'billing_state' => 'Billing State',
                    'billing_postal_code' => '12345',
                    'billing_country' => 'US',
                    'billing_phone' => '555-123-4567',
                    'notes' => rand(0, 1) ? 'Please leave package at the door.' : null,
                ]);

                // Add 1-5 items to order
                $itemCount = rand(1, 5);
                $selectedProducts = $products->random($itemCount);
                
                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 3);
                    $price = $product->price;
                    $itemSubtotal = $price * $quantity;
                    $subtotal += $itemSubtotal;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'sku' => $product->sku,
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $itemSubtotal,
                        'attributes' => json_encode([
                            'color' => 'blue',
                            'size' => 'medium'
                        ]),
                    ]);
                }
                
                // Calculate tax
                $tax = round($subtotal * 0.1, 2);
                
                // Update order with correct financial values
                $order->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $subtotal + $tax + $shipping - $discount,
                ]);
                
                // Add order status history
                if ($status == 'pending') {
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'pending',
                        'comment' => 'Order created',
                        'updated_by' => null,
                    ]);
                } else if ($status == 'processing') {
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'pending',
                        'comment' => 'Order created',
                        'updated_by' => null,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'processing',
                        'comment' => 'Payment received, processing order',
                        'updated_by' => 1, // Admin user
                    ]);
                } else if ($status == 'shipped') {
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'pending',
                        'comment' => 'Order created',
                        'updated_by' => null,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'processing',
                        'comment' => 'Payment received, processing order',
                        'updated_by' => 1,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'shipped',
                        'comment' => 'Order shipped via UPS, tracking: TRK' . rand(1000000, 9999999),
                        'updated_by' => 1,
                    ]);
                } else if ($status == 'delivered') {
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'pending',
                        'comment' => 'Order created',
                        'updated_by' => null,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'processing',
                        'comment' => 'Payment received, processing order',
                        'updated_by' => 1,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'shipped',
                        'comment' => 'Order shipped via UPS, tracking: TRK' . rand(1000000, 9999999),
                        'updated_by' => 1,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'delivered',
                        'comment' => 'Order delivered',
                        'updated_by' => 1,
                    ]);
                } else if ($status == 'cancelled') {
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'pending',
                        'comment' => 'Order created',
                        'updated_by' => null,
                    ]);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'status' => 'cancelled',
                        'comment' => 'Order cancelled by customer',
                        'updated_by' => $user->id,
                    ]);
                }
            }
        }
    }
}
