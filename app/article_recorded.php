<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class article_recorded extends Model
{
    //
    protected $table = 'article_recorded';
    protected $fillable = ['id', 'title', 'data', 'href', 'from'];

    public static function getlatest()
    {
        $a1 = DB::select("SELECT substring(title,1,22) as title , data ,href from article_recorded WHERE `from` = '学生在线' ORDER BY data DESC LIMIT 9");
        $a2 = DB::select("SELECT substring(title,1,22) as title , data ,href from article_recorded WHERE `from` = '青春山大' ORDER BY data DESC LIMIT 9");
        $a3 = DB::select("SELECT substring(title,1,22) as title , data ,href from article_recorded WHERE `from` = '本科教育' ORDER BY data DESC LIMIT 9");
        $re = ['a1' => $a1, 'a2' => $a2, 'a3' => $a3];
        return $re;
    }
}
