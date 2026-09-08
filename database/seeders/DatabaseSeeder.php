<?php

namespace Database\Seeders;

use App\Models\Barberia;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            PermisoSeeder::class,
            EstadoCitaSeeder::class,
            MetodoPagoSeeder::class,
            EstadoPagoSeeder::class,
        ]);

        $barberia = Barberia::factory()->create([
            'nombre' => 'Barberflow Demo',
        ]);

        User::factory()->create([
            'barberia_id' => $barberia->id,
            'rol_id' => Rol::query()->where('nombre_rol', 'Administrador')->value('id'),
            'name' => 'Admin',
            'apellido' => 'Demo',
            'email' => 'admin@barberflow.test',
        ]);
    }
}
