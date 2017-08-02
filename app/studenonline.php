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

        $re = DB::table('users')->where(['sdu_notify', '=', true])->get();
        foreach ($re as $el) {
            Log::info('请求向' . $el->email . '发送邮件');
//            TODO 添加到email队列
            dispatch((new \App\Jobs\Sendemail($el->email, $title, $el->name, $href, $from, $data))->onQueue('email'));
        }
    }

    public function addarecord_init($title, $data, $href, $from)
    {
        if (DB::table('article_recorded')->where(['href' => $href])->first()) return;
        DB::table('article_recorded')->insert(['title' => $title, 'data' => $data, 'href' => $href, 'from' => $from]);
    }
}
