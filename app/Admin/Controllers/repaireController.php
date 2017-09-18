<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\repair;

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
                return $this->re_name . ' ' . $this->re_xh ;
            });
            $grid->re_phone('联系方式');
            $grid->re_date('报修时间');



//            是否已经处理
            $states = [
                '已处理'  => ['value' => '已处理', 'text' => '已处理', 'color' => 'success'],
                '待处理' => ['value' => '待处理', 'text' => '已处理', 'color' => 'danger'],
            ];
            $grid->status()->switch($states);

//          禁用创建菜单
            $grid->disableCreation();





            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
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
