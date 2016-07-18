<?php

namespace Ecommerce\FrontRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TodoController extends Controller
{
    public function backboneAction()
    {
        return $this->render('@EcommerceFrontRest/Todo/backbone.html.twig');
    }

    public function angularjsAction()
    {
        return $this->render('@EcommerceFrontRest/Todo/angularjs.html.twig');
    }
}
