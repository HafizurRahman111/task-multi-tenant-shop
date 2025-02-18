<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $category = \App\Models\Category::inRandomOrder()->first();
        $categoryAbbr = strtoupper(substr($category->name, 0, 4));

        $productNameAbbr = strtoupper(substr($this->faker->word(), 0, 3));

        $uniqueNumber = $this->faker->unique()->numberBetween(1, 999);

        $sku = $categoryAbbr . '-' . $productNameAbbr . '-' . str_pad($uniqueNumber, 3, '0', STR_PAD_LEFT);

        return [
            'tenant_id' => \App\Models\Tenant::inRandomOrder()->first()?->id ?? \App\Models\Tenant::factory(),
            'category_id' => \App\Models\Category::factory(),
            'sku' => $sku,
            'name' => $this->faker->word(3),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(1, 100),
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
