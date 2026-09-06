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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barberia_id')->constrained('barberias')->cascadeOnDelete();
            $table->foreignId('categoria_servicio_id')->constrained('categorias_servicio')->cascadeOnDelete();
            $table->string('nombre_servicio', 50);
            $table->text('descripcion')->nullable();
            $table->decimal('precio',12, 2);
            $table->smallInteger('duracion_minutos');
            $table->boolean('activo')->default(true);
            $table->unique(['barberia_id', 'nombre_servicio']);
            $table->timestamps();
        });
    

    DB::statement('
            ALTER TABLE servicios
            ADD CONSTRAINT chk_servicio_precio
            CHECK (precio > 0)
        ');

        DB::statement('
            ALTER TABLE servicios
            ADD CONSTRAINT chk_servicio_duracion_minutos
            CHECK (
                duracion_minutos > 0
                AND duracion_minutos % 5 = 0
            )
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
