<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{

     protected $fillable = [
        'first_name','last_name','gender','id_number','date_of_birth','password'
    ];
     
     public function undertakers(){
         return $this->hasMany(Undertaker::class);
     }
     
     public function deceased(){
         return $this->hasMany(Deceased::class);
     }
}
