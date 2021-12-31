<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as WhoopsRun;

$whoops = new WhoopsRun;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

$requiredEnvFields = [
    'SITE_URL',
    'SITE_NAME',
    'APP_EMAIL',
];

$env = Dotenv::createImmutable(__DIR__);
$env->load();
$env->required($requiredEnvFields)->notEmpty();

define('SITE_URL', $_ENV['SITE_URL']);
define('SITE_NAME', $_ENV['SITE_NAME']);
define('APP_EMAIL', $_ENV['APP_EMAIL']);

require __DIR__ . '/app/app.php';
