<?php

namespace App\Models;

use Database\Factories\BarberiaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barberia extends Model
{
    /** @use HasFactory<BarberiaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'descripcion',
        'logo',
        'activo',
    ];

    public function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    public function categoriasServicio(): HasMany
    {
        return $this->hasMany(CategoriaServicio::class);
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
