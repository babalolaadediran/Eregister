<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immigrant extends Model
{
    /**
     * The attributes are mass assignable
     * 
     * @var array
    */
    protected $fillable = [
        'surname', 'firstname', 'country_id', 'gender', 'dob', 'occupation', 'phone_no', 'identification', 'address', 'status', 'registered_by'
    ];
   
    public function countries(){

        return $this->belongsTo(Country::class);
    }
}
