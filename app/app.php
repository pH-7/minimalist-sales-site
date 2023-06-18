<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

namespace PHenry\App;

use PHenry\App\Kernel\Http\Exception\HttpException;

try {
    require __DIR__ . '/routes.php';
} catch (HttpException $e) {
    header(sprintf('HTTP/1.1 %s %s', $e->getCode(), $e->getMessage()));
    require __DIR__ . '/pages/404.page.php';
    exit;
}
