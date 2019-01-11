<?php
namespace App\Actions\Admin;

use App\Services\CommentServices;
use App\Services\PostServices;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;
use Framework\GetField;
use Framework\Render\RenderInterface;


class CommentValidatedAction
{
    use Flashable, GetField;
    /**
     * @var CommentServices
     */
    private $commentServices;
    /**
     * @var PostServices
     */
    private $postServices;
    /**
     * CommentValidatedAction constructor.
     * @param CommentServices $commentServices
     * @param PostServices $postServices
     */
    public  function __construct(CommentServices $commentServices, PostServices $postServices)
    {
        $this->commentServices = $commentServices;
        $this->postServices = $postServices;
    }
    /**
     * @param ServerRequestInterface $request
     * @param Response $response
     * @param Container $container
     * @return Response
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __invoke(ServerRequestInterface $request, Response $response, Container $container)
    {
        $postId = $request->getAttribute('post', 0);
        $posts = $this->postServices->getPostWithId($postId);
        $comments = $this->commentServices->getCommentId($postId, false);
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/comments', ['comments' => $comments]);
            $response->getBody()->write($view);
            return $response;
        }
        $commentId = $this->getField('comment_id');
        $comment = $this->commentServices->getComment($commentId);
        if ($comment){
            $comment['validated'] = 1;
            $this->commentServices->updateComment($comment);

            $this->setFlash('success','Votre commentaire a bien été validé');
        }else{
            $this->setFlash('warning', 'Un problème est survenue');
        }

        return new Response(301, [
            'Location' => '/panel/comment/validated/'.$posts['id']
        ]);
    }
}
