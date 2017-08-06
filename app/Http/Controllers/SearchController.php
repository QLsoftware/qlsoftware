<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\baseapi;
use App\zjtcourses;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Yangqi\Htmldom\Htmldom;
use App\studenonline;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\usernamefailed;


class SearchController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // $SearchOption    0 查询      1 课程查询      2 自习室查询      3 校车查询        4 绩点查询
    public function search()
    {
        $SearchOption = ['SearchOption' => 0];
        return view('search')->with($SearchOption);
    }

    public function search_course()
    {

        $client = baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));
        /*zjt：需要判断是否获得了对象*/
        if (!$client) return;
        $result = $client->request('post', '/f/xk/xs/bxqkb', ['allow_redirects' => false]);
        //return (string)$result->getBody();
        $result = (string)$result->getBody();//(string)$result->getBody();
        $html = new Htmldom();
        $html->load($result);
       // echo 1;
        $coursearray = array();
       // echo 2;
        $count = 0;
        $count_1 = 0;
        foreach ($html->find('table') as $element) {
           // foreach($element->find('tbody') as $element_0) {
            if($element->id!="ysjddDataTableId")
                continue;

                //return $element->plaintext;
                //break;

                foreach ($element->find('tr') as $element_1) {
                    $coursearray[$count] = array();
                    $count_1 = 0;

                    foreach ($element_1->find('th') as $element_2) {//echo 4;
                        $str = str_replace(" ", "", $element_2->plaintext);
                        $coursearray[$count][$count_1] =$str;
                        $count_1++;
                    }
                    foreach ($element_1->find('td') as $element_2) {//echo 6;
                        $str = str_replace(" ", "", $element_2->plaintext);
                        $coursearray[$count][$count_1] = $str;
                        $count_1++;
                    }//echo $coursearray[$count]['0'];
                    $count++;
                }



          //  }
        }
        $CourseArray = array();
        for($i=0;$i<8;$i++){
            $CourseArray[$i]=array();
            for($j=0;$j<8;$j++){
                $CourseArray[$i][$j]='';
            }
        }
        $CourseArray['0']['0']='节次/星期';
        $CourseArray['0']['1']='星期一';
        $CourseArray['0']['2']='星期二';
        $CourseArray['0']['3']='星期三';
        $CourseArray['0']['4']='星期四';
        $CourseArray['0']['5']='星期五';
        $CourseArray['0']['6']='星期六';
        $CourseArray['0']['7']='星期日';
        $CourseArray['1']['0']='第一节';
        $CourseArray['2']['0']='第二节';
        $CourseArray['3']['0']='第三节';
        $CourseArray['4']['0']='第四节';
        $CourseArray['5']['0']='第五节';
        $CourseArray['6']['0']='第六节';
        $CourseArray['7']['0']='第七节';
        for($i=1;$i<$count;$i++){
            $CourseArray[$coursearray[$i]['9']][$coursearray[$i]['10']]=$coursearray[$i]['2'].' ('.$coursearray[$i]['5'].')-'.$coursearray[$i]['7'];
        }
       // return $CourseArray;
//echo $CourseArray['1']['1'];


        //echo 5;
        $SearchOption = ['SearchOption' => 1, 'countarray' => $coursearray, 'count' => $count, 'count_1' => $count_1,'CourseArray'=>$CourseArray];

        return view('search')->with($SearchOption);
    }

    public function search_room()
    {
        $SearchOption = ['SearchOption' => 2];
        return view('search')->with($SearchOption);
    }

    public function search_car()
    {
        $SearchOption = ['SearchOption' => 3];
        return view('search')->with($SearchOption);
    }

    public function search_grade()
    {
        $SearchOption = ['SearchOption' => 4];
        return view('search')->with($SearchOption);
    }
}
