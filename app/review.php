<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    //
    public function product(){
        return $this->belongsTo('App\product');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','id') ;
    }
}
