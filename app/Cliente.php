<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

	protected $primaryKey = 'telefono';
	    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'telefono';
	}
}
