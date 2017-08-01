<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * 实现本科教育上的信息绑定
 * 本类由ZJT负责维护，请不要编辑
 */
class HomeController extends Controller
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
        $where = ['where' => -2];
        return view('link')->with($where);
    }

    /**  1==成功绑定   -2==删除账号信息   -1==账号密码不匹配   0==未绑定   -3==网络故障
     * 请求验证学生账号和密码
     **/

    public function link_request(Request $request)
    {
        //认证
        $client = baseapi::testj_username($request['j_username'], $request['j_password']);
//  添加cookie  第一步认证，第二步抓取数据   若认证失败，则会出现/f/login的地址，并报错

        if ($client == -1) {
            $where = ['where' => -1];
            return view('link')->with($where);
        } elseif ($client == 1) {
            $account = new User();
            $account->savej_username(Auth::user()['id'], $request['j_username'], $request['j_password']);
            $where = ['where' => 1, 'j_u' => $request['j_username']];
            return view('link')->with($where);
        } else {
            $where = ['where' => -3];
            return view('link')->with($where);
        }
    }

//    个人设置
    public function profile()
    {
        return view('profile')->with(array('user' => Auth::user()));
    }

//上传图片
    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $file_name = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $file_name));
            $user = Auth::user();
            $user->avatar = '/uploads/avatars/' . $file_name;
            $user->save();
        }
        return view('profile')->with(array('user' => Auth::user()));
    }

}
