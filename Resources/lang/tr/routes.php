<?php

return [
    'media'    => [
        'index' => 'basinda-biz',
        'year'  => 'basinda-biz/{year?}',
        'type'  => 'basinda-biz/{year}/{mediaType}',
        'view'  => 'basinda-biz/basin/{mediapressMedia}'
    ],
    'category' => [
        'slug' => 'basinda-biz/kategori/{mediapressCategory}',
        'year' => 'basinda-biz/kategori/{mediapressCategory}/{year}',
        'type' => 'basinda-biz/kategori/{mediapressCategory}/{year}/{type}'
    ],
    'brand'    => [
        'slug' => 'basinda-biz/yayinci/{mediapressBrandSlug}'
    ],
];
