<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menor extends Model
{
    use HasFactory;
    protected $table = 'cliente_menor';

    public function adultoResponsable()
    {
        return $this->belongsTo(Cliente::class);
    }
}
