<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' =>''], function (Router $router) {
    $router->get(LaravelLocalization::transRoute('mediapress::routes.media.index'), [
        'as'         => 'mediapress.media.index',
        'uses'       => 'PublicController@index'
    ]);
    $router->get(LaravelLocalization::transRoute('mediapress::routes.media.category'), [
        'as'         => 'mediapress.media.category',
        'uses'       => 'PublicController@index'
    ]);
    $router->get(LaravelLocalization::transRoute('mediapress::routes.media.view'), [
        'as'         => 'mediapress.media.view',
        'uses'       => 'PublicController@view'
    ]);
});
