<?php

namespace Database\Seeders;

use App\Models\EstadoPago;
use Illuminate\Database\Seeder;

class EstadoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoPago::query()->upsert([
            ['nombre_estado' => 'pendiente', 'descripcion' => 'El pago ha sido registrado pero aún no se completa.', 'activo' => true],
            ['nombre_estado' => 'pagado', 'descripcion' => 'El pago fue completado exitosamente.', 'activo' => true],
            ['nombre_estado' => 'fallido', 'descripcion' => 'El pago no pudo ser procesado.', 'activo' => true],
            ['nombre_estado' => 'reembolsado', 'descripcion' => 'El pago fue devuelto al cliente.', 'activo' => true],
        ], ['nombre_estado'], ['descripcion', 'activo']);
    }
}
