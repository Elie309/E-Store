<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Create 3-5 images for each product
            $imageCount = rand(3, 5);
            
            for ($i = 0; $i < $imageCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/' . strtolower(str_replace(' ', '-', $product->name)) . '-' . ($i + 1) . '.jpg',
                    'alt_text' => $product->name . ' Image ' . ($i + 1),
                    'order' => $i + 1,
                ]);
            }
        }
    }
}
