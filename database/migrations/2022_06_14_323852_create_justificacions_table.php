<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJustificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('justificacions', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->string('titulo');
            $table->string('mensaje');
            $table->string('adjunto')->nullable();
            $table->timestamps();
        });
        Schema::table('justificacions', function (Blueprint $table) {
            $table->unsignedBigInteger("id_user");
            $table->foreign("id_user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('justificacions');
    }
}
