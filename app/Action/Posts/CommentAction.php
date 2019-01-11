<?php

namespace  App\Actions\Posts;

use App\Services\CommentServices;
use App\Services\PostServices;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Romss\Flashable;
use Romss\GetField;


class CommentAction
{
    use Flashable, GetField;
    /**
     * @var CommentServices
     */
    private $postServices;
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
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        $posts = $this->postServices->getPostWithId($request->getAttribute('post', 0));
        $comments = $this->commentServices->getCommentId($request->getAttribute('post', 0),true);

        $author = $this->getField('author');
        $comment = $this->getField('comment');

            $path =  '/posts/'.$posts['id'];


        $authorLength = strlen($author);
        if ($authorLength < 4 ) {
            $this->setFlash("danger", "Votre nom doit contenir au moins 4 caractères");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $commentLength = strlen($comment);
        if ($commentLength < 3) {
            $this->setFlash("danger", "Votre commentaire doit contenir au minimum 3 caractères");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $addComment = $this->commentServices->insertComment([
            'id' => $comments['id'],
            'post_id' => $posts['id'],
            'author' => $author,
            'comment' => $comment
        ]);

        if ($addComment){
            $this->setFlash('success','Votre commentaire est en cours de modération');
        }else{
        $this->setFlash('warning','Un problème est survenue');
        }
        return new Response(301, [
            'Location' => $path
        ]);

    }
}
