<?php

namespace PHenry\App;

use PHenry\App\Kernel\Http\NotFoundException;
use PHenry\App\Kernel\Http\Router;

try {
    Router::get('/', function () {
        return require __DIR__ . '/pages/homepage.page.php';
    });

    Router::get('/contact', function () {
        require __DIR__ . '/pages/contact.page.php';
    });

    Router::get('/product', function () {
        require __DIR__ . '/pages/product.page.php';
    });

    Router::run();
} catch (NotFoundException $e) {
    header('HTTP/1.1 404 Not Found');
    require __DIR__ . '/pages/404.page.php';
    exit;
}
