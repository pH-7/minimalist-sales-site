<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/pages/homepage.page.php';
        break;

    case '/contact':
        require __DIR__ . '/pages/contact.page.php';
        break;

    default:
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/pages/404.page.php';
        break;
}
