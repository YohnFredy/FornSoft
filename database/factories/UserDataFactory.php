<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserData>
 */
class UserDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // si quieres que cree usuario automáticamente
            'sex' => $this->faker->randomElement(['male', 'female', 'other']),
            'birthdate' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'phone' => $this->faker->phoneNumber(),
            'country_id' => $this->faker->numberBetween(1, 5),
            'department_id' => $this->faker->numberBetween(1, 20),
            'city_id' => $this->faker->numberBetween(1, 100),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
        ];
    }
}
