<?php

use PHenry\App\Kernel\Helper\Template;

echo Template::render('homepage/index', [
        'products' => include dirname(__DIR__) . '/products.php'
    ]
);
