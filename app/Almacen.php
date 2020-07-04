<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table='almacenes';
    protected $primaryKey = 'almacen';
    protected $fillable = ['almacen','balon_lleno_normal','balon_lleno_premiun','balon_vacio_normal','balon_vacio_premiun','precioxbalon','balones_prestados'];
    public function getRouteKeyName()
	{
	    return 'almacen';
	}

}
