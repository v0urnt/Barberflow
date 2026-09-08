<?php

namespace App\Models;

use Database\Factories\BarberoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barbero extends Model
{
    /** @use HasFactory<BarberoFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'especialidad',
        'biografia',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function horarios(): HasMany
    {
        return $this->hasMany(HorarioBarbero::class);
    }

    public function bloqueos(): HasMany
    {
        return $this->hasMany(BloqueoHorario::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'barbero_servicio')
            ->withPivot(['precio_personalizado', 'duracion_personalizada', 'activo']);
    }
}
