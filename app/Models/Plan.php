<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';

    public function coberturas(): HasMany
    {
        return $this->hasMany(Cobertura::class, 'plan_id');
    }
}
