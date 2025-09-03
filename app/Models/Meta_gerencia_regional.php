<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta_gerencia_regional extends Model
{
    //
    protected $table = 'meta_gerencia_regional';

    protected $fillable = [
        'nombre_meta',
        'valor_objetivo',
        'valor_actual',
        'meta_presidencia_id',
        'estado_meta',
        'creado_por',
        'actualizado_por',
        'region_id',
    ];
}
