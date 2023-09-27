<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    use HasFactory;
    protected $table = 'cobertura';

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
