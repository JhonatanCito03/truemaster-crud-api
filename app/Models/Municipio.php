<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;


    protected $table = 'municipio';

    protected $fillable = [
        'nombre_municipio',
        'codigo_municipio',
        'poblacion',
        'es_capital',
        'activo',
        'region_id'
    ];
}
