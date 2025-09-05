<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $table = 'empleado';

    protected $fillable = [
        'name',
        'age',
        'email',
        'globalScore',
        'phone',
        'password',
        'rol',
        'id_number',
        'img',
        'id_oficina',
    ];
}
