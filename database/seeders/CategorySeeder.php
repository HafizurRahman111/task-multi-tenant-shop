<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            ['tenant_id' => 1, 'store_id' => 1, 'name' => 'Electronics', 'created_by' => 1],
            ['tenant_id' => 1, 'store_id' => 1, 'name' => 'Clothing', 'created_by' => 1],
            ['tenant_id' => 1, 'store_id' => 1, 'name' => 'Books', 'created_by' => 1],

            ['tenant_id' => 2, 'store_id' => 2, 'name' => 'Toys', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 2, 'name' => 'Sports', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 4, 'name' => 'Groceries', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 4, 'name' => 'Health & Beauty', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 4, 'name' => 'Food & Beverages', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 5, 'name' => 'Furniture', 'created_by' => 2],
            ['tenant_id' => 2, 'store_id' => 5, 'name' => 'Automotive', 'created_by' => 2],

            ['tenant_id' => 3, 'store_id' => 3, 'name' => 'Office Supplies', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 3, 'name' => 'Pet Supplies', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 3, 'name' => 'Jewelry', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 3, 'name' => 'Beverages', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 6, 'name' => 'Computers', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 6, 'name' => 'Mobile Phones', 'created_by' => 3],
            ['tenant_id' => 3, 'store_id' => 6, 'name' => 'Laptops', 'created_by' => 3],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'tenant_id' => $categoryData['tenant_id'],
                'store_id' => $categoryData['store_id'],
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'created_by' => $categoryData['created_by'],
            ]);
        }
    }
}
