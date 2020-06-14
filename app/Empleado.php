<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //

    public function muestraEmpleado($id){
        $articulo = Empleado::find($id);
        return $articulo;
    }
}
