<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
	protected $primaryKey = 'id';
	protected $fillable = ['id','tipo_gasto','monto','fecha','descripcion'];
	

	public function getRouteKeyName()
	{
	    return 'id';
	}
	public function searchID($id)
	{
		return true;
	}

}
