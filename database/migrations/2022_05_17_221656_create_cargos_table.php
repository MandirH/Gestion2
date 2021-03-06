<?php

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cargo');
            $table->string('horas_cargo');
            $table->string('estado');
            $table->timestamps();
        });

        $cargo = new Cargo();
        $cargo->nombre_cargo = 'Administrador';
        $cargo->horas_cargo = '0';
        $cargo->estado = 'Activo';
        $cargo->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargos');
    }
}
