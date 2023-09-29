<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Empleado extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    protected $table = 'empleado';
    protected $fillable = [
        'DNI',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'fecha_ingreso',
        'telefono',
        'direccion',
        'email',
        'usuario',
        'password',
    ];

}
