<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class repair extends Model
{
    protected $table = 'repair';
    protected $primaryKey = 're_id';
//    public $timestamps = false;
    const CREATED_AT = 're_date';
    const UPDATED_AT = 're_update_time';


    public static function getrekind()
    {
        $re = DB::select('SELECT count(*) as num ,  re_xq , re_lfh FROM repair GROUP BY  re_xq , re_lfh;');
        $result = [];
        $i = 0;
        foreach ($re as $r) {
            $result[$i] = [$r->re_xq . $r->re_lfh, $r->num];
            $i++;
        }
        return $result;
    }

    public static function getre_num()
    {
        $re = DB::select('SELECT count(*) as num , date(re_date) as date FROM repair GROUP BY date(re_date);');
        $result = [];
//        $da = array();
        $i = 1;
        foreach ($re as $r) {
            $result[0] = $result[0].$r->date;
        }
        foreach ($re as $r) {
            $result[1] = [$r->date, $r->num];
            $i++;
        }
        return $result;
    }
}
