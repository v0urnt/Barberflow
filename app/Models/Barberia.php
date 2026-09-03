<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barberia extends Model
{
    /** @use HasFactory<\Database\Factories\BarberiaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'descripcion',
        'logo',
        'activo'
    ];

    protected function casts(): array
    {
        return[
            'activo' => 'boolean',
        ];
    }

}
