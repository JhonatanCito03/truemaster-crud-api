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
        Schema::create('oficina', function (Blueprint $table) {
            $table->id();
            $table -> string('nombre_oficina',150);
            $table -> string('codigo_oficina',10) -> unique();
            $table -> string('direccion');
            $table -> bigInteger('telefono') -> unique();
            $table -> string('email_contacto');
            $table->text('horario_atencion');
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')
            ->references('id')->on('municipio')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficina');
    }
};
