<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class zjtcourses
 * @package App
 * 连接抢课getcourses表  并管理
 */
class zjtcourses extends Model
{
    //
    protected $table = 'getcourses';

    public function user(){
        $this->belongsTo(User::class);
    }

    public function getnew($id, $kch, $kxh, $name)
    {
        $detect = DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->first();

        if ($detect != null) {
            $index = $detect->index;
            DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->update(['status' => 0]);
        } else {
            $temp = DB::table("getcourses")->insert(['id' => $id, 'kch' => $kch, 'kxh' => $kxh, 'name' => $name]);
            $detect = DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->first();
            $index = $detect->index;
        }
        return $index;
    }

    public function pause($id, $kch, $kxh)
    {
        $detect = DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->first();
        if ($detect != null) {
            DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->update(['status' => -1]);
            return true;
        } else
            return false;
    }

    public function restart($id, $kch, $kxh)
    {
        $detect = DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->first();
        $index = $detect->index;
        if ($detect != null) {
            DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->update(['status' => 4]);
            return $index;
        } else
            return 0;
    }

    public function del($id, $kch, $kxh)
    {
        DB::table("getcourses")->where(['id' => $id, 'kch' => $kch, 'kxh' => $kxh])->delete();
        return true;
    }

    public function getonescouser($id)
    {
        $re = DB::table("getcourses")->where('id', $id)->orderby('status', 'des')->get();
        return $re;
    }

    public function getatask($index)
    {
        $re_c = DB::table("getcourses")->where('index', $index)->get();
        $re_u = null;
        if ($re_c) {
            $id = head($re_c)->id;
            $re_u = DB::table("users")->where('id', $id)->get();
        }
        $re = ['re_c' => $re_c, 're_u' => $re_u];
        return $re;
    }
}
