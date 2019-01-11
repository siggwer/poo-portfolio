<?php

namespace App\Actions\Admin;

use App\Services\PostServices;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;
use Framework\Render\RenderInterface;


class DeletePostAction
{
    use Flashable;
    /**
     * @var PostServices $postServices
     */
    private $postServices;


    public function __construct(PostServices $postServices)
    {
        $this->postServices = $postServices;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Container $container
     * @return ResponseInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        $post = $this->postServices->getPostWithId($request->getAttribute('post', 0));
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/delete', ['post' => $post]);
            $response->getBody()->write($view);
            return $response;
        }

        if (isset($post['id'])){
            $this->postServices->deletePost($post['id']);
            $imgName = $post['img'];
                    $pathImage = realpath(__DIR__ . '/../../../public/upload/').'/';
                    if (file_exists($pathImage.$imgName)) {
                        unlink($pathImage.$imgName);
                    }

            $this->setFlash('success','Votre article a bien été supprimé');
        }else{
            $this->setFlash('warning', 'Un problème est survenue');
        }

        return new Response(301, [
            'Location' => '/panel'
        ]);
    }
}
