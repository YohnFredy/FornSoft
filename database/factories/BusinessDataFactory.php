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
            'business_email' => $this->faker->safeEmail(),
            'website_url' => $this->faker->url(),
            'description' => $this->faker->paragraph(),

            // Ubicación

            'country_id' => 1,
            'department_id' => 1,
            'city' => 'cali',
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

            'additional_videos' => [
                'https://youtu.be/43kJpw26dKg?si=M6GfRhhnbQmWtRaS',
                'https://youtu.be/fQjFowjh34E?si=aOpN_lQg6v-eEUvc',
                'https://youtu.be/i0FHB_o5akA?si=0B6qXRS_z_9t93ia',
            ],

            // Enlaces personalizados
            'custom_links' => [
                [
                    'url' => 'https://catalogo.grupohinode.com/colombia/?page=1',
                    'title' => 'Catalogo Hinode',
                ],
                [
                    'url' => 'https://co.oriflame.com/products/digital-catalogue-current?PageNumber=1',
                    'title' => 'Catalogo oriflame',
                ],
            ],
        ];
    }
}
