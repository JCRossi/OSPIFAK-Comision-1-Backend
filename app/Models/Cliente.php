<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    protected $table = 'cliente';
    protected $fillable = [
        'DNI',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'email',
        'usuario',
        'password',
    ];

    public function menores(): HasMany
    {
        return $this->hasMany(Menor::class, 'id_cliente');
    }
}
