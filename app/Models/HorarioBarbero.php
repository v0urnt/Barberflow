<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioBarbero extends Model
{
    protected $table = 'horarios_barbero';

    protected $fillable = [
        'barbero_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
            'dia_semana' => 'integer',
        ];
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class);
    }
}
