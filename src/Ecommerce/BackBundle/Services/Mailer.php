<?php


namespace Ecommerce\BackBundle\Services;

use Symfony\Component\Templating\EngineInterface;
use UserBundle\Entity\User;

class Mailer
{
    private $mailer;
    private $templating;
    private $adminEmail;
    private $clientMail;
    private $subject;
    private $body;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $adminEmail)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }
    /**
     * @param $user
     */
    public function mailConfirm(User $user)
    {
        $this->clientMail = $user->getEmailCanonical();
        $this->subject = sprintf('Validation de votre commnde');
        $this->doTemplate('@EcommerceBack/Mailer/commandeConfirm.html.twig', array('utilisateur' => $user));
        $this->send();
    }
    /**
     * @param $templating
     * @param array $options
     */
    public function doTemplate($templating, array $options){
        $this->body = $this->templating->render($templating, $options);
    }

    /**
     * Send a mail confirmation
     */
    public function send(){
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom($this->adminEmail)
            //->setCc($this->adminEmail)
            ->setTo($this->clientMail)
            ->setCharset('utf-8')
            ->setBody($this->body);
        $this->mailer->send($message);
    }
}