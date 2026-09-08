<?php

namespace App\Models;

use Database\Factories\ServicioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servicio extends Model
{
    /** @use HasFactory<ServicioFactory> */
    use HasFactory;

    protected $fillable = [
        'barberia_id',
        'categoria_servicio_id',
        'nombre_servicio',
        'descripcion',
        'precio',
        'duracion_minutos',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
            'precio' => 'decimal:2',
            'duracion_minutos' => 'integer',
        ];
    }

    public function barberia(): BelongsTo
    {
        return $this->belongsTo(Barberia::class);
    }

    public function categoriaServicio(): BelongsTo
    {
        return $this->belongsTo(CategoriaServicio::class);
    }

    public function barberos(): BelongsToMany
    {
        return $this->belongsToMany(Barbero::class, 'barbero_servicio')
            ->withPivot(['precio_personalizado', 'duracion_personalizada', 'activo']);
    }

    public function citas(): BelongsToMany
    {
        return $this->belongsToMany(Cita::class, 'cita_servicio')
            ->withPivot(['precio', 'duracion_minutos', 'subtotal'])
            ->withTimestamps();
    }
}
