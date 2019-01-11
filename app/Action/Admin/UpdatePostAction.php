<?php

namespace App\Actions\Admin;

use App\Services\PostServices;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;
use Framework\GetField;
use Framework\Render\RenderInterface;


class UpdatePostAction
{
    use Flashable, GetField;
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

        if ($post === false) {
            $this->setFlash("danger", "Article inconnu");
            return new Response(301, [
                'Location' => '/panel/posts'
            ]);
        }

        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/update', ['post' => $post]);
            $response->getBody()->write($view);

            return $response;
        }


        $title = $this->getField('title');
        $chapo = $this->getField('chapo');
        $content = $this->getField('content');
        $author = $this->getField('author');

        $path = '/panel/edit/post/'.$post['id'];

        $titleLength = strlen($title);
        if ( $titleLength < 10 ) {
            $this->setFlash("danger", "Votre titre doit contenir au moins 10 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $chapoLength = strlen($chapo);
        if ($chapoLength < 50 ) {
            $this->setFlash("danger", "Le chapoô doit contenir au moins 50 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $contentLength = strlen($content);
        if ($contentLength < 50) {
            $this->setFlash("danger", "Votre message doit contenir au minimum 50 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $authorLength = strlen($author);
        if ($authorLength < 4) {
            $this->setFlash("danger", "Auteur doit contenir au minimum 4 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => $path
            ]);
        }


        $imgName = $post['img'] ;

        if ($request->getMethod() === $_FILES ?? null){
            $imgLastName = $imgName;
            $img = $this->getFiles('img') ?? null;
            $ext = strtolower(substr($img['name'], strrpos($img['name'], '.') + 1));
            $extAllow = ['jpg','jpeg', 'gif', 'png'];
            if (in_array($ext, $extAllow)){
                $imgName = time().'_'.$post['id'].'.'.$ext;
                $pathImage = realpath(__DIR__ . '/../../../public/upload').'/';
                if (file_exists($pathImage.$imgLastName)) {
                    unlink($pathImage.$imgLastName);
                }

                move_uploaded_file($img['tmp_name'], $pathImage.$imgName);
            }else {
                $this->setFlash('warning', 'votre fichier doit être au format .jpg, .png, .gif');
                return new Response(301, [
                    'Location' => $path
                ]);
            }
        }

        $updatePost = $this->postServices->updatePost([
            'id' =>$post['id'],
            'img' => $imgName,
            'title' => $title,
            'chapo' => $chapo,
            'content' => $content,
            'author' => $author
            ]);

        if ($updatePost){
            $this->setFlash('success','Votre article a bien été modifié');
        }else{
            $this->setFlash('warning','Un problème est survenue');
        }
        return new Response(301, [
            'Location' => '/panel'
        ]);
    }
}
