<?php

use PHenry\App\Kernel\Helper\Template;

echo Template::render('homepage/index', 'Welcome', [
        'products' => include dirname(__DIR__) . '/products.php'
    ]
);
