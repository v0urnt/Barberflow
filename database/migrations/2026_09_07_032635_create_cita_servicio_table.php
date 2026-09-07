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
        Schema::create('cita_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->unique(['cita_id', 'servicio_id']);
            $table->decimal('precio', 12, 2);
            $table->smallInteger('duracion_minutos');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });


    DB::statement('
            ALTER TABLE cita_servicio
            ADD CONSTRAINT chk_cita_servicio_precio
            CHECK (precio > 0)
        ');

    DB::statement('
            ALTER TABLE cita_servicio
            ADD CONSTRAINT chk_cita_servicio_duracion_minutos
            CHECK (duracion_minutos > 0)
        ');

    DB::statement('
            ALTER TABLE cita_servicio
            ADD CONSTRAINT chk_cita_servicio_subtotal
            CHECK (subtotal >= 0)
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_servicio');
    }
};
