<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Reintegro extends Model
{
    protected $fillable = ['afiliado_nombre','medico_nombre','medico_matricula','nombre_instituto','fecha','cbu','orden_medica','factura','tipo_reintegro'];
    protected $guarded = ['id'];

    use HasApiTokens;
    use HasFactory;

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class)->withTimeStamps();
    }

    public function medico(): BelongsTo {
        return $this->belongsTo(Medico::class)->withTimeStamps();
    }
}