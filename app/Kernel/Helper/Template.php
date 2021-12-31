<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHenry\App\Kernel\Helper;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;

class Template
{
    private const DEFAULT_VARIABLES = [
        'siteName' => SITE_NAME,
        'siteUrl' => SITE_URL,
        'appEmail' => APP_EMAIL
    ];

    public static function render(string $template, array $context = []): string
    {
        $mustacheOptions = [
            'extension' => '.mustache.html' // By default, it's `.mustache`, however we want to use `.mustache.html` extension
        ];

        $mustache = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__, 3) . '/views', $mustacheOptions),
            'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__, 3) . '/views/_shared', $mustacheOptions),
        ]);

        return $mustache->render($template, array_merge($context, self::DEFAULT_VARIABLES));
    }

    /**
     * Private Constructor & Cloning to prevent direct object creation and cloning.
     */
    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
