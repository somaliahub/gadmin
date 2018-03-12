<?php

namespace App\Admin\Controllers\Home;

use App\Home\FriendlyLink;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class FriendlyLinkController extends Controller
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

            $content->header('友情链接');
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

            $content->header('友情链接');
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

            $content->header('友情链接');
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
        return Admin::grid(FriendlyLink::class, function (Grid $grid) {
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $grid->id('ID')->sortable();
            $grid->order('排列');
            $grid->name('链接名');
            $grid->url('链接');
            $grid->released('发布')->switch($states);
            $grid->created_at('创建时间');
            $grid->updated_at('修改时间');
            $grid->model()->orderBy('order', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(FriendlyLink::class, function (Form $form) {
            $form->display('id', '序号');
            $form->number('order', '排列')->rules('required');
            $form->text('name', '链接名')->rules('required');
            $form->text('url', '链接')->rules('required');
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $form->switch('released', '发布')->states($states);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
