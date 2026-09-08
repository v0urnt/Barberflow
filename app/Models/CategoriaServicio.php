<?php

namespace App\Models;

use Database\Factories\CategoriaServicioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaServicio extends Model
{
    /** @use HasFactory<CategoriaServicioFactory> */
    use HasFactory;

    protected $table = 'categorias_servicio';

    protected $fillable = [
        'barberia_id',
        'nombre',
        'descripcion',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public function barberia(): BelongsTo
    {
        return $this->belongsTo(Barberia::class);
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }
}
