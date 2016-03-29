<?php

namespace Ecommerce\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceBackBundle:Default:index.html.twig');
    }
}
