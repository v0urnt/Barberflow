<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MetodoPago::query()->upsert([
            ['nombre_metodo' => 'Efectivo', 'descripcion' => 'Pago realizado en efectivo.', 'activo' => true],
            ['nombre_metodo' => 'Tarjeta', 'descripcion' => 'Pago realizado con tarjeta.', 'activo' => true],
            ['nombre_metodo' => 'Transferencia', 'descripcion' => 'Pago realizado mediante transferencia bancaria.', 'activo' => true],
            ['nombre_metodo' => 'Nequi', 'descripcion' => 'Pago realizado mediante Nequi.', 'activo' => true],
            ['nombre_metodo' => 'Daviplata', 'descripcion' => 'Pago realizado mediante Daviplata.', 'activo' => true],
        ], ['nombre_metodo'], ['descripcion', 'activo']);
    }
}
