<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Reintegro extends Model
{
    protected $fillable = ['cliente_id','medico_id','nombre_instituto','fecha_estudio_compra','cbu','orden_medica','factura','tipo_reintegro', 'estado'];
    protected $guarded = ['id'];

    use HasApiTokens;
    use HasFactory;

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class);
    }

    public function medico(): BelongsTo {
        return $this->belongsTo(Medico::class);
    }
}