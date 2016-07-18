<?php

namespace Ecommerce\FrontAngularBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceFrontAngularBundle::layout.html.twig');
    }
}
