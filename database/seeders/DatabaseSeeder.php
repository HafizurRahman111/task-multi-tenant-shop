<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // tenant-1
        $tenant = Tenant::factory()->create([
            'name' => 'Admin Tenant',
            'email' => 'admin@example.com',
        ]);

        // user-1 as an admin
        User::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'shop_name' => 'Admin Shop',
            'password' => bcrypt('admin1234'),
        ]);

        // tenant-2
        $tenant = Tenant::factory()->create([
            'name' => 'Merchant Tenant-1',
            'email' => 'merchant11@example.com',
        ]);

        // user-2 as a merchant-1
        User::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Merchant User-1',
            'email' => 'merchant11@example.com',
            'role' => 'merchant',
            'shop_name' => 'Merchant-1 Shop',
            'password' => bcrypt('merchant11'),
        ]);

        // tenant-3
        $tenant = Tenant::factory()->create([
            'name' => 'Merchant Tenant-2',
            'email' => 'merchant22@example.com',
        ]);

        // user-3 as a merchant-2
        User::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Merchant User-2',
            'email' => 'merchant22@example.com',
            'role' => 'merchant',
            'shop_name' => 'Merchant-2 Shop',
            'password' => bcrypt('merchant22'),
        ]);

        // tenant-4
        $tenant = Tenant::factory()->create([
            'name' => 'Test Tenant Merchant',
            'email' => 'test@example.com',
        ]);


        $this->call([
            StoreSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class
        ]);

        // // Create additional tenants and users
        // Tenant::factory(2)->create()->each(function ($tenant) {
        //     // Ensure only ONE user per tenant
        //     User::factory()->create(['tenant_id' => $tenant->id]);

        //     // Create stores for the tenant
        //     Store::factory(1)->create(['tenant_id' => $tenant->id])->each(function ($store) {
        //         // Create categories under the store
        //         Category::factory(2)->create(['store_id' => $store->id])->each(function ($category) {
        //             // Create products under the category
        //             Product::factory(3)->create(['category_id' => $category->id]);
        //         });
        //     });
        // });

    }

}
