<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->string('dni', 8);
            $table->string('codigo_autogenerado', 20);
            $table->string('direccion', 100);
            $table->string('ciudad', 50);
            $table->string('provincia', 50);
            $table->string('departamento', 50);
            $table->string('nro_telefono', 10);
            $table->date('fecha_nacimiento');
            $table->enum('estado', ['1', '0']);
            $table->unsignedBigInteger('concesionario_id');
            $table->foreign('concesionario_id')->references('id')->on('concesionarios');
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
        Schema::dropIfExists('clientes');
    }
}
