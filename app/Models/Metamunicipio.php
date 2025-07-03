<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metamunicipio extends Model
{
    use HasFactory;

    protected $table = 'metamunicipio';

    protected $fillable = [
    'titulo_meta',
    'descripcion_meta',
    'valor_objetivo',
    'unidad',
    'fecha_inicio',
    'fecha_fin',
    'activo',
    'municipio_id'
    ];
}
