<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Evaluate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function evaluate(){
        $client=baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));

        if(!$client) return redirect('/profile');
        //并不知道是个啥
        $aoDate = '[{"name":"sEcho","value":1},{"name":"iColumns","value":8},{"name":"sColumns","value":""},{"name":"iDisplayStart","value":0},{"name":"iDisplayLength","value":-1},{"name":"mDataProp_0","value":"function"},{"name":"mDataProp_1","value":"kch"},{"name":"mDataProp_2","value":"kcm"},{"name":"mDataProp_3","value":"kxh"},{"name":"mDataProp_4","value":"xf"},{"name":"mDataProp_5","value":"kssj"},{"name":"mDataProp_6","value":"kscjView"},{"name":"mDataProp_7","value":"kcsx"},{"name":"iSortingCols","value":0},{"name":"bSortable_0","value":false},{"name":"bSortable_1","value":false},{"name":"bSortable_2","value":false},{"name":"bSortable_3","value":false},{"name":"bSortable_4","value":false},{"name":"bSortable_5","value":false},{"name":"bSortable_6","value":false},{"name":"bSortable_7","value":false}]';
        //并不知道是个啥
        $result = $client->request('post', '/b/pg/xs/list',['form_params' => [
            'aoData' => $aoDate,
        ]], ['allow_redirects' => true]);
        $result = get_object_vars(json_decode($result->getBody()));
        $object = $result["object"];
        $aaData=get_object_vars($object)["aaData"];
        $evaarray=array();
        $evaarray['0']['0']='课程号';
        $evaarray['0']['1']='课程名';
        $evaarray['0']['2']='教师名';
        $evaarray['0']['3']='学年学期';
        $evaarray['0']['4']='教师号';
        $evaarray['0']['5']='评估次数';
        $evaarray['0']['6']='操作';
        $count=0;
        foreach ($aaData as $item){
            $evaarray[$count]=array();
            $evaarray[$count]['0']=$item->kch;
            $evaarray[$count]['1']=$item->kcm;
            $evaarray[$count]['2']=$item->jsm;

            //附属信息
            $evaarray[$count]['3']=$item->xnxq;
            $evaarray[$count]['4']=$item->jsh;
            //附属信息
            $evaarray[$count]['5']=$item->pgcs;
            $count++;
        }


        $option=['option'=>$evaarray,'where'=>1];
        return view('evaluate')->with($option);
    }
    public function jump(Request $request){
        $option=['where'=>2,'xnxq'=>$request["xnxq"],'kch'=>$request["kch"],'jsh'=>$request["jsh"]];
        return view('evaluate')->with($option);
        
    }
    public function yijian(Request $request){
        $client=baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));

        if(!$client) return null;
        //并不知道是个啥

        //并不知道是个啥
        $nf=substr($request["xnxq"],strlen($request["xnxq"])-1,1);
        if($nf==1)
            $nf1=substr($request["xnxq"],0,4);
        else
            $nf1=substr($request["xnxq"],5,4);
        $result = $client->request('post', '/b/pg/xs/add',['form_params' => [
            'xnxq' => $request["xnxq"],'kch'=>$request["kch"],'jsh'=>$request["jsh"],
            'wjid'=>'1',
            'wjmc'=>'山东大学课堂教学评价('.$nf1.')',
            'zbid'=>'36',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_0'=>'5.0',
            'zbid'=>'37',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_1'=>'5.0',
            'zbid'=>'38',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_2'=>'5.0',
            'zbid'=>'39',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_3'=>'5.0',
            'zbid'=>'40',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_4'=>'5.0',
            'zbid'=>'41',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_5'=>'5.0',
            'zbid'=>'42',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_6'=>'5.0',
            'zbid'=>'43',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_7'=>'5.0',
            'zbid'=>'44',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_8'=>'5.0',
            'zbid'=>'45',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_9'=>'5.0',
            'zbid'=>'46',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_10'=>'5.0',
            'zbid'=>'47',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_11'=>'5.0',
            'zbid'=>'48',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_12'=>'5.0',
            'zbid'=>'49',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_13'=>'5.0',
            'zbid'=>'50',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_14'=>'5.0',
            'zbid'=>'52',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_15'=>'5.0',
            'zbid'=>'53',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_16'=>'5.0',
            'zbid'=>'54',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_17'=>'5.0',
            'zbid'=>'55',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_18'=>'10.0',
            'zbid'=>'51',
            'zblx'=>'主观选择',
            'sfbt'=>'',
            'zbda_19'=>'课程难度适中',
            'zbid'=>'56',
            'zblx'=>'主观选择',
            'sfbt'=>'',
            'zbda_20'=>'推荐',
            'zbid'=>'57',
            'zblx'=>'主观',
            'sfbt'=>'是',
            'zbda_21'=>'好'
        ]], ['allow_redirects' => true]);
        return redirect('/evaluate');
    }
    public function tijiao(Request $request){
        $client=baseapi::ConnectToBkjs(Auth::user()["j_username"], base64_decode(Auth::user()["j_password"]));

        if(!$client) return null;
        //并不知道是个啥

        //并不知道是个啥
        $nf=substr($request["xnxq"],strlen($request["xnxq"])-1,1);
        if($nf==1)
            $nf1=substr($request["xnxq"],0,4);
        else
            $nf1=substr($request["xnxq"],5,4);
        $result = $client->request('post', '/b/pg/xs/add',['form_params' => [
            'xnxq' => $request["xnxq"],'kch'=>$request["kch"],'jsh'=>$request["jsh"],
            'wjid'=>'1',
            'wjmc'=>'山东大学课堂教学评价('.$nf1.')',
            'zbid'=>'36',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_0'=>$request["zbda_0"],
            'zbid'=>'37',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_1'=>$request["zbda_1"],
            'zbid'=>'38',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_2'=>$request["zbda_2"],
            'zbid'=>'39',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_3'=>$request["zbda_3"],
            'zbid'=>'40',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_4'=>$request["zbda_4"],
            'zbid'=>'41',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_5'=>$request["zbda_5"],
            'zbid'=>'42',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_6'=>$request["zbda_6"],
            'zbid'=>'43',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_7'=>$request["zbda_7"],
            'zbid'=>'44',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_8'=>$request["zbda_8"],
            'zbid'=>'45',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_9'=>$request["zbda_9"],
            'zbid'=>'46',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_10'=>$request["zbda_10"],
            'zbid'=>'47',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_11'=>$request["zbda_11"],
            'zbid'=>'48',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_12'=>$request["zbda_12"],
            'zbid'=>'49',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_13'=>$request["zbda_13"],
            'zbid'=>'50',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_14'=>$request["zbda_14"],
            'zbid'=>'52',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_15'=>$request["zbda_15"],
            'zbid'=>'53',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_16'=>$request["zbda_16"],
            'zbid'=>'54',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_17'=>$request["zbda_17"],
            'zbid'=>'55',
            'zblx'=>'选择',
            'sfbt'=>'',
            'zbda_18'=>$request["zbda_18"],
            'zbid'=>'51',
            'zblx'=>'主观选择',
            'sfbt'=>'',
            'zbda_19'=>$request["zbda_19"],
            'zbid'=>'56',
            'zblx'=>'主观选择',
            'sfbt'=>'',
            'zbda_20'=>$request["zbda_20"],
            'zbid'=>'57',
            'zblx'=>'主观',
            'sfbt'=>'是',
            'zbda_21'=>$request["zbda_21"]
        ]], ['allow_redirects' => false]);
        return redirect('/evaluate');
    }

}
