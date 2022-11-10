<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos_procedimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_presupuesto");
            $table->unsignedBigInteger("id_ubicacion")->nullable();
            $table->integer("numero_asignado_pz");
            $table->unsignedBigInteger("id_procedimiento")->nullable();
            $table->float("descuento")->nullable();
            $table->foreign("id_presupuesto")->references("id")->on("presupuestos")->onDelete("cascade");
            $table->foreign("id_ubicacion")->references("id")->on("ubicacions")->onDelete("set null");
            $table->foreign("id_procedimiento")->references("id")->on("procedimientos")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuestos_procedimientos');
    }
}
