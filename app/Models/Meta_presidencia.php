<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta_presidencia extends Model
{
    //
    protected $table = 'meta_presidencia';

    protected $fillable = [
        'nombre_meta',
        'descripcion_meta',
        'valor_objetivo',
        'valor_actual',
        'estado_meta',
        'creado_por',
        'actualizado_por'
    ];
}
