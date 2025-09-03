<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta_gerencia_oficina extends Model
{
    //
    protected $table = 'meta_gerencia_oficina';

    protected $fillable = [
        'nombre_meta',
        'valor_objetivo',
        'valor_actual',
        'meta_gerencia_zonal_id',
        'estado_meta',
        'creado_por',
        'actualizado_por',
        'oficina_id',
    ];
}
