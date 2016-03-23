<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
    public function menuAction()
    {
        return $this->render('EcommerceBundle:Categorie:_menu.html.twig', array(
            // ...
        ));
    }

}
