<?php

namespace Database\Factories;

use App\Models\Barberia;
use App\Models\CategoriaServicio;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Servicio>
 */
class ServicioFactory extends Factory
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
            'categoria_servicio_id' => fn (array $attributes) => CategoriaServicio::factory()->create([
                'barberia_id' => $attributes['barberia_id'],
            ]),
            'nombre_servicio' => $this->faker->unique()->words(3, true),
            'descripcion' => $this->faker->optional()->sentence(),
            'precio' => $this->faker->randomFloat(2, 5, 200),
            'duracion_minutos' => $this->faker->numberBetween(1, 24) * 5,
            'activo' => true,
        ];
    }
}
