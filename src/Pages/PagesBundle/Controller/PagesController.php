<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function pageAction($id)
    {
        return $this->render('@Pages/Pages/page.html.twig', array(
            // ...
        ));
    }

    public function menuAction()
    {
        return $this->render('@Pages/Pages/_menu.html.twig', array(
            // ...
        ));
    }

}
