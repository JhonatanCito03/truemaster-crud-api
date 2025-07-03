<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'region';

    protected $fillable = [
        'nombre_region',
        'numero_region',
        'zona',
        'codigo_region',
        'descripcion',
        'activo',
        'pais_id'
    ];
}
