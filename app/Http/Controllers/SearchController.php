<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $SearchOption=['SearchOption' => 1];
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
