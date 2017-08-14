<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\baseapi;

/**
 * Class User
 * @package App
 * 管理Users表
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'identify'
    ];
//  identify    1为学生    2为维修后台
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function savej_username($id, $acc, $pass)
    {
        DB::table('users')->where('id', $id)->update(['j_username' => $acc, 'j_password' => base64_encode($pass)]);
    }

    public function deletej_username($id)
    {
        DB::table('users')->where('id', $id)->update(['j_username' => null, 'j_password' => null]);
    }

    public function passwordfail($id)
    {
        $re = DB::table('users')->where('id', $id)->first();
        if (baseapi::testj_username($re->j_username, base64_decode($re->j_password)))
            DB::table('users')->where('id', $id)->update(['j_password' => null]);
    }
    public function getcourse()
    {
        $this->hasMany(getcourse::class);
    }



}
