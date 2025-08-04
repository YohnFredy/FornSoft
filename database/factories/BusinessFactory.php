<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static ?string $password;
    public function definition(): array
    {
          return [
            'name' => fake()->unique()->company(), // Genera un nombre de empresa único
            'slug' => Str::slug($this->faker->unique()->word),
            'nit' => fake()->unique()->numerify('#########-#'), // Genera un NIT falso como 987654321-0
            'user_id' => 1,

            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
