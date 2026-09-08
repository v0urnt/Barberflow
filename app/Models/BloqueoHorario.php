<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloqueoHorario extends Model
{
    public $timestamps = true;

    const UPDATED_AT = null;

    protected $fillable = [
        'barbero_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'motivo'
    ];

    public function barbero()
    {
        return $this->belongsTo(Barbero::class);
    }
}
