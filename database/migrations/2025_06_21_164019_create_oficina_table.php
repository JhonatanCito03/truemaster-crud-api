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
            $table->string('horario_atencion', 200);
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')
            ->references('id')->on('municipio')
            ->onDelete('cascade');
            $table->unsignedBigInteger('responsable_id');
            $table->foreign('responsable_id')
            ->references('id')->on('empleado')
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
