<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\BusinessData;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            RegisterRedSeeder::class,
            CategorySeeder::class,
            ImageSeeder::class,
            StoreTypeSeeder::class,
        ]);

        /* BusinessCategory::factory(10)->create();

        Business::factory(20)->create()->each(function ($business) {
            // Business Data
            $businessData = BusinessData::factory()->create([
                'business_id' => $business->id
            ]);

            // Relación many-to-many con categorías
            $categoryIds = \App\Models\BusinessCategory::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $business->categories()->attach($categoryIds);

            // Relación many-to-many con store types (1, 2 o ambos)
            $storeTypeOptions = [
                [1],
                [2],
                [1, 2]
            ];
            $storeTypeIds = collect($storeTypeOptions)->random();

            $businessData->storeTypes()->sync($storeTypeIds);
        }); */
    }
}
