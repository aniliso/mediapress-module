<?php

return [
    'mediapress.media' => [
        'index' => 'mediapress::media.list resource',
        'create' => 'mediapress::media.create resource',
        'edit' => 'mediapress::media.edit resource',
        'destroy' => 'mediapress::media.destroy resource',
    ],
    'api.mediapress.media' => [
        'video' => 'mediapress::media.video resource'
    ]
];
