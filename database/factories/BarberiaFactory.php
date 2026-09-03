<?php

namespace Database\Factories;

use App\Models\Barberia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Barberia>
 */
class BarberiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'telefono' => $this->faker->numerify('3#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'descripcion' => $this->faker->sentence(),
            'logo' => $this->faker->boolean(80) ? 'logos/' . $this->faker->uuid() . '.png': null,
            'activo' => $this->faker->boolean(90),
        ];
    }
}
