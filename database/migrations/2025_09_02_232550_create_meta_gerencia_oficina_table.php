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
        Schema::create('meta_gerencia_oficina', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_meta');
            $table->text('valor_objetivo');
            $table->text('valor_actual');
            $table->unsignedBigInteger('meta_gerencia_zonal_id');
            $table->foreign('meta_gerencia_zonal_id')->references('id')->on('meta_gerencia_zonal')->onDelete('cascade');
            $table->boolean('estado_meta')->default(true);
            $table->string('creado_por');
            $table->unsignedBigInteger('oficina_id');
            $table->foreign('oficina_id')->references('id')->on('oficina')->onDelete('cascade');
            $table->string('actualizado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_gerencia_oficina');
    }
};
