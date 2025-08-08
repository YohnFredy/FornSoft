<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessData>
 */
class BusinessDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'business_id' => \App\Models\Business::factory(),
            'phone' => $this->faker->phoneNumber(),
            'whatsapp' => $this->faker->phoneNumber(),
            'website_url' => $this->faker->url(),
            'business_email' => $this->faker->companyEmail(),
            'description' => $this->faker->paragraph(),

            'country_id' => 1, // puedes reemplazar con tu lógica real
            'department_id' => 1,
            'city_id' => 1,
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),

            'facebook_url' => $this->faker->url(),
            'instagram_url' => $this->faker->url(),
            'linkedin_url' => $this->faker->url(),
            'youtube_url' => $this->faker->url(),
            'tiktok_url' => $this->faker->url(),
            'x_url' => $this->faker->url(),

            'promo_video_url' => $this->faker->url(),
            'additional_videos' => json_encode([$this->faker->url(), $this->faker->url()]),
            'custom_links' => json_encode([
                ['title' => 'Catálogo PDF', 'url' => $this->faker->url()],
            ]),
        ];
    }
}
