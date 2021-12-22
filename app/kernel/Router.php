<?php

class Router
{
    private static array $routers = [];
    private static null|string $methodNotAllowed = null;
    private static bool $pathMatchFound;
    private static bool $routeMatchFound;

    public static function add($expression, $function, $method = 'get')
    {
        array_push(self::$routers, [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ]);
    }

    public static function getAll()
    {
        return self::$routers;
    }

    public static function methodNotAllowed($function)
    {
        self::$methodNotAllowed = $function;
    }

    public static function run(string $basePath = '')
    {
        $basePath = rtrim($basePath, '/');

        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = '/';

        if (isset($parsedUrl['path'])) {
            if ($basePath . '/' !== $parsedUrl['path']) {
                $path = rtrim($parsedUrl['path'], '/');
            } else {
                $path = $parsedUrl['path'];
            }
        }

        $path = urlencode($path);

        $method = $_SERVER['REQUEST_METHOD'];

        self::$pathMatchFound = false;
        self::$routeMatchFound = false;

        foreach (self::$routers as $route) {
            if ($basePath !== '' && $basePath !== '/') {
                $route['expression'] = '(' . $basePath . ')' . $route['expression'];
            }

            $route['expression'] = '^' . $route['expression'] . '$';

            if (preg_match(('#' . $route['expression'] . '#u', $path, $matches)) {
                self::$pathMatchFound = true;

                foreach ((array)$route['method'] as $allowedMethod) {
                    if (strtolower($method) === strtolower($allowedMethod)) {
                        array_shift($matches);

                        if ($basePath !== '' && $basePath !== '/') {
                            array_shift($matches);
                        }

                        if ($res = call_user_func_array($route['function'], $matches)) {
                            echo $res;
                        }

                        self::$routeMatchFound = true;

                        break;
                    }
                }
            }

            if (!self::$routeMatchFound) {
                if (self::$pathMatchFound) {
                    if (self::$methodNotAllowed) {
                        call_user_func_array(self::$methodNotAllowed, [$path, $method]);
                    }
                } else {
                    if (self::$pathMatchFound) {
                        call_user_func_array(self::$pathMatchFound, [$path]);
                    }
                }
            }
        }
    }
}
