<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $products = [
            // Electronics (Category ID 1)
            ['tenant_id' => 1, 'category_id' => 1, 'name' => 'Smartphone', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 1, 'name' => 'Laptop', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 1, 'name' => 'Tablet', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 1, 'name' => 'Headphones', 'created_by' => 1],
            // Clothing (Category ID 2)
            ['tenant_id' => 1, 'category_id' => 2, 'name' => 'T-shirt', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 2, 'name' => 'Sweater', 'created_by' => 1],
            // Books (Category ID 3)
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'Fiction Novel', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'Science Book', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'Biography', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'Philosophy', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'History Book', 'created_by' => 1],
            ['tenant_id' => 1, 'category_id' => 3, 'name' => 'Travel Guide', 'created_by' => 1],


            // Toys (Category ID 4)
            ['tenant_id' => 2, 'category_id' => 4, 'name' => 'Action Figure', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 4, 'name' => 'Doll', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 4, 'name' => 'Toy Car', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 4, 'name' => 'Lego Set', 'created_by' => 2],
            // Sports (Category ID 5)
            ['tenant_id' => 2, 'category_id' => 5, 'name' => 'Football', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 5, 'name' => 'Basketball', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 5, 'name' => 'Tennis Racket', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 5, 'name' => 'Baseball Bat', 'created_by' => 2],
            // Groceries (Category ID 6) 
            ['tenant_id' => 2, 'category_id' => 6, 'name' => 'Rice', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 6, 'name' => 'Milk', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 6, 'name' => 'Flour', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 6, 'name' => 'Eggs', 'created_by' => 2],
            // Furniture (Category ID 9)
            ['tenant_id' => 2, 'category_id' => 9, 'name' => 'Sofa', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 9, 'name' => 'Dining Table', 'created_by' => 2],
            ['tenant_id' => 2, 'category_id' => 9, 'name' => 'Bookshelf', 'created_by' => 2],

            // Jewelry (Category ID 13) 
            ['tenant_id' => 3, 'category_id' => 13, 'name' => 'Necklace', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 13, 'name' => 'Earrings', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 13, 'name' => 'Bracelet', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 13, 'name' => 'Ring', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 13, 'name' => 'Watch', 'created_by' => 3],
            // Beverages (Category ID 14) 
            ['tenant_id' => 3, 'category_id' => 14, 'name' => 'Juice', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 14, 'name' => 'Soda', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 14, 'name' => 'Tea', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 14, 'name' => 'Coffee', 'created_by' => 3],
            // Computers (Category ID 15)
            ['tenant_id' => 3, 'category_id' => 15, 'name' => 'Desktop PC', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 15, 'name' => 'Monitor', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 15, 'name' => 'Keyboard', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 15, 'name' => 'Mouse', 'created_by' => 3],
            // Mobile Phones (Category ID 16)
            ['tenant_id' => 3, 'category_id' => 16, 'name' => 'Smartphone', 'created_by' => 3],
            ['tenant_id' => 3, 'category_id' => 16, 'name' => 'Feature Phone', 'created_by' => 3],
        ];

        foreach ($products as $productData) {
            $category = Category::find($productData['category_id']);
            $categoryAbbr = strtoupper(substr($category->name, 0, 4));
            $productNameAbbr = strtoupper(substr($faker->word(), 0, 3));
            $uniqueNumber = $faker->unique()->numberBetween(1, 999);
            $sku = $categoryAbbr . '-' . $productNameAbbr . '-' . str_pad($uniqueNumber, 3, '0', STR_PAD_LEFT);

            Product::create([
                'tenant_id' => $productData['tenant_id'],
                'category_id' => $productData['category_id'],
                'sku' => $sku,
                'name' => $productData['name'],
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 10000),
                'stock' => $faker->numberBetween(1, 100),
                'created_by' => $productData['created_by'],
            ]);
        }
    }
}
