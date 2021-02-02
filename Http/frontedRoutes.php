<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => ''], function (Router $router) {
    $router->bind('mediapressMedia', function ($slug) {
        return app('Modules\Mediapress\Repositories\MediaRepository')->findBySlug($slug);
    });
    $router->get(LaravelLocalization::transRoute('mediapress::routes.media.index'), [
        'as'   => 'mediapress.media.index',
        'uses' => 'PublicController@index'
    ]);
    $router->get(LaravelLocalization::transRoute('mediapress::routes.media.view'), [
        'as'   => 'mediapress.media.view',
        'uses' => 'PublicController@view'
    ]);
    $router->bind('mediapressCategory', function ($slug) {
        return app('Modules\Mediapress\Repositories\CategoryRepository')->findBySlug($slug);
    });
    $router->get(LaravelLocalization::transRoute('mediapress::routes.category.slug'), [
        'as'   => 'mediapress.category.slug',
        'uses' => 'PublicController@category'
    ]);
    $router->get(LaravelLocalization::transRoute('mediapress::routes.category.year'), [
        'as'   => 'mediapress.category.year',
        'uses' => 'PublicController@year'
    ]);
});
