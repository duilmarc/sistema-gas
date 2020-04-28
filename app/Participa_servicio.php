<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participa_servicio extends Model
{
    protected $fillable = [
        'nombre', 'fecha','hora_incio','tipo_servicio','area','estado','lugar','nombre_contacto','telefono_contacto', 'password',
        'duracion','encargado_id',
    ];


}
