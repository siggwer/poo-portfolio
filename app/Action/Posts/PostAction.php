<?php

namespace  App\Actions\Posts;


use App\Services\CommentServices;
use App\Services\PostServices;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Romss\Render\RenderInterface;


class PostAction
{
    /**
     * @var PostServices $postServices
     */
    private $postServices;
    /**
     * @var CommentServices
     */
    private $commentServices;

    public function __construct(PostServices $postServices, CommentServices $commentServices)
    {
        $this->postServices = $postServices;
        $this->commentServices = $commentServices;
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
            $comments = $this->commentServices->getCommentId($request->getAttribute('post', 0), true);
            $post = $this->postServices->getPostWithId($request->getAttribute('post', 0));
            $view = $container->get(RenderInterface::class)->render('Article/postdetails', ['post' => $post, 'comments' => $comments]);
            $response->getBody()->write($view);
            return $response;
    }
}
