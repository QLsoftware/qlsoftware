<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class studenonline
 * @package App
 * 连接article_recorded表
 * 核查是否属于新消息
 */
class studenonline extends Model
{
    //
    public function addarecord($title, $data, $href, $from)
    {
        if (DB::table('article_recorded')->where(['href' => $href])->first()) return;
        DB::table('article_recorded')->insert(['title' => $title, 'data' => $data, 'href' => $href, 'from' => $from]);

        $re = DB::table('users')->where(['sdu_notify' => 1])->get();
        foreach ($re as $el) {
            Log::info('请求向' . $el->email . '发送邮件');
//            TODO 添加到email队列
            dispatch((new \App\Jobs\Sendemail($el->email, $title, $el->name, $href, $from, $data))->onQueue('email'));
            dispatch(new \App\Jobs\curl($href));
        }
    }

    public function addarecord_init($title, $data, $href, $from)
    {
        if (DB::table('article_recorded')->where(['href' => $href])->first()) return;
        DB::table('article_recorded')->insert(['title' => $title, 'data' => $data, 'href' => $href, 'from' => $from]);
        dispatch(new \App\Jobs\curl($href));
    }

    public function addarecord_repair($re_xh,$re_name,$re_phone,$re_xq,$re_date,$re_kind,$re_lfh,$re_mph,$re_remarks,$re_state)
    {
        //if (DB::table('repair')->where(['re_id' => $re_id])->first()) return;
        DB::table('repair')->insert(['re_xh' => $re_xh,'re_name' => $re_name,'re_phone'=>$re_phone,'re_xq'=>$re_xq,'re_date'=>$re_date,'re_kind'=>$re_kind,'re_lfh'=>$re_lfh,'re_mph'=>$re_mph,'re_remarks'=>$re_remarks,'re_state'=>$re_state]);

    }
    public function id_max()   //调取最大id号
    {
        $results = DB::table('repair')->max('re_id');
        return  $results;
    }
    public function addarecord_avatars($re_id,$re_avatars)
    {
        //if (DB::table('repair')->where(['re_id' => $re_id])->first()) return;
        DB::table('r_avatars')->insert(['re_id' => $re_id,'re_avatars' => $re_avatars]);

    }
    public function addevaluate($re_id,$re_evaluate)
    {
        echo $re_evaluate;
        echo $re_id;
        $re = repair::find($re_id);
        $re->re_state = $re_evaluate;
        $re ->save();
        return redirect()->back();


    }
}
