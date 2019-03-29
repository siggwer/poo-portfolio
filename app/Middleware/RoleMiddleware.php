<?php

namespace  App\Middlewares;

use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;

class RoleMiddleware
{
    use Flashable;

    public function __invoke(ServerRequestInterface $request, Response $response, Container $container, $next)
    {
        if (!isset($_SESSION['auth']) || $_SESSION['auth']->getRank() <=1) {
            $this->setFlash("danger", "Vous devez être admin pour entrer");
            return new Response(301, [
                'Location' => '/'
            ]);
        }
             return $next($request, $response);
    }
}
