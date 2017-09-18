<?php

namespace App\Jobs;

use App\Http\Controllers\baseapi;
use App\Jobs\Job;
use App\zjtcourses;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Exceptions\usernamefailed;
use Illuminate\Support\Facades\Log;

/*
 * 抢课任务
 */
class GetC extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
//
    protected $index;
    protected $selected = '已选';
    protected $succ = '成功';
    protected $failed = '失败';
    protected $full = '上课人数已满';
    /**
     * GetC constructor.
     * @param $index
     * 构造方法
     */
    public function __construct($index)
    {
        //
        $this->index = $index;
    }

    /**
     * Execute the job.
     *
     * @return void
     * 下文所说的挂起，就是return;
     * 不挂起，最终会执行dispatch(new GetC($this->index));任务
     **/
    public function handle()
    {
        //        检查任务状态
        echo 'start' .' '. $this->index;
        $zjtcourses = new zjtcourses();
//        若任务已经被删除，挂起
        $con = $zjtcourses->getatask($this->index);
        if ($con['re_c'] == null) {
            echo 'empty';
            return;
        }
//        若任务不是处于正在抢课或者认证状态  挂起
        if (head($con['re_c'])->status == 0 || head($con['re_c'])->status == 4) ; else {
            echo 'status =' . head($con['re_c'])->status;
            return;
        }
//        验证学号密码。
        $client = baseapi::ConnectToxuanke(head($con['re_u'])->j_username, base64_decode(head($con['re_u'])->j_password));
        if ($client == null) {
//            查询系统是否开放
            if (baseapi::testxuanke() == false) {
                sleep(10);
                dispatch(new GetC($this->index));
                Log::info('系统未开放');
                echo '未进入';
                return;
            }
//            若选课系统开放了，还是没有认证成功，则考虑是不是用户的张哈和密码有问题  直接throw这样一个异常，便可以了
//            异常会核实账号和密码是否有问题，若有问题会将密码删除
            throw new usernamefailed(head($con['re_u'])->id);

//            单独判断密码是否有误，若有误，将选课任务设为异常，挂起
            if (baseapi::testj_username(head($con['re_u'])->j_username, base64_decode(head($con['re_u'])->j_password) == -1))
                DB::table('getcourses')->where('index', $this->index)->update(['status' => -2, 'info' => '密码失效']);
        } else {
//            成功进入到了选课系统
            echo '已进入';
            DB::table('getcourses')->where('index', $this->index)->increment('times');
            if (head($con['re_c'])->status == 4) {
                DB::table('getcourses')->where('index', $this->index)->update(['status' => 0]);
//                TODO 检索课程名称
            }
//          请求选课
            $result = $client->request('post', 'http://bkjwxk.sdu.edu.cn/b/xk/xs/add/' . head($con['re_c'])->kch . '/' . head($con['re_c'])->kxh, ['allow_redirects' => false]);
//            TODO 结果分析   由于网站未开放，代码正确性有待确认
            $result = get_object_vars(json_decode($result->getBody()));
            $msg = $result['msg'];
//            课程[数值计算]已选!
//            [数值计算]选课成功!
            if (mb_substr($msg, -3, -1) == $this->selected || mb_substr($msg, -3, -1) == $this->succ) {
                DB::table('getcourses')->where('index', $this->index)->update(['status' => 1]);
                dispatch((new \App\Jobs\sendgetc(head($con['re_u'])->email, head($con['re_c'])->kch, head($con['re_c'])->kxh, head($con['re_c'])->name, 1))->onQueue('email'));
            }
            if (mb_substr($msg, -12,-6) == $this->full) {
                dispatch(new GetC($this->index));
            }
            if (substr($msg, -3) == $this->failed) {
//              TODO 不知所措
                DB::table('getcourses')->where('index', $this->index)->update(['status' => -2, 'info' => $msg]);
                dispatch((new \App\Jobs\sendgetc(head($con['re_u'])->email, head($con['re_c'])->kch, head($con['re_c'])->kxh, head($con['re_c'])->name, -2))->onQueue('email'));
            }
        }
    }


}
