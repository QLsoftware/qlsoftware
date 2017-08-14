<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class getcourse extends Model
{
    //

    protected $table = 'getcourses';


    public function user(){
        $this->belongsTo(User::class);
    }
}
