<?php

namespace App\Http\Controllers;

use App\account;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\zjtcourses;
use Illuminate\Support\Facades\Auth;

/**
 * Class Getcourses
 * @package App\Http\Controllers
 * 抢课功能的实现
 * 本类由ZJT进行维护，请不要编辑
 */
class Getcourses extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
//status   0 == 正在抢课    1 == 抢课成功   -1 == 暂停   -2 == 出现异常
//检索信息
    public function index()
    {
        $zjtcourses = new zjtcourses();
        $cour = $zjtcourses->getonescouser(Auth::user()['id']);
        if (baseapi::testxuanke() == false)
            $re = ["courses" => ($cour), "status" => '选课系统未开放'];
        else
            $re = ["courses" => ($cour), "status" => '选课系统已开放'];
        return view('getcourses')->with($re);
    }

//删除行
    public function del(Request $request)
    {
        $course = new zjtcourses();
        $course->del(Auth::user()['id'], $request['kch'], $request['kxh']);
        return redirect('/zjt/getc');
    }

//TODO
    public function pause(Request $request)
    {
        $re = $request['kch'];
        $course = new zjtcourses();
        $course->pause(Auth::user()['id'], $request['kch'], $request['kxh']);
        return redirect('/zjt/getc');
    }

    public function restart(Request $request)
    {
        $course = new zjtcourses();
        dispatch(new \App\Jobs\GetC(
            $course->restart(Auth::user()['id'], $request['kch'], $request['kxh'])
        ));
        return redirect('/zjt/getc');
    }

//添加新任务
    public function getnew(Request $request)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bkjwxk.sdu.edu.cn',
            // You can set any number of default request options.
            'timeout' => 2.0,
            //参数
            'form_params' => [
                'j_username' => Auth::user()["j_username"],
                'j_password' => Auth::user()['j_password'],
            ],
        ]);
//        TODO 抢课
//        $result = $client->request('post', '/b/ajaxLogin', ['cookies' => $jar]);
//        if ((string)$result->getBody() == '"用户名或密码错误!"')
//            ;// 异常处理
        $coursename = "等待查询课程名称";
        $add = "/b/xk/xs/add/" . $request["kch"] . "/" . $request["kxh"];
//        $result = $client->request('post', $add, ['cookies' => $jar]);
        // 结果处理

        $getC = new zjtcourses();
        if (($index = $getC->getnew(Auth::user()['id'], $request["kch"], $request["kxh"], $coursename))) {
//            启动抢课任务
            dispatch(new \App\Jobs\GetC($index));
            return redirect('/zjt/getc');
        }
        return redirect('/zjt/getc');
    }
}
