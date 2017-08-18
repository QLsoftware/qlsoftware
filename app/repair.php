<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class repair extends Model
{
    protected $table = 'repair';
    protected $primaryKey = 're_id';
//    public $timestamps = false;
    const CREATED_AT = 're_date';
    const UPDATED_AT = 're_update_time';
}
