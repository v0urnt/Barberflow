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
        Schema::create('horarios_barbero', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barbero_id')->constrained('barberos')->cascadeOnDelete();
            $table->smallInteger('dia_semana');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });


    DB::statement('
            ALTER TABLE horarios_barbero
            ADD CONSTRAINT chk_horarios_barbero_dia_semana
            CHECK (dia_semana BETWEEN 1 AND 7)
        ');

    DB::statement('
            ALTER TABLE horarios_barbero
            ADD CONSTRAINT chk_horarios_barbero_hora_inicio_hora_fin
            CHECK(hora_fin > hora_inicio)
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_barbero');
    }
};
