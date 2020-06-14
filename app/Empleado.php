<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $primaryKey = 'telefono';
	protected $fillable = ['telefono','nombre','direccion','salario'];

	public function getRouteKeyName()
	{
	    return 'telefono';
	}
	
    public function muestraEmpleado($id){
        $articulo = Empleado::find($id);
        return $articulo;
    }
}
