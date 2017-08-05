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
    public function search(){
        $SearchOption=['SearchOption' => 0];
        return view('search')->with($SearchOption);
    }
    public function search_course(){

        $client = baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));
        $result = $client->request('post', '/f/xk/xs/bxqkb', ['allow_redirects' => false]);
        $result=(string)$result->getBody();//(string)$result->getBody();
        $html=new Htmldom();
//echo $result;
        $html->load($result);
        echo 1;
        $coursearray=array();
        echo 2;
        $count=0;
        $count_1=0;
        foreach($html->find('tbody') as $element){echo 3;
            $coursearray[$count]=array();
            $count_1=0;
            foreach($element->find('tr') as $element_1){echo 4;
                foreach($element_1->find('th') as $element_2){
                    $coursearray[$count][$count_1]=$element_2->plaintext;
                    $count_1++;
                }
                foreach($element_1->find('td') as $element_2){
                    $coursearray[$count][$count_1]=$element_2->plaintext;
                    $count_1++;
                }
            }
            $count++;

        }

        echo 5;
        $SearchOption=['SearchOption' => 1,'countarray' => $coursearray,'count'=>$count,'count_1'=>$count_1];
        echo $SearchOption['SearchOption'];
        return view('search')->with($SearchOption);
    }
    public function search_room(){
        $SearchOption=['SearchOption' => 2];
        return view('search')->with($SearchOption);
    }
    public function search_car(){
        $SearchOption=['SearchOption' => 3];
        return view('search')->with($SearchOption);
    }
    public function search_grade(){
        $SearchOption=['SearchOption' => 4];
        return view('search')->with($SearchOption);
    }
}
