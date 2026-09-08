<?php

namespace App\Models;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    /** @use HasFactory<ClienteFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'barberia_id',
        'nombre_cliente',
        'apellido_cliente',
        'telefono',
        'email',
        'fecha_nacimiento',
        'observaciones',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
            'fecha_nacimiento' => 'date',
        ];
    }

    public function barberia(): BelongsTo
    {
        return $this->belongsTo(Barberia::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
