<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plan';

    public function coberturas(): HasMany
    {
        return $this->hasMany(Cobertura::class, 'id_plan');
    }
}
