<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Color',
                'code' => 'color',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => true,
            ],
            [
                'name' => 'Size',
                'code' => 'size',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => true,
            ],
            [
                'name' => 'Material',
                'code' => 'material',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => false,
            ],
            [
                'name' => 'Weight',
                'code' => 'weight',
                'type' => 'text',
                'is_filterable' => false,
                'is_required' => false,
            ],
            [
                'name' => 'Storage',
                'code' => 'storage',
                'type' => 'select',
                'is_filterable' => true,
                'is_required' => false,
            ],
        ];

        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }
    }
}
