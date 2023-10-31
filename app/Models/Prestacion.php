<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestacion extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id','nombre_medico','matricula_medico' ,'instituto','fecha_turno', 'fecha_solicitud','estado', 'nombre_prestacion',];
    protected $guarded = ['id'];
    protected $table = 'prestaciones';

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class);
    }
}
