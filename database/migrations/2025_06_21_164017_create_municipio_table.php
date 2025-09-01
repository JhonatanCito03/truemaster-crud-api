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
        Schema::create('municipio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_municipio',150);
            $table->string('codigo_municipio',10)->unique();
            $table->integer('poblacion');
            $table->boolean('es_capital')->default(false);
            $table->string('activo');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipio');
    }
};
