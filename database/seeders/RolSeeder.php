<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([ 'nombre_rol' => 'Administrador',
                'descripcion' => 'Gestiona y administra todos los recursos de la barbería.', 
        'activo' => true, ]);

        Rol::create([ 'nombre_rol' => 'Barbero',
                'descripcion' => 'Gestiona sus servicios, 
        horarios y citas asignadas.', 
        'activo' => true, ]);
        
        Rol::create([ 'nombre_rol' => 'Recepcionista', 
        'descripcion' => 'Gestiona clientes, citas y operaciones de recepción.', 
        'activo' => true, ]);
    }
}
