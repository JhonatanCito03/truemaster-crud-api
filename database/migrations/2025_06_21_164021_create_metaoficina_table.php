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
            $table->string('titulo_meta',100);
            $table->text('descripcion_meta');
            $table->float('valor_objetivo');
            $table -> enum('unidad', ['Millones','Miles de millones','Miles','Cientos']) -> default('Millones');
            $table -> date('fecha_inicio');
            $table -> date('fecha_fin');
            $table -> boolean('activo') -> default(true);
            $table->unsignedBigInteger('oficina_id');
            $table->foreign('oficina_id')
            ->references('id')->on('oficina')
            ->onDelete('cascade');
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
