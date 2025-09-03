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
        Schema::create('meta_gerencia_zonal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_meta');
            $table->text('valor_objetivo');
            $table->text('valor_actual');
            $table->unsignedBigInteger('meta_gerencia_regional_id');
            $table->foreign('meta_gerencia_regional_id')->references('id')->on('meta_gerencia_regional')->onDelete('cascade');
            $table->boolean('estado_meta')->default(true);
            $table->string('creado_por');
            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipio')->onDelete('cascade');
            $table->string('actualizado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_gerencia_zonal');
    }
};
