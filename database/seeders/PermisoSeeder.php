<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permiso::query()->upsert([
            ['nombre_permiso' => 'crear_cita', 'descripcion' => 'Permite crear citas.', 'activo' => true],
            ['nombre_permiso' => 'ver_cita', 'descripcion' => 'Permite consultar citas.', 'activo' => true],
            ['nombre_permiso' => 'editar_cita', 'descripcion' => 'Permite editar citas.', 'activo' => true],
            ['nombre_permiso' => 'cancelar_cita', 'descripcion' => 'Permite cancelar citas.', 'activo' => true],
            ['nombre_permiso' => 'crear_cliente', 'descripcion' => 'Permite crear clientes.', 'activo' => true],
            ['nombre_permiso' => 'ver_cliente', 'descripcion' => 'Permite consultar clientes.', 'activo' => true],
            ['nombre_permiso' => 'editar_cliente', 'descripcion' => 'Permite editar clientes.', 'activo' => true],
            ['nombre_permiso' => 'eliminar_cliente', 'descripcion' => 'Permite eliminar clientes.', 'activo' => true],
            ['nombre_permiso' => 'crear_servicio', 'descripcion' => 'Permite crear servicios.', 'activo' => true],
            ['nombre_permiso' => 'ver_servicio', 'descripcion' => 'Permite consultar servicios.', 'activo' => true],
            ['nombre_permiso' => 'editar_servicio', 'descripcion' => 'Permite editar servicios.', 'activo' => true],
            ['nombre_permiso' => 'eliminar_servicio', 'descripcion' => 'Permite eliminar servicios.', 'activo' => true],
            ['nombre_permiso' => 'ver_barberos', 'descripcion' => 'Permite consultar barberos.', 'activo' => true],
            ['nombre_permiso' => 'gestionar_barberos', 'descripcion' => 'Permite gestionar barberos.', 'activo' => true],
            ['nombre_permiso' => 'ver_reportes', 'descripcion' => 'Permite consultar reportes.', 'activo' => true],
            ['nombre_permiso' => 'gestionar_usuarios', 'descripcion' => 'Permite gestionar usuarios.', 'activo' => true],
            ['nombre_permiso' => 'gestionar_roles', 'descripcion' => 'Permite gestionar roles.', 'activo' => true],
            ['nombre_permiso' => 'gestionar_permisos', 'descripcion' => 'Permite gestionar permisos.', 'activo' => true],
        ], ['nombre_permiso'], ['descripcion', 'activo']);
    }
}
