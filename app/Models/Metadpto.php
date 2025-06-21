<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadpto extends Model
{
    use HasFactory;
    
    protected $table =  'metadpto';

    protected $fillable = [
    'valor_meta',
    'fecha_inicio'
    ];
}
