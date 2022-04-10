<?php

use PHenry\App\Kernel\Helper\Template;

Template::output('homepage/index', 'Welcome', [
        'products' => include dirname(__DIR__) . '/products.php'
    ]
);
