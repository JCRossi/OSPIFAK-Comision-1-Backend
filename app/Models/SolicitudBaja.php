<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class SolicitudBaja extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    protected $table = 'solicitudes_baja';
    protected $fillable = [
        'paciente_tipo',
        'cliente_id',
        'paciente_id',
        'estado',
        'comentarios',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
