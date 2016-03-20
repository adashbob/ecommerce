<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function panierAction()
    {
        return $this->render('@Ecommerce/Panier/panier.html.twig', array(
            // ...
        ));
    }

    public function livraisonAction()
    {
        return $this->render('@Ecommerce/Panier/livraison.html.twig');
    }

    public function validationAction()
    {
        return $this->render('@Ecommerce/Panier/validation.html.twig');
    }

}
