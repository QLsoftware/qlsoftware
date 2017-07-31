<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

/**
 * Class baseapi
 * @package App\Http\Controllers
 * 编辑的大家常用的方法
 * 欢迎大家的补充 TODO
 */
class baseapi extends Controller
{

    /**连接到本科教育的网站上  认证成功会返回client对象，认证失败会返回null
     *连接到本科教育网站，输入参数：账号和密码  注意密码如果使用Auth中的请使用
     *          base64_decode(Auth::user()['j_password'])  对密码先进行解密
     * 返回变量  若成功返回Guzzle\Client   若失败 !!任何原因的失败: 包括网络中断 密码失效和其他原因的错误!! ,返回null
     * 示例程序:app\Http\Controllers\baseapi.php文件中的fun_test1_zjt()方法
     **/
    public static function ConnectToBkjs($j_username, $j_password)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bkjws.sdu.edu.cn',
            // You can set any number of default request options.
            'timeout' => 2.0,
            //参数
            'form_params' => [
                'j_username' => $j_username,
                'j_password' => $j_password,
            ],
            'cookies' => $jar,
        ]);
        $result = null;
        try {
            $result = $client->request('post', '/b/ajaxLogin');
        } catch (\Exception $exception) {
            return null;
        }
        if ((string)$result->getBody() == '"success"')
            return $client;
        elseif ((string)$result->getBody() == '"用户名或密码错误!"')
            return null;
        else {
            echo '未判断';
            return null;
        }

    }

    /**   连接到本科教育的网站上   测试账号和密码是否正确
     *    学号密码正确返回1     学号密码错误返回0     因为网络原因无法认证返回0
     *    示例程序请参考 app\Http\Controllers\HomeController.php文件中的link_request()方法
     **/
    public static function testj_username($j_username, $j_password)
    {

        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bkjws.sdu.edu.cn',
            // You can set any number of default request options.
            'timeout' => 2.0,
            //参数
            'form_params' => [
                'j_username' => $j_username,
                'j_password' => $j_password,
            ],
            'cookies' => $jar,
        ]);
        $result = null;
        try {
            $result = $client->request('post', '/b/ajaxLogin');
        } catch (\Exception $exception) {
            return null;
        }
        if ((string)$result->getBody() == '"success"')
            return 1;
        elseif ((string)$result->getBody() == '"用户名或密码错误!"')
            return -1;
        else {
            return 0;
        }

    }

    /**连接到本科教育的网站上  认证成功会返回client对象，认证失败会返回null
     *连接到本科教育网站，输入参数：账号和密码  注意密码如果使用Auth中的请使用
     *          base64_decode(Auth::user()['j_password'])  对密码先进行解密
     * 返回变量  若成功返回Guzzle\Client   若失败 !!任何原因的失败: 包括网络中断 密码失效和其他原因的错误!! ,返回null
     * 示例程序:    app/Jobs/GetC.php
     **/
    public static function ConnectToxuanke($j_username, $j_password)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bkjwxk.sdu.edu.cn',
            // You can set any number of default request options.
            'timeout' => 2.0,
            //参数
            'form_params' => [
                'j_username' => $j_username,
                'j_password' => $j_password,
            ],
            'cookies' => $jar,
        ]);
        $result = null;
        try {
            $result = $client->request('post', '/b/ajaxLogin');
        } catch (\Exception $exception) {
            return null;
        }
        if ((string)$result->getBody() == '"success"')
            return $client;
        elseif ((string)$result->getBody() == '"用户名或密码错误!"')
            return null;
        else {
            echo '未判断';
            return null;
        }

    }

    /**
     * @return bool
     * 查询选课系统是否开放    开放返回true    关闭选择false
     */
    public static function testxuanke()
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://bkjwxk.sdu.edu.cn',
            // You can set any number of default request options.
            'timeout' => 2.0,
            //参数
            'form_params' => [
                'j_username' => '201500130000',
                'j_password' => '0000000',
            ],
            'cookies' => $jar,
        ]);
        $result = null;
        try {
            $result = $client->request('post', '/b/ajaxLogin');
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
