<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' =>'mediapress'], function (Router $router) {
    $router->get('video', [
        'as'         => 'api.mediapress.media.video',
        'uses'       => 'MediaController@video'
    ])->middleware(['api.token', 'token-can:api.mediapress.media.video']);
});