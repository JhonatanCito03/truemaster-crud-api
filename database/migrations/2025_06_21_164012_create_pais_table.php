<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table -> string('nombre_pais');
            $table->string('codigo_iso') -> unique(); // COL,MX
            $table->string('prefijo_telefonico');
            $table->string('moneda');
            $table -> string('idioma_principal');
            $table -> string('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pais');
    }
};
