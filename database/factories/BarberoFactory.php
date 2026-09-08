<?php

namespace Database\Factories;

use App\Models\Barbero;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barbero>
 */
class BarberoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'especialidad' => $this->faker->optional()->randomElement(['Corte clásico', 'Fade', 'Barba', 'Color']),
            'biografia' => $this->faker->optional()->paragraph(),
            'activo' => true,
        ];
    }
}
