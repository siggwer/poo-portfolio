<?php

namespace App\Actions\Admin;

use App\Services\UserServices;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Flashable;
use Framework\GetField;
use Framework\Render\RenderInterface;

class UsersAdminAction
{
    use GetField, Flashable;
    private $userServices;

    public function  __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
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

        $users = $this->userServices->getRank($rankAdmin = 2);
        if ($request->getMethod() === 'GET') {
            $view = $container->get(RenderInterface::class)->render('Admin/usersAdmin', ['users' => $users]);
            $response->getBody()->write($view);
            return $response;
        }

        $usersId = $this->getField('users_id');
        $users = $this->userServices->getUserById($usersId);

        if ($users) {
            $users['rank'] = 1;
            $this->userServices->updateUser($users);

            $this->setFlash('success', 'L\'utilisateur n\'est plus admin');
        } else {
            $this->setFlash('warning', 'Un problème est survenue');
        }
        return new Response(301, [
            'Location' => '/panel/users/admin'
        ]);
    }
}

