<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->unsignedBigInteger("id_sexo")->nullable();
            $table->unsignedBigInteger("id_tipo")->nullable();
            $table->integer("edad");
            $table->float("invercion");
            $table->float("costo_publico");
            $table->float("utilidad");
            $table->string("porcentaje");
            $table->text("observaciones")->nullable();
            $table->date("fecha");
            $table->foreign("id_sexo")->references("id")->on("generos")->onDelete("set null");
            $table->foreign("id_tipo")->references("id")->on("tipos")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuestos');
    }
}
