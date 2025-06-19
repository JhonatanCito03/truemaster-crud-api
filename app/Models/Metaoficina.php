<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metaoficina extends Model
{
    use HasFactory;


    protected $table = 'metaoficina';

    protected $fillable = [
    'departamento_id',
    'titulo',
    'descripcion',
    'valor_objetivo',
    'unidad',
    'fecha_inicio',
    'fecha_fin',
    'estado'
    ];
}
