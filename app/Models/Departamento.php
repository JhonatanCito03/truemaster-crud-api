<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';

    protected $fillable = [
        'nombre_departamento',
        'codigo_departamento',
        'poblacion',
        'region_id',
        'activo'
    ];
}
