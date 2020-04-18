<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    protected $fillable = [
        'name', 'last_name','email', 'password',
    ];

}
