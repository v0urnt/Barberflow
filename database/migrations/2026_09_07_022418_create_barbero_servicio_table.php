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
        Schema::create('barbero_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barbero_id')->constrained('barberos')->cascadeOnDelete();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->unique(['barbero_id', 'servicio_id']);
            $table->decimal('precio_personalizado', 12, 2)->nullable();
            $table->smallInteger('duracion_personalizada')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

    
    DB::statement('
            ALTER TABLE barbero_servicio
            ADD CONSTRAINT chk_barbero_servicio_precio
            CHECK (precio_personalizado IS NULL OR precio_personalizado > 0)
        ');

    DB::statement('
            ALTER TABLE barbero_servicio
            ADD CONSTRAINT chk_barbero_servicio_duracion_personalizada
            CHECK (duracion_personalizada IS NULL OR (duracion_personalizada > 0 AND duracion_personalizada % 5 = 0))
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbero_servicio');
    }
};
