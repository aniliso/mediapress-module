<?php

return [
    'mediapress.media' => [
        'index' => 'mediapress::media.list resource',
        'create' => 'mediapress::media.create resource',
        'edit' => 'mediapress::media.edit resource',
        'destroy' => 'mediapress::media.destroy resource',
    ],
    'mediapress.categories' => [
        'index' => 'mediapress::categories.list resource',
        'create' => 'mediapress::categories.create resource',
        'edit' => 'mediapress::categories.edit resource',
        'destroy' => 'mediapress::categories.destroy resource',
    ],
    'api.mediapress.media' => [
        'video' => 'mediapress::media.video resource'
    ]
];
