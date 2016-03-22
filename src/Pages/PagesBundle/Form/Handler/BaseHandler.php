<?php

namespace Pages\PagesBundle\Form\Handler;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

abstract class BaseHandler
{
    protected $request;
    protected $security;

    public function setSecurity(TokenStorage $security){
        $this->security = $security;
    }

    public function setRequest(RequestStack $requestStack){
        $this->request = $requestStack->getCurrentRequest();
    }


}