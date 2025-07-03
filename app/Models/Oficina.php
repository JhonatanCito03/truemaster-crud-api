<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;


    protected $table = 'oficina';

    protected $fillable = [
        'nombre_oficina',
        'codigo_oficina',
        'direccion',
        'telefono',
        'email_contacto',
        'responsable_id',
        'horaro_atencion',
        'activo',
        'responsable_id',
        'municipio_id'
    ];
}
