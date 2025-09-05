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
        Schema::create('registro_ejecucion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_registro');
            $table->decimal('valor', 10, 2);
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleado')->onDelete('cascade');
            $table->string('fecha_registro');
            $table->unsignedBigInteger('oficina_id');
            $table->foreign('oficina_id')->references('id')->on('oficina')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_ejecucion');
    }
};
