<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'tenant_id' => 1,
                'name' => 'Store One',
                'phone' => '123-456-7890',
                'created_by' => 1,
            ],
            [
                'tenant_id' => 2,
                'name' => 'Store Two',
                'phone' => '987-654-3210',
                'created_by' => 2,
            ],
            [
                'tenant_id' => 3,
                'name' => 'Store Three',
                'phone' => '555-123-4567',
                'created_by' => 3,
            ],
            [
                'tenant_id' => 2,
                'name' => 'Store Four',
                'phone' => '321-654-9870',
                'created_by' => 2,
            ],
            [
                'tenant_id' => 2,
                'name' => 'Store Five',
                'phone' => '654-321-7890',
                'created_by' => 2,
            ],
            [
                'tenant_id' => 3,
                'name' => 'Store Six',
                'phone' => '',
                'created_by' => 3,
            ],
        ];

        $baseDomain = 'localhost:8000';

        foreach ($stores as $storeData) {
            $slug = $this->generateSlug($storeData['name']);

            $websiteUrl = $this->generateWebsiteUrl($slug, $baseDomain);

            Store::create([
                'tenant_id' => $storeData['tenant_id'],
                'name' => $storeData['name'],
                'slug' => Str::slug($storeData['name'], '_'),
                'website' => $websiteUrl,
                'phone' => $storeData['phone'],
                'created_by' => $storeData['created_by'],
            ]);
        }
    }


    private function generateSlug($storeName)
    {
        return Str::slug($storeName, '_');
    }

    private function generateWebsiteUrl($slug, $baseDomain)
    {
        $protocol = 'http';

        return "{$protocol}://{$slug}.{$baseDomain}/home";
    }
}
