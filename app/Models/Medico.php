<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Medico extends Model
{
    protected $fillable = ['nombre','apellido','matricula','dni'];
    protected $guarded = ['id'];

    use HasApiTokens;
    use HasFactory;

    public function reintegros(): HasMany
    {
        return $this->hasMany(Reintegro::class);
    }
}