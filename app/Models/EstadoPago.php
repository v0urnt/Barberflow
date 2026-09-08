<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoPago extends Model
{
    protected $table = 'estados_pago';

    protected $fillable = [
        'nombre_estado',
        'descripcion',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}
