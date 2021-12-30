<?php

use PHenry\App\Kernel\Helper\Template;

const PRODUCTS = [
    [
        'isVisible' => true,
        'productName' => 'Red Cup ☕',
        'productUrl' => '/product',
        'productImage' => 'https://source.unsplash.com/250x250/?coffee,cup',
    ],
    [
        'isVisible' => false,
        'productName' => 'Blue Mug',
        'productUrl' => '/product/mug',
        'productImage' => '/assets/images/blue-mug.png',
    ],
];

echo Template::render('homepage/index', [
        'products' => PRODUCTS
    ]
);
