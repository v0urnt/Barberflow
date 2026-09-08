<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitaServicio extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cita_id',
        'servicio_id',
        'precio',
        'duracion_minutos',
        'subtotal'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
