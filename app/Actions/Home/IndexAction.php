<?php

namespace  App\Actions\Home;

use App\Service\ObjectifService;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Render\RenderInterface;

class IndexAction
{
    /**
     * @var
     */
    private $objectif;

    /**
     * IndexAction constructor.
     *
     * @param ObjectifService $objectif
     */
    public function __construct(ObjectifService $objectif)
    {
        $this->objectif = $objectif;
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
        $objectif = $this->objectif->allObjectif();
        $view = $container->get(RenderInterface::class)->render('Home/home', ['objectif' => $objectif]);
        $response->getBody()->write($view);
        return $response;
    }
}
