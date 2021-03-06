<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

    Route::group([
        'prefix'        => config('admin.route.prefix'),
        'namespace'     => config('admin.route.namespace'),
        'middleware'    => config('admin.route.middleware'),
    ], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('article', 'Home\ArticleController' );
    $router->resource('goods', 'Home\GoodsController' );
    $router->resource('website', 'Home\WebsiteController' );
    $router->resource('simplenotice', 'Home\SimpleNoticeController' );
    $router->resource('friendlylink', 'Home\FriendlyLinkController' );
});
