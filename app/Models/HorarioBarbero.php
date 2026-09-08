<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioBarbero extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'barbero_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'activo'
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }

    public function barbero()
    {
        return $this->belongsTo(Barbero::class);
    }
}
