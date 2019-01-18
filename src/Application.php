<?php

namespace Framework;


use DI\Container;
use DI\ContainerBuilder;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Render\RenderInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route;

use function QuimCalpe\ResponseSender\send AS send_response;

/**
 * Class Application
 *
 * Gestion de l'application PHP
 *
 * @package Romss
 */
class Application
{
    /**
     * @var Container $container
     */
    private $container;

    /**
     * @var ServerRequestInterface $request
     */
    private $request;

    /**
     * @var ResponseInterface $response
     */
    private $response;

    /**
     * @var array
     */
    private $middlewares;

    /**
     * @var FastRouteRouter $router
     */
    private $router;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->middlewares = [];
    }


    public function init()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAutowiring(true);
        //$containerBuilder->addDefinitions(__DIR__.'/../config/dic/database.php');
        //$containerBuilder->addDefinitions(__DIR__.'/../config/dic/repositories.php');
        $containerBuilder->addDefinitions(__DIR__.'/../config/render.php');
        //$containerBuilder->addDefinitions(__DIR__. '/../config/dic/SwiftMailer.php');
        $this->container = $containerBuilder->build();
        $this->initRouter();
    }

    /**
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function run()
    {
        $this->request = ServerRequest::fromGlobals();
        $this->response = new Response();

        $route = $this->router->match($this->request);
        if ($route->isSuccess()) {
            foreach ($route->getMatchedParams() as $name => $value) {
                $this->request = $this->request->withAttribute($name, $value);
            }

            $middlewares = $this->middlewares[$route->getMatchedRouteName()];
            if ($middlewares === null) {
                $middlewares = [];
            }

            $middlewaresGlobals = (require __DIR__.'/../app/Middleware/GlobalsMiddlewares/Middlewares.php');
            $middlewares = array_merge($middlewaresGlobals, $middlewares);

            $dispatcher = new Dispatcher($this->container, $middlewares);
            $dispatcher->pipe($route->getMatchedMiddleware());
            $result = $dispatcher->process($this->request, $this->response);

            $location = $result->getHeader('Location');
            if (!empty($location)) {
                header("HTTP/{$result->getProtocolVersion()} 301 Moved Permantly", false, 301);
                header('Location: '.$location[0]);
                exit();
            }

            send_response($result);
        } else {
            $rendering = $this->container->get(RenderInterface::class)->render('Errors/404');
            send_response(new Response(404, [], $rendering));
        }
    }

    private function initRouter()
    {
        $this->router = new FastRouteRouter();

        $routes = (require __DIR__.'/../config/Routes.php');
        foreach ($routes as $name => $route) {
            $routeAdd = new Route($route['path'], $route['action'], $route['methods'], $name);
            $this->router->addRoute($routeAdd);

            $this->middlewares[$name] = $route['middlewares'];
        }
    }
}
