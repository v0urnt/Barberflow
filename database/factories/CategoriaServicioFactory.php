<?php

namespace Database\Factories;

use App\Models\Barberia;
use App\Models\CategoriaServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoriaServicio>
 */
class CategoriaServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barberia_id' => Barberia::factory(),
            'nombre' => $this->faker->unique()->words(2, true),
            'descripcion' => $this->faker->optional()->sentence(),
            'activo' => true,
        ];
    }
}
