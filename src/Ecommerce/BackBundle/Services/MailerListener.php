<?php


namespace Ecommerce\BackBundle\Services;

use Ecommerce\FrontBundle\Services\CommandeManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class MailerListener
{
    protected $commandeManager;
    protected $mailer;
    /**
     * @param Mailer $mailer
     * @param CommandeManager $commandeManager
     */
    public function __construct(Mailer $mailer, CommandeManager $commandeManager)
    {
        $this->commandeManager = $commandeManager;
        $this->mailer = $mailer;
    }
    /**
     * @param GetResponseEvent $event
     */
    public function process(GetResponseEvent $event)
    {
        $attributes = $event->getRequest()->attributes;
        if('user_commande_success' === $attributes->get('_route')){
            $this->doMail($attributes->get('id'));
        }
    }
    /**
     * @param $id
     */
    public function doMail($id){
        $this->mailer->mailConfirm($this->commandeManager->getCommande($id)->getUser());
    }
}