<?php

namespace Database\Seeders;

use App\Models\EstadoCita;
use Illuminate\Database\Seeder;

class EstadoCitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoCita::query()->upsert([
            [
                'nombre' => 'pendiente',
                'descripcion' => 'La cita ha sido creada y está pendiente de confirmación.',
                'activo' => true,
            ],
            [
                'nombre' => 'confirmada',
                'descripcion' => 'La cita ha sido confirmada por el cliente o la barbería.',
                'activo' => true,
            ],
            [
                'nombre' => 'en_espera',
                'descripcion' => 'El cliente se encuentra en la barbería esperando ser atendido.',
                'activo' => true,
            ],
            [
                'nombre' => 'en_proceso',
                'descripcion' => 'El servicio de la cita se encuentra actualmente en proceso.',
                'activo' => true,
            ],
            [
                'nombre' => 'completada',
                'descripcion' => 'La cita y todos los servicios asociados han sido completados.',
                'activo' => true,
            ],
            [
                'nombre' => 'cancelada_cliente',
                'descripcion' => 'La cita fue cancelada por el cliente.',
                'activo' => true,
            ],
            [
                'nombre' => 'cancelada_barberia',
                'descripcion' => 'La cita fue cancelada por la barbería.',
                'activo' => true,
            ],
            [
                'nombre' => 'no_asistio',
                'descripcion' => 'El cliente no se presentó a la cita programada.',
                'activo' => true,
            ],
            [
                'nombre' => 'reprogramada',
                'descripcion' => 'La cita fue modificada y programada para una nueva fecha u horario.',
                'activo' => true,
            ],
            [
                'nombre' => 'vencida',
                'descripcion' => 'La fecha y hora de la cita han pasado sin que haya sido completada.',
                'activo' => true,
            ],
        ], ['nombre'], ['descripcion', 'activo']);
    }
}



