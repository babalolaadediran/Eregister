<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    /**
     * These attributes are mass assignable
     * 
     * @var array
    */
    protected $fillable = [
        'fullname', 'email', 'phone', 'username', 'password'
    ];

    /**
     * The attribute that should be hidden for arrays
     * 
    */
    protected $hidden = [
        'password'
    ];
}
