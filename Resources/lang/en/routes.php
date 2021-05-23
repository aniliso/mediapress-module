<?php

return [
    'media'    => [
        'index' => 'pressroom',
        'year'  => 'pressroom/{year?}',
        'type'  => 'pressroom/{year}/{mediaType}',
        'view'  => 'pressroom/post/{mediapressMedia}'
    ],
    'category' => [
        'slug' => 'pressroom/category/{mediapressCategory}',
        'year' => 'pressroom/category/{mediapressCategory}/{year}',
        'type' => 'pressroom/category/{mediapressCategory}/{year}/{type}'
    ],
    'brand'    => [
        'slug' => 'pressroom/author/{mediapressBrandSlug}'
    ],
];
