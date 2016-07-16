<?php

namespace Ecommerce\FrontRestBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{


    /**
     * @ApiDoc(resource=true, description="Obtenir la liste des produits disponibles")
     * @return mixed
     */
    public function getProduitsAction()
    {
        return $this->get('produit_manager')->getAll();
    }

    /**
     * @ApiDoc(resource=true, description="Ajouter un produit")
     * @return mixed
     */
    public function postProduitsAction()
    {
    }

    /**
     * @ApiDoc(resource=true, description="Obtenir un produit par son id")
     */
    public function getProduitAction($id)
    {
        $produit =  $this->get('produit_manager')->getProduit($id);

        return $produit ? $produit : array('error' => 'Le produit n\'existe pas');
    }

    public function commentProduitAction($slug)
    {
    }
    /*public function findAction($id){
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
    }*/
}
