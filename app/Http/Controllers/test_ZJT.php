<?php

namespace App\Http\Controllers;

use App\Exceptions\usernamefailed;
use App\Jobs\curl;
use App\studenonline;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
//导入Guzzle  对外http请求的包
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;
use App\zjtcourses;
use App\repair;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Yangqi\Htmldom\Htmldom;
use Yangqi\Htmldom\HtmldomServiceProvider;
use App\Http\Requests;

/**
 * Class test_ZJT
 * @package App\Http\Controllers
 * 临时测试类    没有最终价值
 */
class test_ZJT extends Controller
{

    protected $index = 9;

    protected $email = '851207685@qq.com';
    protected $title = '关于2014级本科生因暑期夏令营申请缓考科目补考时间的通知';
    protected $name = 'Jingtao';
    protected $link = 'http://www.bkjx.sdu.edu.cn/info/1010/25308.htm';
    protected $from = '本科教育';
    protected $selected = '已选';
    protected $succ = '成功';
    protected $failed = '失败';
    protected $full = '上课人数已满';
    protected $fre = '访问频率过快了,休息一下吧 :)';


    //添加中间件，进行
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {




        return DB::table('users')->where(['sdu_notify' => 1])->get();
        //        检查任务状态
        echo 'start' .' '. $this->index;
        $zjtcourses = new zjtcourses();
//        若任务已经被删除，挂起
        $con = $zjtcourses->getatask($this->index);
        if ($con['re_c'] == null) {
            echo 'empty';
            return;
        }

        return baseapi::testj_username(head($con['re_u'])->j_username, base64_decode(head($con['re_u'])->j_password));
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
            return 'asdasdasdasd'.mb_substr($msg, -12,-6) . 'asd';
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



    //Guzzle使用实例   具体教程：http://guzzle-cn.readthedocs.io/zh_CN/latest/
    function fun_test1_zjt(Request $request)
    {
//
        $client = baseapi::ConnectToBkjs(Auth::user()['j_username'], base64_decode(Auth::user()['j_password']));
        if ($client == null) {
            return '认证失败';
        } else {
//            若返回不会空，表示client是可以用来直接访问http://bkjws.sdu.edu.cn根地址下的网址
//            该方法返回了联系方式中的家庭住址
            $result = $client->request('post', '/b/grxx/xs/xjxx/detail', ['allow_redirects' => false]);
//            对返回的json数据 进行处理 不懂的话只能私聊了，我也说不太清楚    反正就是将json数据转成stdClass在转成数组，然后就能用了
            $result = get_object_vars(json_decode($result->getBody()));
            $result = get_object_vars($result['object']);
            $msg = $result['msg'];
            echo $result['jg'];
        }

    }
}
