<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metamunicipio extends Model
{
    use HasFactory;

    protected $table = 'metamunicipio';

    protected $fillable = [
    'valor_meta',
    'fecha_inicio'
    ];
}
