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
        return array(
            'produits' => $this->get('produit_manager')->getAvailableProducts(),
            'panier'   =>  $this->get('panier_session')->has('panier')
        );

    }


    /**
     * @ApiDoc(resource=true, description="Obtenir un produit par son id")
     */
    public function getProduitAction($id)
    {
        $id = (int) $id;

        $produit = $this->get('produit_manager')->getProduit($id);
        if(!$produit){
            return array('error' => 'Le produit n\'existe pas');
        }
        return array(
            'produit' => $produit,
            'panier' => $this->get('panier_session')->has('panier')
        );
    }

    /**
     * @ApiDoc(resource=true, description="Ajouter un produit")
     * @return mixed
     */
    public function postProduitsAction()
    {
    }

    public function commentProduitAction($slug)
    {
    }

}
