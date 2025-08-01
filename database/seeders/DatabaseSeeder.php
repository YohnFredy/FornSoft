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
        ]);


        $categories = BusinessCategory::factory(10)->create();
        $categoryIds = $categories->pluck('id');

        Business::factory(10) // Queremos 10 empresas
            ->has(BusinessData::factory(), 'data') // Para cada empresa, crea 1 registro de BusinessData usando la relación 'data' del modelo Business
            ->create() // Ejecuta la creación de las empresas y sus datos asociados
            ->each(function ($business) use ($categoryIds) {
                // Después de crear cada empresa, ejecutamos esta función
                // Le asignamos un número aleatorio (entre 1 y 3) de categorías
                $business->categories()->attach(
                    $categoryIds->random(rand(1, 3))
                );
            });
    }
}
