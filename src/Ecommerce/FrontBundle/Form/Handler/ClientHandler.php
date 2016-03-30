<?php

namespace Ecommerce\FrontBundle\Form\Handler;

use Ecommerce\FrontBundle\Services\ClientManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ClientHandler extends BaseHandler
{
    protected $form;
    protected $client;
    protected $clientManager;

    public function __construct(Form $form,  ClientManager $clientManager, $type){
        $this->form = $form;
        $this->clientManager = $clientManager;
        $this->type = $type;
    }

    public function onSuccess(){
        $client = $this->form->getData();
        $client->setUser($this->security->getToken()->getUser());
        $this->client = $this->clientManager->doPersist($client);
    }


}