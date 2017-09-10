<?php

namespace Core;

use Closure;
use Core\Router\Request;
use Core\Router\Response;
use Core\Router\Router;
use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Exceptions\NotFoundException;

/**
 * Class Application
 * @package Core
 */
class Application
{
    /**
     * @var Router
     */
    private $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * @param Closure $callback
     */
    public function registerRoutes(Closure $callback)
    {
        call_user_func($callback, $this->router);
    }

    /**
     * @return mixed|void
     */
    public function start()
    {
        try {
            return $this->loadEloquent()->routerProcessor();
        } catch (\Exception $e) {
            return Response::error(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @return $this
     */
    private function loadEloquent()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => getenv('DB_DRIVER'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $this;
    }


    private function routerProcessor()
    {
        if ($route = $this->router->getRoute(Request::server('REQUEST_URI'))) {
            $controllerNamespace = sprintf('App\\Controller\\%s', $route['controller']);

            if ($route['method'] !== Request::method()) {
                throw new \RuntimeException("Unsupportable method");
            }

            if (!class_exists($controllerNamespace)) {
                throw new \RuntimeException("Controller {$controllerNamespace} doesn't exist");
            }

            $controller = new $controllerNamespace;
            $method     = $route['action'];

            if (!method_exists($controller, $method)) {
                throw new \RuntimeException("Method {$method} of {$controllerNamespace} doesn't exist");
            }

            return call_user_func_array([$controller, $method], $route['matches']);
        }

        throw new NotFoundException('Route not found');
    }
}