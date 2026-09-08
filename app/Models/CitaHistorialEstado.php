<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CitaHistorialEstado extends Model
{
    protected $fillable = [
        'cita_id',
        'estado_cita_id',
        'user_id',
        'observacion',
    ];

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function estadoCita(): BelongsTo
    {
        return $this->belongsTo(EstadoCita::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
