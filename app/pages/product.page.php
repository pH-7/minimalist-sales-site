<?php

use PHenry\App\Kernel\Helper\Template;

const PRODUCT_DETAILS = [
    'productImage' => 'https://source.unsplash.com/250x250/?coffee,cup',
    'productName' => 'Red Cup ☕',
    'productDescription' => '️A perfect red cup (without coffee).',
    'productPrice' => '$5',
    'purchaseUrl' => 'https://www.buymeacoffee.com/pierrehenry',
];

Template::output('product/index', 'Product', PRODUCT_DETAILS);
/* or */
// echo Template::render('product/index', 'Product', PRODUCT_DETAILS);
