<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

namespace PHenry\App;

use HttpException;
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
} catch (HttpException $e) {
    header(sprintf('HTTP/1.1 %s %s', $e->getCode(), $e->getMessage()));
    require __DIR__ . '/pages/404.page.php';
    exit;
}
