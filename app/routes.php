<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

namespace PHenry\App;

use PHenry\App\Kernel\Http\Router;

Router::get('/', function () {
    return require __DIR__ . '/pages/homepage.page.php';
});

Router::get('/contact', function () {
    return require __DIR__ . '/pages/contact.page.php';
});

Router::get('/product', function () {
    return require __DIR__ . '/pages/product.page.php';
});

Router::run();
