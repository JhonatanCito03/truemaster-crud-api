<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //use HasFactory;

    protected $table = 'cargo';

    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel',
        'salario_base'
    ];
}
