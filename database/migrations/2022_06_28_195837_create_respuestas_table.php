<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('aceptacion');
            $table->timestamps();
        });
        Schema::table('respuestas', function (Blueprint $table) {
            $table->unsignedBigInteger("id_justificacion");
            $table->foreign("id_justificacion")->references("id")->on("justificacions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
