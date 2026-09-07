<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre_permiso',
        'descripcion',
        'activo'
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }
}
