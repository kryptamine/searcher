<?php

namespace Core\Router;

use RuntimeException;

/**
 * Class Router
 * @package Core\Router
 */
class Router
{
    const AVAILABLE_METHODS = ['get', 'head', 'post', 'put', 'patch'];

    /**
     * @var array
     */
    private $routes;

    /**
     * @param string $name
     * @param array  $arguments
     */
    public function __call(string $name, array $arguments)
    {

        if (!in_array($name, static::AVAILABLE_METHODS)) {
            throw new RuntimeException('Bad route method passed');
        }

        if (count($arguments) !== 2) {
            throw new RuntimeException('Not ');
        }

        list($pattern, $routeEndpoint) = $arguments;

        list($controller, $action) = explode('@', $routeEndpoint);

        $this->routes[] = [
            'pattern'    => $pattern,
            'controller' => $controller,
            'action'     => $action,
            'method'     => $name
        ];
    }

    /**
     * @param string $url
     *
     * @return bool|mixed
     */
    public function getRoute(string $url)
    {
        foreach ($this->routes as $route) {
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['pattern'])) . "$@D";

            if(preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $route['matches'] = $matches;

                return $route;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}