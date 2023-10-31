<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    use HasFactory;
    protected $table = 'prestaciones';

    public function prestacionesPropias()
    {
        return $this->belongsTo(Cliente::class);
    }
}
