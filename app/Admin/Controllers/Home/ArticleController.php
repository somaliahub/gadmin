<?php

namespace App\Admin\Controllers\Home;

use App\Home\Article;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
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

            $content->header('文章');
            $content->description('description');

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

            $content->header('文章');
            $content->description('列表');

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

            $content->header('文章');
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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('序号')->sortable();
            $grid->title('标题');
            $grid->desc('描述')->display(function ($grid) {
                return str_limit($grid, 30, '...');
            });
            $states = [
                'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
            ];
            $grid->released('发布')->switch($states);
            $grid->author('作者');
            $grid->created_at('创建时间')->sortable();
            $grid->updated_at('更新时间')->sortable();
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
        return Admin::form(Article::class, function (Form $form) {
            $form->display('id', '序号');
            $form->text('title', '标题')->rules('required');
            $form->text('desc', '描述')->rules('required');
            $form->image('cover', '封面')->uniqueName()->move('images');
            $form->editor('x_content', '内容');
            $form->text('author', '作者')->rules('required');
            $form->multipleSelect('tag', '标签')->options(['1' => '广东', '2' => '福建', '3' => '北京']);
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
