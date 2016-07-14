<?php

namespace Ecommerce\FrontRestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{


    public function allAction()
    {
        return  $this->getDoctrine()->getRepository('EcommerceFrontBundle:Produit')->findAll();

    }

    public function getAction($id){
        $produit =  $this->get('produit_manager')->getProduit($id);
        if(!$produit){
            return array('Response' => 'Le produit n\'existe pas');
        }
        return $produit;
    }

    public function getLimitAction($limit)
    {
        return $this->getDoctrine()
            ->getRepository('EcommerceFrontBundle:Produit')
            ->findBy(array(), null, $limit);
    }
}
