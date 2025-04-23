<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $smartphones = Category::where('name', 'Smartphones')->first();
        $laptops = Category::where('name', 'Laptops')->first();
        $mens = Category::where('name', 'Men')->first();
        $womens = Category::where('name', 'Women')->first();
        $furniture = Category::where('name', 'Furniture')->first();

        // Get attributes and values
        $colorAttr = Attribute::where('code', 'color')->first();
        $sizeAttr = Attribute::where('code', 'size')->first();
        $storageAttr = Attribute::where('code', 'storage')->first();
        $materialAttr = Attribute::where('code', 'material')->first();

        // Electronic products
        $products = [
            // Smartphones
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'The latest iPhone with incredible performance and camera capabilities.',
                'short_description' => 'Latest Apple flagship phone',
                'price' => 999.99,
                'compare_price' => 1099.99,
                'cost' => 750.00,
                'sku' => 'IP15PRO-001',
                'is_active' => true,
                'stock_quantity' => 100,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/iphone15.jpg',
                'category_id' => $smartphones->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'black')->first()->id],
                    [$storageAttr->id => AttributeValue::where('value', '256gb')->first()->id]
                ]
            ],
            [
                'name' => 'Samsung Galaxy S23',
                'description' => 'Samsung\'s flagship phone with excellent performance and camera.',
                'short_description' => 'Feature-packed Android phone',
                'price' => 899.99,
                'compare_price' => 949.99,
                'cost' => 650.00,
                'sku' => 'SGS23-001',
                'is_active' => true,
                'stock_quantity' => 85,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/galaxys23.jpg',
                'category_id' => $smartphones->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'blue')->first()->id],
                    [$storageAttr->id => AttributeValue::where('value', '128gb')->first()->id]
                ]
            ],
            
            // Laptops
            [
                'name' => 'MacBook Pro 16"',
                'description' => 'Powerful laptop for professionals and creatives.',
                'short_description' => 'High-performance Apple laptop',
                'price' => 2499.99,
                'compare_price' => 2699.99,
                'cost' => 1900.00,
                'sku' => 'MBP16-001',
                'is_active' => true,
                'stock_quantity' => 50,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/macbookpro.jpg',
                'category_id' => $laptops->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'silver')->first()->id ?? AttributeValue::where('value', 'white')->first()->id],
                    [$storageAttr->id => AttributeValue::where('value', '512gb')->first()->id]
                ]
            ],
            
            // Clothing - Men
            [
                'name' => 'Classic Fit T-Shirt',
                'description' => 'Comfortable cotton t-shirt for everyday wear.',
                'short_description' => 'Comfortable men\'s t-shirt',
                'price' => 24.99,
                'compare_price' => 29.99,
                'cost' => 10.00,
                'sku' => 'MTSHIRT-001',
                'is_active' => true,
                'stock_quantity' => 200,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/mentshirt.jpg',
                'category_id' => $mens->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'blue')->first()->id],
                    [$sizeAttr->id => AttributeValue::where('value', 'm')->first()->id],
                    [$materialAttr->id => AttributeValue::where('value', 'cotton')->first()->id]
                ]
            ],
            
            // Clothing - Women
            [
                'name' => 'Summer Dress',
                'description' => 'Light and comfortable dress perfect for summer days.',
                'short_description' => 'Light summer dress',
                'price' => 59.99,
                'compare_price' => 69.99,
                'cost' => 25.00,
                'sku' => 'WDRESS-001',
                'is_active' => true,
                'stock_quantity' => 150,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/summerdress.jpg',
                'category_id' => $womens->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'red')->first()->id],
                    [$sizeAttr->id => AttributeValue::where('value', 's')->first()->id],
                    [$materialAttr->id => AttributeValue::where('value', 'cotton')->first()->id]
                ]
            ],
            
            // Furniture
            [
                'name' => 'Modern Coffee Table',
                'description' => 'Elegant coffee table with a modern design, perfect for any living room.',
                'short_description' => 'Stylish modern coffee table',
                'price' => 199.99,
                'compare_price' => 249.99,
                'cost' => 120.00,
                'sku' => 'FTABLE-001',
                'is_active' => true,
                'stock_quantity' => 30,
                'track_inventory' => true,
                'stock_status' => 'in_stock',
                'featured_image' => 'products/coffeetable.jpg',
                'category_id' => $furniture->id,
                'attributes' => [
                    [$colorAttr->id => AttributeValue::where('value', 'black')->first()->id],
                    [$materialAttr->id => AttributeValue::where('value', 'wood')->first()->id]
                ]
            ],
        ];

        foreach ($products as $productData) {
            $attributes = $productData['attributes'] ?? [];
            unset($productData['attributes']);
            unset($productData['category_id']);
            
            // Create slug from name
            $productData['slug'] = Str::slug($productData['name']);
            
            // Create the product
            $product = Product::create($productData);
            
            // Attach category
            if (isset($productData['category_id'])) {
                $product->categories()->attach($productData['category_id']);
            }
            
            // Attach attributes and values
            foreach ($attributes as $attribute) {
                foreach ($attribute as $attributeId => $valueId) {
                    $product->attributes()->attach($attributeId, ['attribute_value_id' => $valueId]);
                    $product->attributeValues()->attach($valueId);
                }
            }
        }

        // Generate additional random products
        for ($i = 0; $i < 20; $i++) {
            $name = 'Product ' . ($i + 1);
            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Detailed description for ' . $name,
                'short_description' => 'Short description for ' . $name,
                'price' => rand(10, 1000),
                'compare_price' => rand(10, 1000),
                'cost' => rand(5, 500),
                'sku' => 'SKU-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'is_active' => true,
                'stock_quantity' => rand(0, 100),
                'track_inventory' => true,
                'stock_status' => rand(0, 10) > 2 ? 'in_stock' : 'out_of_stock',
                'featured_image' => 'products/default-product.jpg',
            ]);

            // Attach random category
            $product->categories()->attach(Category::inRandomOrder()->first()->id);
        }
    }
}
