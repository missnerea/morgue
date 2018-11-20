<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Undertaker extends Authenticatable{
    /*
    protected $fillable = [
        'first_name','last_name','gender','id_number','date_of_birth','password','admin_id'
    ];
    */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    
    public function deceased(){
        return $this->hasMany(Deaceased::class);
    }
}

