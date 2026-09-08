<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();
            $table->foreignId('metodo_pago_id')->constrained('metodos_pago')->cascadeOnDelete();
            $table->foreignId('estado_pago_id')->constrained('estados_pago')->cascadeOnDelete();
            $table->decimal('monto', 12, 2);
            $table->timestampTz('fecha_pago')->nullable();
            $table->string('referencia', 30)->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });

        DB::statement('
            ALTER TABLE pagos
            ADD CONSTRAINT chk_pagos_monto
            CHECK(monto > 0)
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
