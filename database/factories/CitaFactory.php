<?php

namespace Database\Factories;

use App\Models\Barberia;
use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\EstadoCita;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cita>
 */
class CitaFactory extends Factory
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
            'cliente_id' => fn (array $attributes) => Cliente::factory()->create([
                'barberia_id' => $attributes['barberia_id'],
            ]),
            'barbero_id' => fn (array $attributes) => Barbero::factory()->create([
                'user_id' => User::factory()->create([
                    'barberia_id' => $attributes['barberia_id'],
                ]),
            ]),
            'estado_cita_id' => fn () => EstadoCita::query()->firstOrCreate(
                ['nombre' => 'pendiente'],
                ['descripcion' => 'La cita ha sido creada y está pendiente de confirmación.', 'activo' => true],
            ),
            'fecha' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'hora_inicio' => '10:00',
            'hora_fin' => '11:00',
            'observaciones' => null,
        ];
    }
}
