<?php

namespace Ecommerce\FrontRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route(name="admin", path="/adminrest")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('EcommerceFrontRestBundle:Default:index.html.twig');
    }
}
