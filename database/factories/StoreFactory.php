<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'tenant_id' => \App\Models\Tenant::factory(),
            'name' => $name = $this->faker->company,
            'slug' => Str::slug($name, '_') . '_' . Str::random(6),
            'website' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
