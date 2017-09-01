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
//    public function search()
//    {
//        $SearchOption = ['SearchOption' => 0];
//        return view('search')->with($SearchOption);
//    }

    public function search_course()
    {

        $client = baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));
        /*zjt：需要判断是否获得了对象*/
        if (!$client) return redirect('/profile');
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

//    public function search_room()
//    {
//        $SearchOption = ['SearchOption' => 2];
//        return view('search')->with($SearchOption);
//    }

//    public function search_car()
//    {
//        //echo date('md');
//        if(date('m')>10||(date('m')==10&&date('d')>=8)||date('m')<4||(date('m')==4&&date('d')<=30))
//            $html=new Htmldom('http://202.194.192.251/main.htm');
//        else
//            $html=new Htmldom('http://202.194.192.251/2.html');
//        $SearchOption = ['SearchOption' => 3];
//        return view('search')->with($SearchOption);
//    }

    public function search_grade()
    {
        //$gradearray=baseapi::S_Grade_Inter(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));
        //return $gradearray['0']['0'];
        $client=baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));

        if(!$client) return null;
        //并不知道是个啥
        $aoDate = '[{"name":"sEcho","value":1},{"name":"iColumns","value":8},{"name":"sColumns","value":""},{"name":"iDisplayStart","value":0},{"name":"iDisplayLength","value":-1},{"name":"mDataProp_0","value":"function"},{"name":"mDataProp_1","value":"kch"},{"name":"mDataProp_2","value":"kcm"},{"name":"mDataProp_3","value":"kxh"},{"name":"mDataProp_4","value":"xf"},{"name":"mDataProp_5","value":"kssj"},{"name":"mDataProp_6","value":"kscjView"},{"name":"mDataProp_7","value":"kcsx"},{"name":"iSortingCols","value":0},{"name":"bSortable_0","value":false},{"name":"bSortable_1","value":false},{"name":"bSortable_2","value":false},{"name":"bSortable_3","value":false},{"name":"bSortable_4","value":false},{"name":"bSortable_5","value":false},{"name":"bSortable_6","value":false},{"name":"bSortable_7","value":false}]';
        //并不知道是个啥
        $result = $client->request('post', '/b/cj/cjcx/xs/list',['form_params' => [
            'aoData' => $aoDate,
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
//以上为本学期成绩查询

        $result1 = $client->request('post', '/b/cj/cjcx/xs/bjgcx',['form_params' => [
            'aoData' => '[{"name":"sEcho","value":1},{"name":"iColumns","value":7},{"name":"sColumns","value":""},{"name":"iDisplayStart","value":0},{"name":"iDisplayLength","value":-1},{"name":"mDataProp_0","value":"xnxq"},{"name":"mDataProp_1","value":"kch"},{"name":"mDataProp_2","value":"kcm"},{"name":"mDataProp_3","value":"kxh"},{"name":"mDataProp_4","value":"xf"},{"name":"mDataProp_5","value":"kssj"},{"name":"mDataProp_6","value":"kscjView"},{"name":"iSortCol_0","value":5},{"name":"sSortDir_0","value":"desc"},{"name":"iSortingCols","value":1},{"name":"bSortable_0","value":false},{"name":"bSortable_1","value":false},{"name":"bSortable_2","value":false},{"name":"bSortable_3","value":false},{"name":"bSortable_4","value":false},{"name":"bSortable_5","value":true},{"name":"bSortable_6","value":false}]',
        ]], ['allow_redirects' => false]);
        $result1 = get_object_vars(json_decode($result1->getBody()));
        $object1=$result1["object"];
        $aaData1=get_object_vars($object1)["aaData"];
        $bjgarray=array();
        $count1=1;
        $bjgarray['0']['0']='课程号';
        $bjgarray['0']['1']='课程名';
        $bjgarray['0']['2']='课序号';
        $bjgarray['0']['3']='学分';
        $bjgarray['0']['4']='学年学期';
        $bjgarray['0']['5']='考试时间';
        $bjgarray['0']['6']='总成绩';
        foreach($aaData1 as $item){
            $bjgarray[$count]=array();
            $bjgarray[$count]['0']=$item->kch;
            $bjgarray[$count]['1']=$item->kcm;
            $bjgarray[$count]['2']=$item->kxh;
            $bjgarray[$count]['3']=$item->xf;
            $bjgarray[$count]['4']=$item->xnxq;
            $bjgarray[$count]['5']=$item->kssj;
            $bjgarray[$count]['6']=$item->kscjView;
            $count++;
        }


        $SearchOption = ['SearchOption' => 4,'gradearray'=>$gradearray,'bjgarray'=>$bjgarray];
        return view('search')->with($SearchOption);
    }
}
