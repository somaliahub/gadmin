<?php

namespace App\Admin\Controllers\Home;

use App\Home\SimpleNotice;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class SimpleNoticeController extends Controller
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

            $content->header('公告');
            $content->description('列表');

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

            $content->header('公告');
            $content->description('编辑');

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

            $content->header('公告');
            $content->description('新增');

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
        return Admin::grid(SimpleNotice::class, function (Grid $grid) {
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $grid->id('序号')->sortable();
            $grid->title('标题');
            $grid->content('内容');
            $grid->type('类型');
            $grid->released('发布')->switch($states);
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
            $grid->filter(function($filter){
                $filter->like('title','标题');
                $filter->date('released','发布时间');
                $filter->date('create_at','创建时间');
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
        return Admin::form(SimpleNotice::class, function (Form $form) {

            $form->display('id', '序号');
            $form->text('title', '标题')->rules('required');
            $form->text('content', '内容')->rules('required');
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $form->switch('released', '发布')->states($states);
            $form->multipleSelect('type', '类型')->options($this->getSimpleNoticeType());
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
