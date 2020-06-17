<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $primaryKey = 'id';
	protected $fillable = ['id','color'];
	

	public function getRouteKeyName()
	{
	    return 'id';
	}

}
