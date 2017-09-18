<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\repair;
use Illuminate\Support\Facades\Auth;

class repaireController extends Controller
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

            $content->header('维修申请');
            $content->description();

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

            $content->header('header');
            $content->description('description');

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
     * Make a grid builder.   显示列表
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(repair::class, function (Grid $grid) {

            $grid->re_id('编号');
            $grid->column('地点')->display(function () {
                return $this->re_xq . ' ' . $this->re_lfh . ' ' . $this->re_mph;
            });
            $grid->column('学生信息')->display(function () {
                return $this->re_name . ' ' . $this->re_xh;
            });
            $grid->re_phone('联系方式');
            $grid->re_date('报修时间');
            $grid->re_remarks('问题描述');
            $grid->re_feedback('申请者评价');


            $grid->model()->where('re_xq', '=', Admin::user()->place);

//            是否已经处理
            $states = [
                'on' => ['value' => '已处理', 'text' => '已处理', 'color' => 'success'],
                'off' => ['value' => '待处理', 'text' => '待处理', 'color' => 'danger'],
            ];
            $grid->re_state('状态')->switch($states);
//            $grid->column('profile.homepage', '图片')->images()；


//            $grid->avater();
//
////            "['foo.jpg', 'bar.png']"
//
//// 链式方法调用来显示多图
//            $grid->avater()->display(function ($images) {
//
//                return json_decode($images, true);
//
//            })->map(function ($path) {
//
//                return 'https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiQ74qrna7WAhXMzVQKHd-wC9sQjRwIBw&url=http%3A%2F%2Fwww.tooopen.com%2Fimg%2F87_311.aspx&psig=AFQjCNGo2OxRZzK2AAuU_4WBg4d9ki6zOQ&ust=1505806729813779';
//
//            })->image();


//          禁用创建菜单
            $grid->disableCreation();
            $grid->filter(function ($filter) {

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                $filter->equal('re_state')->select(['已处理' => '已处理', '未处理' => '未处理']);
            });
            $grid->actions(function ($actions) {
                $actions->disableDelete();
//                $actions->disableEdit();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(YourModel::class, function (Form $form) {

            $form->display('id', 'ID');


            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
