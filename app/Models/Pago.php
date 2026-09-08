<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $fillable = [
        'cita_id',
        'metodo_pago_id',
        'estado_pago_id',
        'monto',
        'fecha_pago',
        'referencia',
        'observaciones',
    ];

    public function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'fecha_pago' => 'datetime',
        ];
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function metodoPago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function estadoPago(): BelongsTo
    {
        return $this->belongsTo(EstadoPago::class);
    }
}
