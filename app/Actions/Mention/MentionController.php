<?php

namespace App\Actions\Mention;

use DI\Container;
use GuzzleHttp\Psr7\Response;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Render\RenderInterface;

class MentionController
{
    /**
     * @var
     */
    private $mention;

    /**
     * MentionController constructor.
     *
     * @param $mention
     */
    public function __construct()
    {
        $this->mention;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Container $container
     *
     * @return ResponseInterface
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Mention/Mention');
            $response->getBody()->write($view);
        }
        return $response;
    }
}