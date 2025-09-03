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
        Schema::create('meta_gerencia_regional', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_meta');
            $table->text('valor_objetivo');
            $table->text('valor_actual');
            $table->unsignedBigInteger('meta_presidencia_id');
            $table->foreign('meta_presidencia_id')->references('id')->on('meta_presidencia')->onDelete('cascade');
            $table->boolean('estado_meta')->default(true);
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->string('creado_por');
            $table->string('actualizado_por')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_gerencia_regional');
    }
};
