<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre_rol',
        'descripcion',
        'activo'
    ];

    
    protected function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
        
    }
    //
}
