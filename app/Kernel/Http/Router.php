<?php
/**
 * (c) Pierre-Henry Soria <hi@ph7.me>
 * MIT License - https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace PHenry\App\Kernel\Http;

use Closure;
use PH7\JustHttp\StatusCode;
use ReflectionException;
use ReflectionFunction;

class Router
{
    private static array $routers = [];
    private static null|string $methodNotAllowed = null;
    private static bool $pathMatchFound = false;

    public static function get(string $expression, Closure $function): void
    {
        self::add($expression, $function, Http::GET_METHOD);
    }

    public static function delete(string $expression, Closure $function): void
    {
        self::add($expression, $function, Http::DELETE_METHOD);
    }

    public static function put(string $expression, Closure $function): void
    {
        self::add($expression, $function, Http::PUT_METHOD);
    }

    public static function post(string $expression, Closure $function): void
    {
        self::add($expression, $function, Http::POST_METHOD);
    }

    public static function run(): void
    {
        $requestUri = self::cleanupUri($_SERVER['REQUEST_URI']);
        $parsedUrl = parse_url($requestUri);

        foreach (self::$routers as $route) {
            if (preg_match('#^' . $route['expression'] . '$#iu', $parsedUrl['path'] ?? '', $matches)) {
                self::$pathMatchFound = true;

                if (self::doesHttpMethodMatch($route['method'])) {
                    array_shift($matches);

                    try {
                        $function = new ReflectionFunction($route['function']);
                        $function->invokeArgs($matches);
                    } catch (ReflectionException $except) {
                        throw new NotFoundException('Not Found', StatusCode::NOT_FOUND);
                    }

                    break;
                }
            }
        }

        if (!self::$pathMatchFound) {
            throw new NotFoundException('Not Found', StatusCode::NOT_FOUND);
        }
    }

    private static function add(string $expression, Closure $function, string $method): void
    {
        self::$routers[] = [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ];
    }

    private static function cleanupUri(string $uri): string
    {
        return str_replace('//', '/', $uri);
    }

    private static function doesHttpMethodMatch(string $httpMethod): bool
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === strtolower($httpMethod);
    }
}
