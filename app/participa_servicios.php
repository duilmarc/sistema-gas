<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class participa_servicios extends Model
{
    protected $fillable = [
        'name', 'last_name','email', 'password',
    ];
    
}
