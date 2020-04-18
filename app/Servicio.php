<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $fillable = [
        'name', 'last_name','email', 'password',
    ];

}
