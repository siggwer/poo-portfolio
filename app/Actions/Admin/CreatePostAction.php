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


class CreatePostAction
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
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/create');
            $response->getBody()->write($view);
            return $response;
        }


        $title = $this->getField('title');
        $chapo = $this->getField('chapo');
        $content = $this->getField('content');
        $author = $this->getField('author');


        $path = '/panel/create/post';


        $titleLength = strlen($title);
        if ( $titleLength < 10 ) {
            $this->setFlash("danger", "Votre titre doit contenir au moins 10 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => $path
            ]);
        }

        $chapoLength = strlen($chapo);
        if ($chapoLength < 50 ) {
            $this->setFlash("danger", "Le chapô doit contenir au moins 50 caractères ou ne doit pas être vide");
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

        $createPost = $this->postServices->insertPost([
            'id' =>$post['id'],
            'img' => null,
            'title' => $title,
            'chapo' => $chapo,
            'content' => $content,
            'author' => $author
        ]);

        if ($request->getUploadedFiles()){
            $img = $this->getFiles('img')?? null;
            $ext = strtolower(substr($img['name'], strrpos($img['name'], '.') + 1));
            $extAllow = ['jpg', 'gif', 'png'];
            if (in_array($ext, $extAllow)){
                $imgName = time().'_'.$createPost['id'].'.'.$ext;
                $createPost['img'] = $imgName;
                $pathImage = realpath(__DIR__ . '/../../../public/upload/').'/';
                move_uploaded_file($img['tmp_name'], $pathImage.$imgName);

                $this->postServices->updatePost($createPost);
            }else {
                $this->setFlash('warning', 'votre fichier doit être au format .jpg, .png, .gif');
                return new Response(301, [
                    'Location' => $path
                ]);
            }
        }

        if ($createPost){
            $this->setFlash('success','Votre article a bien été crée');
        }else{
            $this->setFlash('warning', 'Un problème est survenue');
        }
        return new Response(301, [
            'Location' => '/panel'
        ]);
    }
}
