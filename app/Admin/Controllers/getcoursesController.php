<?php

namespace App\Admin\Controllers;

use App\zjtcourses;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class getcoursesController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('抢课任务');
            $content->description('状态编码:4==等待系统开放 0 == 正在抢课    1 == 抢课成功   -1 == 暂停   -2 == 出现异常');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('抢课列表');
            $content->description('任务清单');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(zjtcourses::class, function (Grid $grid) {

            $grid->index('编号')->sortable();
            $grid->column('id','账号编号');
            $grid->kch('课程号');
            $grid->kxh('课序号');
            $grid->name('课程名称');
            //status  4==等待系统开放 0 == 正在抢课    1 == 抢课成功   -1 == 暂停   -2 == 出现异常
            $grid->column('状态')->display(function (){
               switch ($this->status)
               {
                   case 4:
                       return '等待系统开放';
                   case 0:
                       return '正在抢课';
                   case 1:
                       return '抢课成功';
                   case -1:
                       return '暂停';
                   case -2:
                       return '出现异常';
               }
            });
            $grid->times('尝试次数');
            $grid->info('备注');
            $grid->filter(function($filter){
                $filter->is('id ','账号编号');
                $filter->is('status ','状态编号');
            });
//            $grid->created_at('创建日期');
//            $grid->updated_at('最近执行时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(zjtcourses::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
