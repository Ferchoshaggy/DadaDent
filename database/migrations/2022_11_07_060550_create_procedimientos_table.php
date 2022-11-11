<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimientos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->float("costo");
            $table->float("costo_publico");
            $table->string("porcentaje");
            $table->date("fecha");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedimientos');
    }
}
