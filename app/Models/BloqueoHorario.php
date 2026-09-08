<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BloqueoHorario extends Model
{
    protected $table = 'bloqueos_horario';

    protected $fillable = [
        'barbero_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'motivo',
    ];

    public function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class);
    }
}
