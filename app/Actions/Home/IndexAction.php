<?php

namespace  App\Actions\Home;

use App\Service\ObjectifService;
use DI\Container;
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
     * IndexAction constructor.
     *
     * @param ObjectifService $objectif
     */
    public function __construct(MailHelper $mailHelper, ObjectifService $objectif)
    {
        $this->mailHelper = $mailHelper;
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
        if ($request->getMethod() === 'GET') {
            $objectif = $this->objectif->allObjectif();
            $view = $container->get(RenderInterface::class)->render('Home/home', ['objectif' => $objectif]);
            $response->getBody()->write($view);
            return $response;
        }

        $name = $this->getField('name');
        //$firstName = $this->getField('firstname');
        $email = $this->getField('email');
        $message = $this->getField('message');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->setFlash("danger", "Votre adresse n'est pas valide");
            return new Response(301, [
                'Location' => '/#contact'
            ]);
        }

        $nameLength = strlen($name);
        if (empty($name) || $nameLength < 4 ) {
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
        if ($messageLength < 50) {
            $this->setFlash("danger", "Votre message doit contenir au minimum 50 caractères");
            return new Response(301, [
                'Location' => '/#contact'
            ]);
        }

        // Connexion au smtp
        //$transport = $container->get(Swift_SmtpTransport::class);

        // Container du mail
        //$mailer = new Swift_Mailer($transport);

        // Le message à envoyer
        //$message = new Swift_Message($name);
        //$message
        //->setFrom(['localhost@test' => 'Admin'])
        //->setTo([$email => $name])
        //->setBody($content);

        //$result = $mailer->send($message);

        $from = [
            'email' => 'test@yopmail.com',
            'name' => 'admin',
        ];
        $to = [
            'email' => $email,
            'name' =>  explode('@', $email)[0],
        ];

        $result = $this->MailHelper->sendMail('Confirmation de votre message', $from, $to, 'mailVerify');
        if ($result->statusCode() === 202) {
            $this->setFlash('success', 'Merci pour votre message nous vous répondrons dans les meilleures délais');
        }

        return new Response(301,[
            'Location' => '/'
        ]);
    }
}
