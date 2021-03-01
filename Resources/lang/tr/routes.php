<?php

return [
    'media'    => [
        'index' => 'basinda-biz/{year?}',
        'view'  => 'basinda-biz/basin/{mediapressMedia}'
    ],
    'category' => [
        'slug' => 'basinda-biz/kategori/{mediapressCategory}',
        'year' => 'basinda-biz/{mediapressCategory}/{year}'
    ],
    'brand'    => [
        'slug' => 'basinda-biz/yayinci/{mediapressBrandSlug}'
    ],
];
