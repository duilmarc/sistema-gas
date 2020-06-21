<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
	protected $fillable = ['tipo_gasto','mont','fecha','descripcion'];
		public function getRouteKeyName()
	{
	    return 'id';
	}
	public function searchID($id)
	{
		return true;
	}

}
