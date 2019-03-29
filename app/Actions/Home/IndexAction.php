<?php

namespace  App\Actions\Home;

use App\Service\ObjectifService;
use App\Service\FormationService;
use DI\Container;
use GuzzleHttp\Psr7\Response;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Render\RenderInterface;
use Framework\Flashable;
use Framework\GetField;
use Framework\MailHelper;

class IndexAction
{
    use Flashable, GetField;

    /**
     * @var
     */
    private $mailHelper;

    /**
     * @var
     */
    private $objectif;

    /**
     * @var
     */
    private $formation;

    /**
     * IndexAction constructor.
     *
     * @param MailHelper $mailHelper
     * @param ObjectifService $objectif
     * @param FormationService $formation
     */
    public function __construct(MailHelper $mailHelper, ObjectifService $objectif, FormationService $formation)
    {
        $this->mailHelper = $mailHelper;
        $this->objectif = $objectif;
        $this->formation = $formation;
    }


    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param Container $container
     *
     * @return Response|ResponseInterface
     *
     * @throws DependencyException
     * @throws NotFoundException
     * @throws \SendGrid\Mail\TypeException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Container $container)
    {
        if ($request->getMethod() === 'GET') {
            $objectif = $this->objectif->allObjectif();
            $formation =$this->formation->allFormation();
            $view = $container->get(RenderInterface::class)->render('Home/home', ['objectif' => $objectif, 'formation' => $formation]);
            $response->getBody()->write($view);
            return $response;
        }

        $name = $this->getField('name');
        //$firstName = $this->getField('firstname');
        $email = $this->getField('email');
        $message = $this->getField('message');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setFlash("danger", "Votre adresse n'est pas valide");
            return new Response(301, [
                'Location' => '/#contact'
            ]);
        }

        $nameLength = strlen($name);
        if (empty($name) || $nameLength < 4) {
            $this->setFlash("danger", "Votre nom doit contenir au moins 4 caractères ou ne doit pas être vide");
            return new Response(301, [
                'Location' => '/#contact'
            ]);
        }

        //$firstNameLength = strlen($firstName);
        //if (empty($firstName) || $firstNameLength < 4 ) {
            //$this->setFlash("danger", "Votre nom doit contenir au moins 4 caractères ou ne doit pas être vide");
            //return new Response(301, [
                //'Location' => '/#contact'
            //]);
        //}

        $messageLength = strlen($message);
        if ($messageLength < 10) {
            $this->setFlash("danger", "Votre message doit contenir au minimum 50 caractères");
            return new Response(301, [
                'Location' => '/#contact'
            ]);
        }

        $from = [
            'email' => 'jerome.sauvage@etu.unilim.fr',
            'name' => 'portfolio',
        ];
        $to = [
            'email' => $email,
            'name' =>  explode('@', $email)[0],
        ];

        $result = $this->mailHelper->sendMail('Confirmation de votre message', $from, $to, 'Mails/verify');
        if ($result->statusCode() === 202) {
            $this->setFlash('success', 'Merci pour votre message nous vous répondrons dans les meilleures délais.');
        }

        return new Response(301, [
            'Location' => '/'
        ]);
    }
}
