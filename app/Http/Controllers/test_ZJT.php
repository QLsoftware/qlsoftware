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

    protected $index = 10;

    protected $email = '851207685@qq.com';
    protected $title = '关于2014级本科生因暑期夏令营申请缓考科目补考时间的通知';
    protected $name = 'Jingtao';
    protected $link = 'http://www.bkjx.sdu.edu.cn/info/1010/25308.htm';
    protected $from = '本科教育';


    //添加中间件，进行
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {


        return DB::table('repair')->where(['re_evaluate' => '好'],['re_xq'=>'中心校区'])->count();
//        echo 'ceshi       <br>';
//        $jar = new \GuzzleHttp\Cookie\CookieJar();
//        $mima = md5('DREAM0418');
//        $client = new Client([
//            // Base URI is used with relative requests
//            'base_uri' => 'http://bkjws.sdu.edu.cn',
//            // You can set any number of default request options.
//            'timeout' => 2.0,
//            //参数
//            'form_params' => [
//                'j_username' => '201500130051',
//                'j_password' => $mima,
//            ],
//            'cookies' => $jar,
//        ]);
//        $result = null;
//        try {
//            $result = $client->request('post', '/b/ajaxLogin');
//        } catch (\Exception $exception) {
//            return null;
//        }
//        $result = $client->request('post', '/b/');
//        return $result->getBody();
//        if ((string)$result->getBody() == '"success"')
//            return 1;
//        elseif ((string)$result->getBody() == '"对不起,用户名或密码输入有误,请重新输入!"')
//            return -1;
//        else {
//            return $result->getBody();
//        }


//        $re = DB::select('select title , count(*) as num from chatter_post nature join chatter_discussion group by chatter_discussion_id ;');
//        $result = [];
//        $i = 0;
//        $text_other = '其他';
//        $count_other = 0;
//        foreach ($re as $r) {
//            if ($i > 8) {
//                $count_other += $r->num;
//                continue;
//            }
//            $result[$i] = [$r->title, $r->num];
//            $i++;
//        }
//        if ($count_other > 0)
//            $result[$i] = [$text_other, $count_other];
//        return $result;
//

//        Mail::raw('这是一封测试邮件', function ($message) {
//            $to = '851207685@qq.com';
//            $message ->to($to)->subject('测试邮件');
//        });
//        $re = DB::table('users')->where(['sdu_notify' => true])->get();
//        return $re;
//       echo urlencode('解释  我是谁  ');
//        $re = DB::select('select count(*) as num from article_recorded');
//        echo head($re)->num;
//        $hrefs = DB::table('article_recorded')->get();
//        foreach ($hrefs as $href) {
//            dispatch(new curl($href->href));
//        }


        /**
         * //        echo base64_decode(Auth::user()['j_password']);
         * //        $jar = new \GuzzleHttp\Cookie\CookieJar();
         * //        $client = new Client([
         * //            // Base URI is used with relative requests
         * //            'base_uri' => 'http://bkjwxk.sdu.edu.cn',
         * //            // You can set any number of default request options.
         * //            'timeout' => 2.0,
         * //            //参数
         * //            'form_params' => [
         * //                'j_username' => 201500130051,
         * //                'j_password' => 'Dream0418',
         * //            ],
         * //            'cookies' => $jar,
         * //        ]);
         * //        $result = null;
         * //        try {
         * //            $result = $client->request('post', '/b/ajaxLogin');
         * //        } catch (\Exception $exception) {
         * //            echo 'failed';
         * //            return null;
         * //        }
         * **/

        /**
         * //        throw new usernamefailed(1);
         * //        $flag = Mail::send('email.notification', ['name' => $this->name, 'link' => $this->link, 'from' => $this->from, 'title' => $this->title,'1'],
         * //            function ($message) {
         * //                $message->to($this->email)->subject('智慧山大通知邮件');
         * //            });
         * //        if ($flag) {
         * //            echo $this->email . '发送成功<br>';
         * //        } else {
         * //            echo $this->email . '发送失败<br>';
         * //        }
         **/
        /**
         * //        dispatch(new \App\Jobs\Sendemail('851207685@qq.com', '关于2014级本科生因暑期夏令营申请缓考科目补考时间的通知', 'Jingtao', 'http://www.bkjx.sdu.edu.cn/info/1010/25308.htm', '本科教育'));
         * //        $studenonline = new studenonline();
         * ////            $html = new Htmldom('https://online.sdu.edu.cn/news/list-8-' . $i . '.html');
         * //        for ($i = 285; $i <= 295; $i++) {
         * //            $html = new Htmldom('http://www.bkjx.sdu.edu.cn/index/gztz/' . $i . '.htm');
         * //            foreach ($html->find('a') as $elment) {
         * //                if ($a = $elment->target == '_blank' && $elment->innertext() != '旧版回顾' && $elment->innertext() != '后台管理' && $elment->innertext() != '博达软件') {
         * //                    echo $elment->title . '<br>';
         * //                    echo $elment->innertext() . '<br>';
         * //                    $b = $elment->parent()->next_sibling();
         * //                    echo substr($elment->parent()->next_sibling()->plaintext, 1, 10) . '<br>';
         * //                    if (strstr($elment->href, ':'))
         * //                        $studenonline->addarecord($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), $elment->href, '本科教育');
         * //                    else
         * //                        $studenonline->addarecord($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), 'http://www.bkjx.sdu.edu.cn/' . substr($elment->href, 3), '本科教育');
         * //                }
         * //            }
         * ////        $count = 0;
         * ////        foreach ($html->find('ul') as $ele) {
         * ////            if ($count++ <= 2)
         * //                continue;
         * //            foreach ($ele->find('li') as $element) {
         * //                if ($element->firstChild()->href == null)
         * //                    continue;
         * //                $str = str_replace("\t", "", $element->plaintext);
         * //                $str = str_replace(" ", "", $str);
         * //                $a = substr($str, 0, strlen($str) - 12);
         * //                $b = substr($str, -11, -1);
         * //                if (strstr($element->firstChild()->href, ':'))
         * //                    $studenonline->addarecord(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), $element->firstChild()->href, '青春山大');
         * //                $studenonline->addarecord(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), 'http://www.youth.sdu.edu.cn/news/' . $element->firstChild()->href, '青春山大');
         * //            }
         * //        }
         * //            $html->clear();
         * //        }
         **/
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
