<?php

namespace Ecommerce\FrontBundle\Form\Handler;

use Ecommerce\FrontBundle\Services\CommandeManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CommandeHandler extends BaseHandler
{
    protected $form;
    protected $commande;
    protected $commandeManager;

    public function __construct(Form $form,  CommandeManager $commandeManager){
        $this->form = $form;
        $this->commandeManager = $commandeManager;
    }


    public function onSuccess(){
        $commande = $this->form->getData();
        $this->commande = $this->commandeManager->doPersist($commande);
    }

}