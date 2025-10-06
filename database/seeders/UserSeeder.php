<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superadmin = User::factory()->create([
            'name' => 'alfredo',
            'last_name' => 'correa',
            'dni' => 94154629,
            'username' => 'Lider',
            'email' => 'lider@gmail.com',
            'password' => bcrypt('123'),
        ]);

        // Asignar rol
        $superadmin->assignRole('Superadmin');

        // Crear su respectivo user_data
        UserData::factory()->create([
            'user_id' => $superadmin->id,
        ]);

        // Crear usuarios adicionales con sus datos
        User::factory(5)
            ->create()
            ->each(function ($user) {
                UserData::factory()->create([
                    'user_id' => $user->id,
                ]);
            });
    }
}
