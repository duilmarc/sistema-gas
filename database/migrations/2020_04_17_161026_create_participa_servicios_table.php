<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipaServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participa_servicios', function (Blueprint $table) {
            $table->integer('id_voluntario');
            $table->integer('id_servicio');
            $table->string('cargo',50)->default('socorrista');
            $table->timestamp('hora_llegada')->nullable();
            $table->timestamp('hora_salida')->nullable();
            $table->integer('horas_realizadas');
            $table->enum('estado',['pendiente','sancionado','validado']);
            $table->text('comentario');
            $table->string('casco_codigo');
            $table->string('casaca_codigo');

            $table->foreign('id_voluntario')
                   ->references('id')
                   ->on('users')
                   ->onUpdate('cascade');        
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
        Schema::dropIfExists('participa_servicios');
    }
}
