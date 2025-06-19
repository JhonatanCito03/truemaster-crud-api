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
        Schema::create('metaoficina', function (Blueprint $table) {
            $table->id();
            $table->string('departamento_id');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->decimal('valor_objetivo', 10, 2);
            $table->string('unidad')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metaoficina');
    }
};
