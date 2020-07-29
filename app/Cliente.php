<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

	protected $primaryKey = 'telefono';
	protected $fillable = ['telefono','nombres','apellidos','direccion','latitud','longitud','balon_prestado','deuda','frecuencia','comentarios'];
	    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'telefono';
	}
	public function searchID($id)
	{
		return true;
	}

}
