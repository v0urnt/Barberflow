<?php

namespace App\Models;

use Database\Factories\CitaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    /** @use HasFactory<CitaFactory> */
    use HasFactory;

    protected $fillable = [
        'barberia_id',
        'cliente_id',
        'barbero_id',
        'estado_cita_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'observaciones',
    ];

    public function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function barberia(): BelongsTo
    {
        return $this->belongsTo(Barberia::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class);
    }

    public function estadoCita(): BelongsTo
    {
        return $this->belongsTo(EstadoCita::class);
    }

    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'cita_servicio')
            ->withPivot(['precio', 'duracion_minutos', 'subtotal'])
            ->withTimestamps();
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    public function historialEstados(): HasMany
    {
        return $this->hasMany(CitaHistorialEstado::class);
    }
}
