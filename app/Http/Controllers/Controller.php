<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getArticleTags()
    {
        return [
            '1' => '文章1',
            '2' => '文章2',
            '3' => '文章3',
            '4' => '文章4',
        ];
    }

    public function getGoodsTags()
    {
        return [
            '1' => '商品1',
            '2' => '商品2',
            '3' => '商品3',
            '4' => '商品4',
        ];
    }

    public function getSimpleNoticeType()
    {
        return [
            '1' => '上',
            '2' => '中',
            '3' => '中-滚动',
            '4' => '右下',
        ];
    }
}
