<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'nombre_rol',
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
