<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            
            $table->integer('id');
            $table->primary('id');

            $table->char('nombre',50);
            $table->date('fecha');
            $table->time('hora_inico');
            $table->enum('tipo_servicio',['interno','externo']);
            $table->char('area',50);
            $table->enum('estado',['pendiente','aceptado','rechazado','validado']);
            $table->string('lugar');
            $table->string('nombre_contacto',50);
            $table->integer('telefono_contacto');
            $table->integer('duracion');
            $table->integer('encargado_id')->nullable();

            $table->timestamps();
            
            $table->foreign('encargado_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('servicios');
    }
}
