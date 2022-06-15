<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_cargos', function (Blueprint $table) {
            $table->id();
            $table->string('horas');
            $table->string('estado');
            $table->timestamps();
        });
        Schema::table('entrada_cargos', function (Blueprint $table) {
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
        Schema::dropIfExists('entrada_cargos');
    }
}
