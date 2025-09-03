<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta_gerencia_zonal extends Model
{
    //
    protected $table = 'meta_gerencia_zonal';

    protected $fillable = [
        'nombre_meta',
        'valor_objetivo',
        'valor_actual',
        'meta_gerencia_regional_id',
        'estado_meta',
        'creado_por',
        'actualizado_por',
        'municipio_id'
    ];
}
