<?php

use PHenry\App\Kernel\Template;

echo Template::render('homepage/index', [
        'products' => [
            'isVisible' => true,
            'productName' => 'Red Cup ☕',
            'productUrl' => '/product',
            'productImage' => 'https://source.unsplash.com/250x250/?coffee,cup',
        ]
    ]
);
