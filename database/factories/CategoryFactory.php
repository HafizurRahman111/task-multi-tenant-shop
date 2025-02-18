<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'tenant_id' => \App\Models\Tenant::inRandomOrder()->first()?->id ?? \App\Models\Tenant::factory(),
            'store_id' => \App\Models\Store::factory(),
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
