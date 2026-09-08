<?php

namespace Tests\Feature;

use App\Models\Barberia;
use App\Models\Barbero;
use App\Models\CategoriaServicio;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\EstadoPago;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_barberia_exposes_its_tenant_collections(): void
    {
        $barberia = Barberia::factory()->create();
        $user = User::factory()->for($barberia)->create();
        $cliente = Cliente::factory()->for($barberia)->create();
        $categoria = CategoriaServicio::factory()->for($barberia)->create();
        $servicio = Servicio::factory()->for($barberia)->for($categoria, 'categoriaServicio')->create();

        $this->assertTrue($barberia->users->contains($user));
        $this->assertTrue($barberia->clientes->contains($cliente));
        $this->assertTrue($barberia->categoriasServicio->contains($categoria));
        $this->assertTrue($barberia->servicios->contains($servicio));
    }

    public function test_user_belongs_to_barberia_and_rol_and_has_one_barbero(): void
    {
        $rol = Rol::query()->create(['nombre_rol' => 'Barbero', 'activo' => true]);
        $user = User::factory()->for($rol)->create();
        $barbero = Barbero::factory()->for($user)->create();

        $this->assertInstanceOf(Barberia::class, $user->barberia);
        $this->assertSame($rol->id, $user->rol->id);
        $this->assertSame($barbero->id, $user->barbero->id);
    }

    public function test_rol_and_permiso_are_many_to_many(): void
    {
        $rol = Rol::query()->create(['nombre_rol' => 'Recepcionista', 'activo' => true]);
        $permiso = Permiso::query()->create(['nombre_permiso' => 'crear_cita', 'activo' => true]);

        $rol->permisos()->attach($permiso);

        $this->assertTrue($rol->permisos->contains($permiso));
        $this->assertTrue($permiso->roles->contains($rol));
    }

    public function test_cliente_uses_soft_deletes_and_keeps_citas(): void
    {
        $cliente = Cliente::factory()->create();
        $cita = Cita::factory()->for($cliente)->create();

        $cliente->delete();

        $this->assertSoftDeleted($cliente);
        $this->assertModelExists($cita);
        $this->assertTrue($cita->cliente()->withTrashed()->first()->is($cliente));
    }

    public function test_servicio_and_barbero_share_pivot_with_custom_price(): void
    {
        $barbero = Barbero::factory()->create();
        $servicio = Servicio::factory()->create(['precio' => 100.00, 'duracion_minutos' => 30]);

        $barbero->servicios()->attach($servicio, [
            'precio_personalizado' => 120.50,
            'duracion_personalizada' => 45,
            'activo' => true,
        ]);

        $pivot = $barbero->servicios->first()->pivot;

        $this->assertSame('120.50', $pivot->precio_personalizado);
        $this->assertSame(45, $pivot->duracion_personalizada);
        $this->assertTrue($servicio->barberos->contains($barbero));
    }

    public function test_cita_links_servicios_pagos_and_historial(): void
    {
        $cita = Cita::factory()->create();
        $servicio = Servicio::factory()->for($cita->barberia)->create(['precio' => 80.00]);

        $cita->servicios()->attach($servicio, [
            'precio' => 80.00,
            'duracion_minutos' => 30,
            'subtotal' => 80.00,
        ]);

        $metodo = MetodoPago::query()->create(['nombre_metodo' => 'Efectivo', 'activo' => true]);
        $estadoPago = EstadoPago::query()->create(['nombre_estado' => 'pagado', 'activo' => true]);
        $pago = Pago::query()->create([
            'cita_id' => $cita->id,
            'metodo_pago_id' => $metodo->id,
            'estado_pago_id' => $estadoPago->id,
            'monto' => 80.00,
            'fecha_pago' => now(),
        ]);

        $cita->historialEstados()->create([
            'estado_cita_id' => $cita->estado_cita_id,
            'user_id' => User::factory()->for($cita->barberia)->create()->id,
            'observacion' => 'Cita creada desde la prueba.',
        ]);

        $this->assertSame('80.00', $cita->servicios->first()->pivot->subtotal);
        $this->assertSame($pago->id, $cita->pagos->first()->id);
        $this->assertSame('80.00', $cita->pagos->first()->monto);
        $this->assertCount(1, $cita->historialEstados);
        $this->assertSame($cita->estadoCita->id, $cita->estado_cita_id);
    }
}
