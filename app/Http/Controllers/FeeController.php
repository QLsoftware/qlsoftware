<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * 实现费用的查询
 *
 */
class FeeController extends Controller
{
    /**
     * Create a new controller instance.
     *路由中间件，请复制该构造方法
     * 实现用户认证
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

//   // $SearchOption    0 基本费用界面      1 校园卡费用界面      2 寝室费用界面      3 寝室费用_水费        4 寝室费用_网费
    public function fee()
    {   $SearchOption=['SearchOption' => 0];
        return view("fee")->with($SearchOption);;
    }

    public function fee_card()
    {   $SearchOption=['SearchOption' => 1];
        return view("fee")->with($SearchOption);;
    }

    public function fee_room()
    {   $SearchOption=['SearchOption' => 2];
        return view("fee")->with($SearchOption);;
    }

    public function fee_room_water()
    {   $SearchOption=['SearchOption' => 3];
        return view("fee")->with($SearchOption);;
    }

    public function fee_room_net()
    {   $SearchOption=['SearchOption' => 4];
        return view("fee")->with($SearchOption);;
    }

    public function fee_card_pay()
    {   $SearchOption=['SearchOption' => 5];
        return view("fee")->with($SearchOption);;
    }
}
