<?php

namespace Http\routes;

use Http\services\Request;
use Http\services\Response;
use App\factory\DatabaseFactory;
class Router
{
    private static array $routes = [];

    private const CONTROLLER_NAMESPACE = 'App\\controllers';

    public static function load(string $controller, string $method)
    {
        try {
            $controllerNamespace = self::CONTROLLER_NAMESPACE.'\\'.$controller;

            if(!class_exists($controllerNamespace)) {
                throw new \Exception("Controller {$controller} not found", 404);
            }

            $controllerInstance = new $controllerNamespace();

            if(!method_exists($controllerInstance, $method)) {
                throw new \Exception("Method {$method} didn't exist in {$controller}", 404);
            }

            $controllerInstance->$method();


        } catch (\Throwable $th) {
           Response::error($th->getCode() ?: 500, $th->getMessage(), $th->getFile(), $th->getLine());

        }
    }

    public static function get(string $path, string $controller, string $action): void
    {
        self::$routes[$path] = [
          'controller' => $controller,
          'action' => $action,
          'method' => 'get'
        ];
    }

    public static function post(string $path, string $controller, string $action): void
    {
        self::$routes[$path] = [
          'controller' => $controller,
          'action' => $action,
          'method' => 'post'
        ];
    }
    public static function put(string $path, string $controller, string $action): void
    {
        self::$routes[$path] = [
          'controller' => $controller,
          'action' => $action,
          'method' => 'put'
        ];
    }
    public static function delete(string $path, string $controller, string $action): void
    {
        self::$routes[$path] = [
          'controller' => $controller,
          'action' => $action,
          'method' => 'delete'
        ];
    }
    public static function routes(): array
    {
        return self::$routes;
    }

    public static function execute()
    {
        try {
        $routes = self::$routes;
        $requestMethod = Request::getMethod();
        $uri = '/'.ltrim(Request::getPath(), '/API');
        $queryString = Request::getQueryString();

        // Combinar URI e Query String se a rota exigir
        $uriWithQuery = $queryString ? $uri . '?' . $queryString : $uri;

        // Tenta encontrar a rota com e sem a query string
        if (!isset($routes[$uri]) && !isset($routes[$uriWithQuery])) {
            throw new \Exception("Route not found", 404);
        }

        // Verifica qual rota foi encontrada
        $foundRoute = $routes[$uriWithQuery] ?? $routes[$uri];

        if ($foundRoute['method'] !== $requestMethod) {
            throw new \Exception("Sorry, Method Not allowed", 405);
        }
        self::load($foundRoute['controller'], $foundRoute['action']);

    } catch (\Throwable $th) {
        Response::error($th->getCode() ?: 500, $th->getMessage(), $th->getFile(), $th->getLine());
    }    }
}
