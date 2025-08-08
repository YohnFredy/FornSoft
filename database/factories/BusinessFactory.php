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

    public function definition(): array
    {
        $name = $this->faker->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'nit' => $this->faker->unique()->numerify('#########'),
            'user_id' => \App\Models\User::factory(),
            'minimum_percentage' => $this->faker->randomFloat(2, 0, 10),
            'maximum_percentage' => $this->faker->randomFloat(2, 10, 20),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'is_active' => $this->faker->boolean(90),
            'remember_token' => Str::random(10),
        ];
    }
}
