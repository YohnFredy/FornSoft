<?php

namespace Database\Seeders;

use App\Models\StoreType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       StoreType::insert([
            ['name' => 'online', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'physical', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
