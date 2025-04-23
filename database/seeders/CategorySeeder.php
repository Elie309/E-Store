<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parent categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'All electronic devices and accessories',
            'parent_id' => null,
            'order' => 1,
            'is_active' => true,
        ]);

        $clothing = Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'description' => 'All types of clothing and apparel',
            'parent_id' => null,
            'order' => 2,
            'is_active' => true,
        ]);

        $homeKitchen = Category::create([
            'name' => 'Home & Kitchen',
            'slug' => 'home-kitchen',
            'description' => 'Everything for your home',
            'parent_id' => null,
            'order' => 3,
            'is_active' => true,
        ]);

        // Electronic subcategories
        $categories = [
            [
                'name' => 'Smartphones',
                'description' => 'Mobile phones and accessories',
                'parent_id' => $electronics->id,
                'order' => 1,
            ],
            [
                'name' => 'Laptops',
                'description' => 'Notebooks, ultrabooks, and gaming laptops',
                'parent_id' => $electronics->id,
                'order' => 2,
            ],
            [
                'name' => 'Audio',
                'description' => 'Headphones, speakers, and sound systems',
                'parent_id' => $electronics->id,
                'order' => 3,
            ],
            
            // Clothing subcategories
            [
                'name' => 'Men',
                'description' => 'Clothing for men',
                'parent_id' => $clothing->id,
                'order' => 1,
            ],
            [
                'name' => 'Women',
                'description' => 'Clothing for women',
                'parent_id' => $clothing->id,
                'order' => 2,
            ],
            [
                'name' => 'Kids',
                'description' => 'Clothing for kids',
                'parent_id' => $clothing->id,
                'order' => 3,
            ],
            
            // Home & Kitchen subcategories
            [
                'name' => 'Furniture',
                'description' => 'Tables, chairs, sofas, and more',
                'parent_id' => $homeKitchen->id,
                'order' => 1,
            ],
            [
                'name' => 'Kitchen Appliances',
                'description' => 'Appliances for your kitchen',
                'parent_id' => $homeKitchen->id,
                'order' => 2,
            ],
            [
                'name' => 'Bedding',
                'description' => 'Sheets, pillows, and mattresses',
                'parent_id' => $homeKitchen->id,
                'order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'parent_id' => $category['parent_id'],
                'order' => $category['order'],
                'is_active' => true,
            ]);
        }
    }
}
