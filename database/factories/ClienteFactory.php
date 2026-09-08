<?php

namespace Database\Factories;

use App\Models\Barberia;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cliente>
 */
class ClienteFactory extends Factory
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
            'nombre_cliente' => $this->faker->firstName(),
            'apellido_cliente' => $this->faker->lastName(),
            'telefono' => $this->faker->numerify('3#########'),
            'email' => $this->faker->optional()->safeEmail(),
            'fecha_nacimiento' => $this->faker->optional()->date(),
            'observaciones' => null,
            'activo' => true,
        ];
    }
}
