<?php

return [
    'media'    => [
        'index' => 'pressroom/{year?}',
        'view'  => 'pressroom/press/{mediapressMedia}'
    ],
    'category' => [
        'slug'  => 'pressroom/category/{mediapressCategory}',
        'year'  => 'pressroom/{mediapressCategory}/{year}'
    ]
];
