<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoCita extends Model
{
    public $timestamps = false;

    protected $fillable = [
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

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function citaHistorialEstados(): HasMany
    {
        return $this->hasMany(CitaHistorialEstado::class);
    }
}
