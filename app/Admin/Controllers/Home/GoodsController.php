<?php

namespace App\Admin\Controllers\Home;

use App\Home\Goods;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GoodsController extends Controller
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

            $content->header('商品');
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

            $content->header('商品');
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

            $content->header('商品');
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
        return Admin::grid(Goods::class, function (Grid $grid) {

            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $grid->id('序号')->sortable();
            $grid->name('名称');
            $grid->price('价格')->sortable();
            $grid->desc('描述')->display(function ($grid) {
                return str_limit($grid, 30, '...');
            });
            $grid->released('发布')->switch($states);
            $grid->recommend('推荐')->switch($states);
            $grid->author('作者');
            $grid->ttm('上市时间')->sortable();
            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('更新时间')->sortable();
            $grid->filter(function ($filter) {
                $filter->like('name', '名称');
                $filter->date('released', '发布时间');
                $filter->date('create_at', '创建时间');
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
        return Admin::form(Goods::class, function (Form $form) {
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $form->display('id', '序号');
            $form->text('name', '名称')->rules('required');
            $form->number('price', '价格')->default(88);
            $form->number('level', '星级')->default(88);
            $form->switch('recommend', '推荐')->states($states);
            $form->switch('released', '发布')->states($states)->default(date(time()));
            $form->datetime('ttm', '上市时间');
            $form->text('url', 'URL')->rules('required');
            $form->text('desc', '描述')->rules('required');
            $form->image('cover', '封面')->uniqueName()->move('images');
            $form->editor('x_content', '内容');
            $form->text('author', '作者')->rules('required')->default('admin');
            $form->multipleSelect('tag', '标签')->options($this->getGoodsTags());
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
