<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $primaryKey = 'id';
	protected $fillable = ['placa','color','fecha','descripcion'];
	

	public function getRouteKeyName()
	{
	    return 'placa';
	}
		public function searchID($id)
	{
		return true;
	}

}
