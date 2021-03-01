<?php

return [
    'mediapress.media' => [
        'index' => 'mediapress::media.list resource',
        'create' => 'mediapress::media.create resource',
        'edit' => 'mediapress::media.edit resource',
        'destroy' => 'mediapress::media.destroy resource',
    ],
    'mediapress.categories' => [
        'index' => 'mediapress::category.list resource',
        'create' => 'mediapress::category.create resource',
        'edit' => 'mediapress::category.edit resource',
        'destroy' => 'mediapress::category.destroy resource',
    ],
    'mediapress.brands' => [
        'index' => 'mediapress::brand.list resource',
        'create' => 'mediapress::brand.create resource',
        'edit' => 'mediapress::brand.edit resource',
        'destroy' => 'mediapress::brand.destroy resource',
    ],
    'api.mediapress.media' => [
        'video' => 'mediapress::media.video resource'
    ]
];
