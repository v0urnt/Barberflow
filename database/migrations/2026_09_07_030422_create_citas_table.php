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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barberia_id')->constrained('barberias')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('barbero_id')->constrained('barberos')->cascadeOnDelete();
            $table->foreignId('estado_cita_id')->constrained('estado_citas')->cascadeOnDelete();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });

    
    DB::statement('
            ALTER TABLE citas
            ADD CONSTRAINT chk_citas_hora_inicio_hora_fin
            CHECK(hora_fin > hora_inicio)
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
