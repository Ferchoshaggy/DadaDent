<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesProcedimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiales_procedimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_procedimiento');
            $table->unsignedBigInteger('id_material')->nullable();
            $table->integer("usos");
            $table->foreign("id_procedimiento")->references("id")->on("procedimientos")->onDelete("cascade");
            $table->foreign("id_material")->references("id")->on("materiales")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiales_procedimientos');
    }
}
