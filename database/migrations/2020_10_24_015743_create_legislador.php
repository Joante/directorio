<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegislador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legisladores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email');
            $table->unsignedBigInteger('telefono');
            $table->string('direccion')->nullable();
            $table->string('pais');
            $table->unsignedInteger('votos_obtenidos');
            $table->enum('partido_politico', ['Rojo', 'Azul', 'Verde']);
            $table->date('mandato_inicio');
            $table->date('mandato_fin');
            $table->boolean('automatico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legislador');
    }
}
