<?php

namespace App\Admin\Controllers;

use App\chatter;
use App\Http\Controllers\Controller;
use App\repair;
use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('控制面板');
            $content->description('');
            /**最上方的4行*/
            $content->row(function ($row) {
//                __construct($name, $icon, $color, $link, $info)
                $row->column(4, new InfoBox('用户总数', 'users', 'aqua', '', User::getusers_num()));
                $row->column(4, new InfoBox('论坛话题总数', 'book', 'green', '', chatter::getdiscussion_num()));
                $row->column(4, new InfoBox('报修的申请数量', 'fix', 'yellow', '', repair::getsum()));
//                $row->column(3, new InfoBox('总访问量', 'file', 'red', '', '800'));
            });

            //话题讨论
            $content->row(function (Row $row) {
                /**展示讨论最多的话题*/
                $row->column(12, function (Column $column) {
                    $tab = new Tab();
                    $pie = new Pie(chatter::getchatter_bili());
                    $tab->add('讨论最多的话题', $pie);
                    $column->append($tab);
                });

            });

            $content->row(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $polarArea = new PolarArea(chatter::getchategories_bili());
                    $column->append((new Box('话题类别热度', $polarArea))->removable()->collapsable());
                });
            });

            $content->row(function (Row $row) {

                $row->column(12, function (Column $column) {
                    $tab = new Tab();
                    $pie = new Doughnut(repair::getrekind());
                    $tab->add('楼房请求数量', $pie);
                    $column->append($tab);
                });

            });
            $content->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $polarArea_1 = new PolarArea(repair::getstate('中心校区'));
                    $column->append((new Box('中心校区维修评价比', $polarArea_1))->removable()->collapsable());
                });
                $row->column(4, function (Column $column) {
                    $polarArea = new PolarArea(repair::getstate('洪家楼校区'));
                    $column->append((new Box('洪家楼校区维修评价比', $polarArea))->removable()->collapsable());
                });
                $row->column(4, function (Column $column) {
                    $polarArea = new PolarArea(repair::getstate('千佛山校区'));
                    $column->append((new Box('千佛山校区维修评价比', $polarArea))->removable()->collapsable());
                });
            });
            $content->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $polarArea = new PolarArea(repair::getstate('兴隆山校区'));
                    $column->append((new Box('兴隆山校区维修评价比', $polarArea))->removable()->collapsable());
                });
                $row->column(4, function (Column $column) {
                    $polarArea = new PolarArea(repair::getstate('兴隆山校区'));
                    $column->append((new Box('趵突泉校区维修评价比', $polarArea))->removable()->collapsable());
                });
                $row->column(4, function (Column $column) {
                    $polarArea = new PolarArea(repair::getstate('软件园校区'));
                    $column->append((new Box('软件园校区维修评价比', $polarArea))->removable()->collapsable());
                });
            });


        });
    }
}
