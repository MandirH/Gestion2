<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_cargos', function (Blueprint $table) {
            $table->id();
            $table->string('horas');
            $table->string('estado');
            $table->timestamps();
        });
        Schema::table('salida_cargos', function (Blueprint $table) {
            $table->unsignedBigInteger("id_cargo");
            $table->foreign("id_cargo")->references("id")->on("cargos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salida_cargos');
    }
}
