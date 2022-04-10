<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHenry\App\Kernel\Helper;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

final class Template
{
    private const VIEW_EXTENSION = '.mustache.html';

    private const DEFAULT_VARIABLES = [
        'siteName' => SITE_NAME,
        'siteUrl' => SITE_URL,
        'appEmail' => APP_EMAIL
    ];

    public static function render(string $template, string $title = '', array $context = []): string
    {
        $viewPath = dirname(__DIR__, 3) . '/views';
        $partialViewPath = $viewPath . DIRECTORY_SEPARATOR . '_shared';

        $filesystemOptions = [
            // By default, it's `.mustache`, however we want to use `.mustache.html` extension
            'extension' => self::VIEW_EXTENSION
        ];

        $engineOptions = [
            'loader' => new Mustache_Loader_FilesystemLoader($viewPath, $filesystemOptions),
            'partials_loader' => new Mustache_Loader_FilesystemLoader($partialViewPath, $filesystemOptions)
        ];
        $mustache = new Mustache_Engine($engineOptions);

        // Set a title to the page
        $context['pageTitle'] = $title;

        return $mustache->render($template, array_merge($context, self::DEFAULT_VARIABLES));
    }

    public static function output(string $template, string $title, array $context = []): void
    {
        echo self::render($template, $title, $context);
    }

    /**
     * Private constructor to prevent direct object creation.
     */
    private function __construct()
    {
    }

    /**
     * Private cloning to prevent direct object cloning.
     */
    private function __clone()
    {
    }
}
