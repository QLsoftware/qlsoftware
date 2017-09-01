<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;
use App\article_recorded;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * 实现本科教育上的信息绑定
 * 本类由ZJT负责维护，请不要编辑
 */
class HomeController_user extends Controller
{
    /**
     * Create a new controller instance.
     *路由中间件，请复制该构造方法
     * 实现用户认证
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('welcome')->with(article_recorded::getlatest());
    }

//   view("link")用户绑定 0 == 没有变量   1 == 绑定成功
    public function link()
    {
        //抓取用户的邮箱
        $where = ['where' => 0];
        return view("link")->with($where);
    }

    public function link_cancel()
    {
        $account = new User();
        $account->deletej_username(Auth::user()['id']);
        return redirect('/profile');
    }

    /**  1==成功绑定   -2==删除账号信息   -1==账号密码不匹配   0==未绑定   -3==网络故障
     * 请求验证学生账号和密码
     **/

    public function link_request(Request $request)
    {
        //单纯进行存储
        $account = new User();
        $account->savej_username(Auth::user()['id'], $request['j_username'], $request['j_password']);
        return redirect('profile');
    }

//    个人设置
    public function profile()
    {
        //判断密码
        /*  1==成功绑定   -2==删除账号信息   -1==账号密码不匹配   0==未绑定   -3==网络故障
         * 请求验证学生账号和密码
         */
        if (Auth::user()['j_username']) {
            $client = baseapi::testj_username(Auth::user()['j_username'], base64_decode(Auth::user()['j_password']));
            if ($client == -1) {
                Auth::user()['j_password'] = null;
                Auth::user()->save();
            } elseif ($client == 1) {
                //正确不处理
            } else {
                ;//TODO
            }
        }

        return view('profile')->with(array('user' => Auth::user()));
    }

//上传头像
    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            //获取头像文件
            $avatar = $request->file('avatar');
            //生成文件名称   getClientOriginalExtension()得到图像的后缀名称
            $file_name = time() . '.' . $avatar->getClientOriginalExtension();
            //修改头像文件的尺寸   并进行本地存储    注意需要先  use Intervention\Image\Facades\Image;
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $file_name));
            //在数据库中保存文件的存储地址      数据库中只保存地址，不存储图像数据
            $user = Auth::user();
            $user->avatar = 'avatars/' . $file_name;
            $user->save();
            //存储结束
        }
        return view('profile')->with(array('user' => Auth::user()));
    }

    /**拒绝接收山东大学的通知**/
    public function sdu_notify_unaccept()
    {
        $user = Auth::user();
        $user->sdu_notify = false;
        $user->save();
        return redirect('/profile');
    }

    /**接收山东大学的通知**/
    public function sdu_notify_accept()
    {
        $user = Auth::user();
        $user->sdu_notify = true;
        $user->save();
        return redirect('/profile');
    }
}
