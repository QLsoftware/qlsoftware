<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article_recorded extends Model
{
    //
    protected $table = 'article_recorded';
    protected $fillable = ['id','title','data','href','from'];

}
