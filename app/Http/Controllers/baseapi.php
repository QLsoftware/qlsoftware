<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Yangqi\Htmldom\Htmldom;

/**
 * Class baseapi
 * @package App\Http\Controllers
 * 编辑的大家常用的方法   基础方法类
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
        elseif ((string)$result->getBody() == '"用户名或密码错误!"'){
//            TODO 添加异常
            return null;}
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



    //fcq 提供一个查询成绩的接口并将结果保存在数组里
    public static function S_Grade_Inter($j_username, $j_password){
        $client=baseapi::ConnectToBkjs($j_username, $j_password);

        if(!$client) return null;
        //并不知道是个啥
        $json = urldecode('%5B%7B%22name%22%3A%22sEcho%22%2C%22value%22%3A1%7D%2C%7B%22name%22%3A%22iColumns%22%2C%22value%22%3A7%7D%2C%7B%22name%22%3A%22sColumns%22%2C%22value%22%3A%22%22%7D%2C%7B%22name%22%3A%22iDisplayStart%22%2C%22value%22%3A0%7D%2C%7B%22name%22%3A%22iDisplayLength%22%2C%22value%22%3A-1%7D%2C%7B%22name%22%3A%22mDataProp_0%22%2C%22value%22%3A%22xnxq%22%7D%2C%7B%22name%22%3A%22mDataProp_1%22%2C%22value%22%3A%22kch%22%7D%2C%7B%22name%22%3A%22mDataProp_2%22%2C%22value%22%3A%22kcm%22%7D%2C%7B%22name%22%3A%22mDataProp_3%22%2C%22value%22%3A%22kxh%22%7D%2C%7B%22name%22%3A%22mDataProp_4%22%2C%22value%22%3A%22xf%22%7D%2C%7B%22name%22%3A%22mDataProp_5%22%2C%22value%22%3A%22kssj%22%7D%2C%7B%22name%22%3A%22mDataProp_6%22%2C%22value%22%3A%22kscjView%22%7D%2C%7B%22name%22%3A%22iSortCol_0%22%2C%22value%22%3A5%7D%2C%7B%22name%22%3A%22sSortDir_0%22%2C%22value%22%3A%22desc%22%7D%2C%7B%22name%22%3A%22iSortingCols%22%2C%22value%22%3A1%7D%2C%7B%22name%22%3A%22bSortable_0%22%2C%22value%22%3Afalse%7D%2C%7B%22name%22%3A%22bSortable_1%22%2C%22value%22%3Afalse%7D%2C%7B%22name%22%3A%22bSortable_2%22%2C%22value%22%3Afalse%7D%2C%7B%22name%22%3A%22bSortable_3%22%2C%22value%22%3Afalse%7D%2C%7B%22name%22%3A%22bSortable_4%22%2C%22value%22%3Afalse%7D%2C%7B%22name%22%3A%22bSortable_5%22%2C%22value%22%3Atrue%7D%2C%7B%22name%22%3A%22bSortable_6%22%2C%22value%22%3Afalse%7D%5D');
        //并不知道是个啥
        $result = $client->request('post', '/b/cj/cjcx/xs/list',['form_params' => [
            'aoData' => $json,
        ]], ['allow_redirects' => false]);
        $result = get_object_vars(json_decode($result->getBody()));
        //return $result;
        $object = $result["object"];
        $aaData=get_object_vars($object)["aaData"];
        $gradearray=array();
        $count=1;
        $gradearray['0']['0']='课程号';
        $gradearray['0']['1']='课程名';
        $gradearray['0']['2']='课序号';
        $gradearray['0']['3']='学分';
        $gradearray['0']['4']='授课教师';
        $gradearray['0']['5']='课程属性';
        $gradearray['0']['6']='考试时间';
        $gradearray['0']['7']='考试成绩';
        foreach($aaData as $item){
            $gradearray[$count]=array();
            $gradearray[$count]['0']=$item->kch;
            $gradearray[$count]['1']=$item->kcm;
            $gradearray[$count]['2']=$item->kxh;
            $gradearray[$count]['3']=$item->xf;
            $gradearray[$count]['4']=$item->jsm;
            $gradearray[$count]['5']=$item->kcsx;
            $gradearray[$count]['6']=$item->kssj;
            $gradearray[$count]['7']=$item->kscjView;
            $count++;
        }
        return $gradearray;
    }



}
