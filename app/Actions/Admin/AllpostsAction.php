<?php

namespace App\Actions\Admin;

use App\Services\PostServices;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Render\RenderInterface;

class AllpostsAction
{
    private $postServices;

    public function  __construct(PostServices $postServices)
    {
        $this->postServices = $postServices;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Container $container
     * @return int|ResponseInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        $posts = $this->postServices->allpost();
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/shows', ['posts' => $posts]);
            $response->getBody()->write($view);
        }
        return $response;
    }
}

