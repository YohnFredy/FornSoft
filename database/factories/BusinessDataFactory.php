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
    public function definition(): array
    {

        return [
            // Información básica
            'store_type' => $this->faker->randomElement(['online', 'physical', 'hybrid']),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'website_url' => $this->faker->url(),
            'description' => $this->faker->paragraph(),

            // Ubicación
            'country' => 'Colombia',
            'department' => $this->faker->state(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),


            'latitude' => 3.4707424,
            'longitude' => -76.5275020,

            // Redes sociales
            'facebook_url' => 'https://facebook.com/' . $this->faker->userName(),
            'instagram_url' => 'https://instagram.com/' . $this->faker->userName(),
            'linkedin_url' => 'https://linkedin.com/company/' . $this->faker->slug(),
            'youtube_url' => 'https://youtube.com/channel/' . $this->faker->uuid(),
            'tiktok_url' => 'https://tiktok.com/@' . $this->faker->userName(),
            'x_url' => 'https://x.com/' . $this->faker->userName(),

            // Videos
            'promo_video_url' => 'https://www.youtube.com/embed/' . $this->faker->uuid(),
            'additional_videos' => json_encode([
                'https://www.youtube.com/embed/' . $this->faker->uuid(),
                'https://www.youtube.com/embed/' . $this->faker->uuid(),
            ]),

            // Enlaces personalizados
            'custom_links' => json_encode([
                ['label' => 'Catálogo PDF', 'url' => $this->faker->url()],
                ['label' => 'Landing page', 'url' => $this->faker->url()],
            ]),
        ];
    }
}
