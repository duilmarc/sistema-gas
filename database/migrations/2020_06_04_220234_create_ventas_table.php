<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('telefono',10);
            $table->string('direccion',100);
            $table->enum('balon',['normal','premium']);
            $table->float('precio');
            $table->string('referencia',100);
            $table->integer('repartidor');
            $table->date('fecha');
            $table->enum('estado',['pendiente','realizado','cancelado']);
            $table->timestamps();


            $table->foreign('repartidor')
                   ->references('id')
                   ->on('empleados')
                   ->onUpdate('cascade');        
            $table->foreign('telefono')
                   ->references('telefono')
                   ->on('clientes')
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
        Schema::dropIfExists('ventas');
    }
}
