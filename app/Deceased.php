<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    public $table='deceased';
    
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    
    public function undertaker(){
        return $this->belongsTo(Undertaker::class);
    }
}
