<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->integer('id');
            $table->timestamps();
            $table->integer('id_servicio');
            $table->text('actividades');
            $table->integer('traslados');
            $table->integer('atenciones');
            $table->primary('id');
            
            $table->foreign('id_servicio')
            ->references('id')
            ->on('servicios')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
