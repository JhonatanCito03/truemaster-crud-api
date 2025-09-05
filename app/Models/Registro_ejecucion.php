<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Registro_ejecucion extends Model
{
    use HasFactory;

    protected $table = 'registro_ejecucion';

    protected $fillable = [
        'nombre_registro',
        'valor',
        'empleado_id',
        'fecha_registro',
        'oficina_id'
    ];
}
