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
            $table -> string('nombre_pais',150);
            $table->string('codigo_iso',15) -> unique(); // COL,MX
            $table->string('prefijo_telefonico',7);
            $table->enum('moneda', ['COP', 'MXP', 'PEN', 'USD', 'EUR', 'SRA', 'CAD','CLP']) -> default('USD');
            $table -> string('idioma_principal') -> default('es');
            $table -> boolean('activo') -> default(true);
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
