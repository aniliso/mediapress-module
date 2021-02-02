<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/mediapress'], function (Router $router) {
    $router->bind('mediaPress', function ($id) {
        return app('Modules\Mediapress\Repositories\MediaRepository')->find($id);
    });
    $router->get('media', [
        'as' => 'admin.mediapress.media.index',
        'uses' => 'MediaController@index',
        'middleware' => 'can:mediapress.media.index'
    ]);
    $router->get('media/create', [
        'as' => 'admin.mediapress.media.create',
        'uses' => 'MediaController@create',
        'middleware' => 'can:mediapress.media.create'
    ]);
    $router->post('media', [
        'as' => 'admin.mediapress.media.store',
        'uses' => 'MediaController@store',
        'middleware' => 'can:mediapress.media.create'
    ]);
    $router->get('media/{mediaPress}/edit', [
        'as' => 'admin.mediapress.media.edit',
        'uses' => 'MediaController@edit',
        'middleware' => 'can:mediapress.media.edit'
    ]);
    $router->put('media/{mediaPress}', [
        'as' => 'admin.mediapress.media.update',
        'uses' => 'MediaController@update',
        'middleware' => 'can:mediapress.media.edit'
    ]);
    $router->delete('media/{mediaPress}', [
        'as' => 'admin.mediapress.media.destroy',
        'uses' => 'MediaController@destroy',
        'middleware' => 'can:mediapress.media.destroy'
    ]);

    $router->bind('mediapressCategory', function ($id) {
        return app('Modules\Mediapress\Repositories\CategoryRepository')->find($id);
    });
    $router->get('categories', [
        'as' => 'admin.mediapress.category.index',
        'uses' => 'CategoryController@index',
        'middleware' => 'can:mediapress.categories.index'
    ]);
    $router->get('categories/create', [
        'as' => 'admin.mediapress.category.create',
        'uses' => 'CategoryController@create',
        'middleware' => 'can:mediapress.categories.create'
    ]);
    $router->post('categories', [
        'as' => 'admin.mediapress.category.store',
        'uses' => 'CategoryController@store',
        'middleware' => 'can:mediapress.categories.create'
    ]);
    $router->get('categories/{mediapressCategory}/edit', [
        'as' => 'admin.mediapress.category.edit',
        'uses' => 'CategoryController@edit',
        'middleware' => 'can:mediapress.categories.edit'
    ]);
    $router->put('categories/{mediapressCategory}', [
        'as' => 'admin.mediapress.category.update',
        'uses' => 'CategoryController@update',
        'middleware' => 'can:mediapress.categories.edit'
    ]);
    $router->delete('categories/{mediapressCategory}', [
        'as' => 'admin.mediapress.category.destroy',
        'uses' => 'CategoryController@destroy',
        'middleware' => 'can:mediapress.categories.destroy'
    ]);

// append

});
