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
        Schema::create('meta_presidencia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_meta');
            $table->text('descripcion_meta')->nullable();
            $table->text('valor_objetivo');
            $table->text('valor_actual');
            $table->boolean('estado_meta')->default(true);
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
        Schema::dropIfExists('meta_presidencia');
    }
};
