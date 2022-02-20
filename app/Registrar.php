<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    /**
     * The attributes are mass assignable 
     * 
     * @var array
    */
    protected $fillable = [
        'fullname', 'gender', 'phone', 'password'
    ];

    /**
     * The attribute that should be hidden for arrays
     * 
    */
    protected $hidden = [
        'password'
    ];
}
