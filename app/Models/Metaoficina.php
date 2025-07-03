<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metaoficina extends Model
{
    use HasFactory;


    protected $table = 'metaoficina';

    protected $fillable = [
    'titulo_meta',
    'descripcion_meta',
    'valor_objetivo',
    'unidad',
    'fecha_inicio',
    'fecha_fin',
    'activo',
    'oficina_id'
    ];
}
