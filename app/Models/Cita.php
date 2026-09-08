<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'barberia_id',
        'cliente_id',
        'barbero_id',
        'estado_cita_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'observaciones'
    ];

    public function barberia()
    {
        return $this->belongsTo(Barberia::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function barbero()
    {
        return $this->belongsTo(Barbero::class);
    }

    public function estadoCita()
    {
        return $this->belongsTo(EstadoCita::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'cita_servicio');
    }
    
}
