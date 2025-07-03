<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadpto extends Model
{
    use HasFactory;
    
    protected $table =  'metadpto';

    protected $fillable = [
    'titulo_meta',
    'descripcion_meta',
    'valor_objetivo',
    'unidad',
    'fecha_inicio',
    'fecha_fin',
    'activo',
    'departamento_id'
    ];
}
