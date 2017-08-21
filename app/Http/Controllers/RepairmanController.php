<?php

namespace App\Http\Controllers;

use App\repair;
use Illuminate\Http\Request;

use App\Http\Requests;

class RepairmanController extends Controller
{
    public function index()
    {
        $repairData = repair::paginate(2);
        return view('Repairman',['repairData'=>$repairData]);
    }
    public function updateState($id)
    {
        $re = repair::find($id);
        $re->re_state = "已处理";
        $re ->save();
        return redirect()->back();
    }
    public function detailShow($id)
    {

    }
    public function delete($id)
    {
        repair::destroy($id);
        return redirect()->back();

    }
}
