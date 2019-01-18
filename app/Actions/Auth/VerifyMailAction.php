<?php

namespace App\Actions\Auth;

use App\Services\UserServices;
use DateTime;
use DateTimeZone;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Romss\Flashable;


class VerifyMailAction
{
    use Flashable;
    /**
     * @var UserServices
     */
    private $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Container $container
     * @return Response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        $userId = $request->getAttribute('id');
        $token = $request->getAttribute('token');

        $user = $this->userServices->getUserById($userId);

        if ($user === false || $user->email_token() != $token){
            $this->setFlash("danger", "Votre lien d'activation n'est pas valide");
            return new Response(301, [
                'Location' => '/'
            ]);
        }


        $timezone = new DateTimeZone('Europe/Paris');
        $limit = new DateTime('-10 minute', $timezone);
        $registerAt = $user->register_at();
        if ($limit > $registerAt){
            $this->setFlash("warning", "Votre lien n'est plus valide");
            return new Response(301, [
                'Location' => '/'
            ]);
        }

        $user->setEmail_token(null);
        $this->userServices->updateUser($user);

        $this->setFlash("success", "Votre compte est actif. Vous pouvez vous connecter");
        return new Response(301,[
            'Location' => '/'
        ]);
    }
}
