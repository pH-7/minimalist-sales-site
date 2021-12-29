<?php

use PHenry\App\Kernel\Template;

const PRODUCT_DETAILS = [
    'productImage' => 'https://source.unsplash.com/250x250/?coffee,cup',
    'productName' => 'Red Cup ☕',
    'productDescription' => '️A perfect red cup (without coffee).',
    'productPrice' => '$5',
    'purchaseUrl' => 'https://www.buymeacoffee.com/pierrehenry',
];

echo Template::render('product/index', PRODUCT_DETAILS);
