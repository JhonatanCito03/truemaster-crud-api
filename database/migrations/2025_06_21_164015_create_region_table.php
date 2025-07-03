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
        Schema::create('region', function (Blueprint $table) {
            $table->id();
            $table -> string('nombre_region',150);
            $table -> string('numero_region',10) -> unique(); //En este caso pordriamos aplicar :: R01,R02
            $table -> enum('zona', ['norte','sur','este','oeste','centro']) -> nullable();
            $table -> text('descripcion');
            $table -> boolean('activo') -> default(true);            
            //caso de estudio de las foreign keys
            $table -> unsignedBigInteger('pais_id');
            //tabla pais, ya que el pais no debe llamar ninguna tabla
            $table->timestamps();
            $table -> foreign('pais_id') -> references('id') -> on ('pais') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region');
    }
};
