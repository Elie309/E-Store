<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributeValues = [
            // Color values
            'color' => [
                ['value' => 'red', 'label' => 'Red', 'order' => 1],
                ['value' => 'blue', 'label' => 'Blue', 'order' => 2],
                ['value' => 'green', 'label' => 'Green', 'order' => 3],
                ['value' => 'black', 'label' => 'Black', 'order' => 4],
                ['value' => 'white', 'label' => 'White', 'order' => 5],
            ],
            // Size values
            'size' => [
                ['value' => 'xs', 'label' => 'XS', 'order' => 1],
                ['value' => 's', 'label' => 'S', 'order' => 2],
                ['value' => 'm', 'label' => 'M', 'order' => 3],
                ['value' => 'l', 'label' => 'L', 'order' => 4],
                ['value' => 'xl', 'label' => 'XL', 'order' => 5],
            ],
            // Material values
            'material' => [
                ['value' => 'cotton', 'label' => 'Cotton', 'order' => 1],
                ['value' => 'polyester', 'label' => 'Polyester', 'order' => 2],
                ['value' => 'leather', 'label' => 'Leather', 'order' => 3],
                ['value' => 'metal', 'label' => 'Metal', 'order' => 4],
                ['value' => 'wood', 'label' => 'Wood', 'order' => 5],
            ],
            // Storage values
            'storage' => [
                ['value' => '64gb', 'label' => '64GB', 'order' => 1],
                ['value' => '128gb', 'label' => '128GB', 'order' => 2],
                ['value' => '256gb', 'label' => '256GB', 'order' => 3],
                ['value' => '512gb', 'label' => '512GB', 'order' => 4],
                ['value' => '1tb', 'label' => '1TB', 'order' => 5],
            ],
        ];

        foreach ($attributeValues as $code => $values) {
            $attribute = Attribute::where('code', $code)->first();
            
            if ($attribute) {
                foreach ($values as $value) {
                    AttributeValue::create([
                        'attribute_id' => $attribute->id,
                        'value' => $value['value'],
                        'label' => $value['label'],
                        'order' => $value['order'],
                    ]);
                }
            }
        }
    }
}
