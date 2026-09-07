<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barberia extends Model
{
    public $timestamp = true;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'descripcion',
        'logo',
        'activo'
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean'
        ];
    }
}
