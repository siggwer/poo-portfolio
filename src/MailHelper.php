<?php

namespace Framework;

use Framework\Render\RenderInterface;
use SendGrid\Mail\Mail;

class MailHelper
{
    /**
     * @var $sendgridApiKey
     */
    private $sendGridApiKey;

    /**
     * @var RenderInterface
     */
    private $render;

    /**
     * MailHelper constructor.
     *
     * @param string $sendgridApiKey
     * @param RenderInterface $render
     */
    public function __construct(string $sendGridApiKey, RenderInterface $render) {

        $this->sendgridApiKey = $sendGridApiKey;
        $this->render = $render;
    }

    /**
     * @param string $subject
     * @param array $from
     * @param array $to
     * @param string $template
     *
     * @return \SendGrid\Mail\Mail
     *
     * @throws \SendGrid\Mail\TypeException
     */
    private function builtMail(string $subject, array $from, array $to, string $template) {

        $email = new Mail();
        $email->setFrom($from['email'],$from['name']);
        $email->setSubject($subject);
        $email->addTo($to['email'], $to['name']);
        $email->addContent(
            "text/html", $this->render->render($template)
        );

        return $email;
    }

    /**
     * @param string $subject
     * @param array $from
     * @param array $to
     * @param string $template
     *
     * @return \SendGrid\Response
     *
     * @throws \SendGrid\Mail\TypeException
     */
    public function sendMail(string $subject, array $from, array $to, string $template) {

        $mail = $this->builtMail($subject, $from, $to, $template);

        try{
            return $this->getSendGrid()->send($mail);

        } catch (\Exception $e){
            echo 'Caught exception: '. $e->getMessage() ."\n";
            exit;
        }
    }

    /**
     * @return \SendGrid
     */
    private function getSendGrid() {

        return new \SendGrid($this->sendgridApiKey);
    }
}