<?php

return [
    'media'    => [
        'index' => 'pressroom/{year?}',
        'view'  => 'pressroom/press/{mediapressMedia}'
    ],
    'brand'    => [
        'slug' => 'pressroom/broadcaster/{mediapressBrandSlug}'
    ],
    'category' => [
        'slug'  => 'pressroom/category/{mediapressCategory}',
        'year'  => 'pressroom/{mediapressCategory}/{year}'
    ]
];
