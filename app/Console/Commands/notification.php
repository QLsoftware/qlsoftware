<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Yangqi\Htmldom\Htmldom;
use App\studenonline;
use Illuminate\Support\Facades\Log;

/**
 * Class notification
 * @package App\Console\Commands
 * 介绍：
 * 定时从青春山大、学生在线、本科教育的通知处下载最新的消息通知，比对数据库，将新添加的消息，发送给用户
 * 主要使用的是Htmldom接口实现的html文件分析
 * 在../Kernel.php文件中，被定时唤醒
 */
class notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'new notification send email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function studentonline()
    {
        $studenonline = new studenonline();
        $html = new Htmldom('https://online.sdu.edu.cn/news/list-8.html');

        foreach ($html->find('ul') as $ele) {
            foreach ($ele->find('li') as $element) {
                if ($element->firstChild()->href == null)
                    continue;
                $str = str_replace(" ", "", $element->plaintext);
                if (strstr($element->firstChild()->href, ':'))
                    $studenonline->addarecord(substr($str, 0, strlen($str) - 10), substr($str, -10), $element->firstChild()->href, '学生在线');
                else
                    $studenonline->addarecord(substr($str, 0, strlen($str) - 10), substr($str, -10), 'https://online.sdu.edu.cn/news/' . $element->firstChild()->href, '学生在线');
            }
        }
        $html->clear();
    }

    public function studentonline_init()
    {
        $studenonline = new studenonline();
        $html = new Htmldom('https://online.sdu.edu.cn/news/list-8.html');
        foreach ($html->find('ul') as $ele) {
            foreach ($ele->find('li') as $element) {
                if ($element->firstChild()->href == null)
                    continue;
                $str = str_replace(" ", "", $element->plaintext);
                if (strstr($element->firstChild()->href, ':'))
                    $studenonline->addarecord_init(substr($str, 0, strlen($str) - 10), substr($str, -10), $element->firstChild()->href, '学生在线');
                else
                    $studenonline->addarecord_init(substr($str, 0, strlen($str) - 10), substr($str, -10), 'https://online.sdu.edu.cn/news/' . $element->firstChild()->href, '学生在线');
            }
        }
        $html->clear();

        for ($i = 2; $i <= 132; $i++) {
            $html = new Htmldom('https://online.sdu.edu.cn/news/list-8-' . $i . '.html');
            foreach ($html->find('ul') as $ele) {
                foreach ($ele->find('li') as $element) {
                    if ($element->firstChild()->href == null)
                        continue;
                    $str = str_replace(" ", "", $element->plaintext);
                    if (strstr($element->firstChild()->href, ':'))
                        $studenonline->addarecord_init(substr($str, 0, strlen($str) - 10), substr($str, -10), $element->firstChild()->href, '学生在线');
                    else
                        $studenonline->addarecord_init(substr($str, 0, strlen($str) - 10), substr($str, -10), 'https://online.sdu.edu.cn/news/' . $element->firstChild()->href, '学生在线');
                }
            }
            $html->clear();
        }
    }

    public function yourth()
    {
        $studenonline = new studenonline();
//            $html = new Htmldom('https://online.sdu.edu.cn/news/list-8-' . $i . '.html');
        $html = new Htmldom('http://www.youth.sdu.edu.cn/news/list.jsp');
        $count = 0;
        $count_1 = 0;
        foreach ($html->find('ul') as $ele) {
            if ($count++ <= 2)
                continue;
            foreach ($ele->find('li') as $element) {
                if ($count_1++ > 20)
                    break;
                if ($element->firstChild()->href == null)
                    continue;
                $str = str_replace("\t", "", $element->plaintext);
                $str = str_replace(" ", "", $str);
                if (strstr($element->firstChild()->href, ':'))
                    $studenonline->addarecord(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), $element->firstChild()->href, '青春山大');
                else
                    $studenonline->addarecord(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), 'http://www.youth.sdu.edu.cn/news/' . $element->firstChild()->href, '青春山大');
            }

        }
        $html->clear();
    }

    public function yourth_init()
    {
        $studenonline = new studenonline();
//            $html = new Htmldom('https://online.sdu.edu.cn/news/list-8-' . $i . '.html');
        $html = new Htmldom('http://www.youth.sdu.edu.cn/news/list.jsp');
        $count = 0;
        foreach ($html->find('ul') as $ele) {
            if ($count++ <= 2)
                continue;
            foreach ($ele->find('li') as $element) {
                if ($element->firstChild()->href == null)
                    continue;
                $str = str_replace("\t", "", $element->plaintext);
                $str = str_replace(" ", "", $str);
                if (strstr($element->firstChild()->href, ':'))
                    $studenonline->addarecord_init(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), $element->firstChild()->href, '青春山大');
                else
                    $studenonline->addarecord_init(substr($str, 0, strlen($str) - 12), substr($str, -11, -1), 'http://www.youth.sdu.edu.cn/news/' . $element->firstChild()->href, '青春山大');
            }

        }
        $html->clear();
    }

    public function education()
    {
        $studenonline = new studenonline();
        $html = new Htmldom('http://www.bkjx.sdu.edu.cn/index/gztz.htm');
        foreach ($html->find('a') as $elment) {
            if ($a = $elment->target == '_blank' && $elment->innertext() != '旧版回顾' && $elment->innertext() != '后台管理' && $elment->innertext() != '博达软件') {
                echo $elment->title . '<br>';
                echo $elment->innertext() . '<br>';
//                $b = $elment->parent()->next_sibling();
                echo substr($elment->parent()->next_sibling()->plaintext, 1, 10) . '<br>';
                if (strstr($elment->href, ':'))
                    $studenonline->addarecord($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), $elment->href, '本科教育');
                else
                    $studenonline->addarecord($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), 'http://www.bkjx.sdu.edu.cn/' . substr($elment->href, 3), '本科教育');
            }
        }
        $html->clear();
    }


    public function education_init()
    {
        $studenonline = new studenonline();
        $html = new Htmldom('http://www.bkjx.sdu.edu.cn/index/gztz.htm');
        foreach ($html->find('a') as $elment) {
            if ($a = $elment->target == '_blank' && $elment->innertext() != '旧版回顾' && $elment->innertext() != '后台管理' && $elment->innertext() != '博达软件') {
                echo $elment->title . '<br>';
                echo $elment->innertext() . '<br>';
                $b = $elment->parent()->next_sibling();
                echo substr($elment->parent()->next_sibling()->plaintext, 1, 10) . '<br>';
                if (strstr($elment->href, ':'))
                    $studenonline->addarecord_init($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), $elment->href, '本科教育');
                else
                    $studenonline->addarecord_init($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), 'http://www.bkjx.sdu.edu.cn/' . substr($elment->href, 3), '本科教育');
            }
        }
        $html->clear();
        for ($i = 285; $i >= 1; $i--) {
            $html = new Htmldom('http://www.bkjx.sdu.edu.cn/index/gztz/' . $i . '.htm');
            foreach ($html->find('a') as $elment) {
                if ($a = $elment->target == '_blank' && $elment->innertext() != '旧版回顾' && $elment->innertext() != '后台管理' && $elment->innertext() != '博达软件') {
                    echo $elment->title . '<br>';
                    echo $elment->innertext() . '<br>';
                    $b = $elment->parent()->next_sibling();
                    echo substr($elment->parent()->next_sibling()->plaintext, 1, 10) . '<br>';
                    if (strstr($elment->href, ':'))
                        $studenonline->addarecord_init($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), $elment->href, '本科教育');
                    else
                        $studenonline->addarecord_init($elment->title, substr($elment->parent()->next_sibling()->plaintext, 1, 10), 'http://www.bkjx.sdu.edu.cn/' . substr($elment->href, 3), '本科教育');
                }
            }
            $html->clear();
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $re = DB::select('select count(*) as num from article_recorded');
        if (head($re)->num < 100) {
            $this->studentonline_init();
            $this->yourth_init();
            $this->education_init();
//            $hrefs = DB::table('article_recorded')->get();
//            foreach ($hrefs as $href) {
//                dispatch(new \App\Jobs\curl($href->href));
//            }
            Log::info(date('h:i:sa') . '山大信息初始化成功');
        } else {
            $this->studentonline();
            $this->yourth();
            $this->education();
            Log::info(date('h:i:sa') . '山大更新信息成功');
        }
    }
}
