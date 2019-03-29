<?php

namespace App\Middlewares;

use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;
use Framework\GetField;
use Framework\Tokenable;

class CsrfMiddleware
{
    use Tokenable, Flashable, GetField;

    /**
     * @param ServerRequestInterface $request
     * @param Response $response
     * @param Container $container
     * @param $next
     *
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, Response $response, Container $container, $next)
    {
        $csrf = $this->generateToken();

        if (in_array($request->getMethod(), ['POST' , 'PUT', 'DELETE', 'PATCH'])) {
            $checked = !empty($_SESSION['__csrf']) && !empty($this->getField('__csrf')) &&
                ($_SESSION['__csrf'] === $this->getField('__csrf'));

            $_SESSION['__csrf'] = $csrf;

            if ($checked) {
                return $next($request, $response);
            }

            $this->setFlash('danger', 'Jeton invalide, merci de rafraichir et de réessayer');
            return new Response(301, [
                'Location' => $request->getUri()->getPath()

            ]);
        }
        $_SESSION['__csrf'] = $csrf;
        return $next($request, $response);
    }
}
