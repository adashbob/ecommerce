<?php

namespace Ecommerce\EcommerceBundle\Form\Handler;

use Ecommerce\EcommerceBundle\Services\ClientManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ClientHandler extends BaseHandler
{
    protected $form;
    protected $client;
    protected $clientManager;

    public function __construct(Form $form,  ClientManager $clientManager){
        $this->form = $form;
        $this->clientManager = $clientManager;
    }

    public function onSuccess(){
        $client = $this->form->getData();
        $client->setUser($this->security->getToken()->getUser());
        $this->client = $this->clientManager->doPersist($client);
    }


}