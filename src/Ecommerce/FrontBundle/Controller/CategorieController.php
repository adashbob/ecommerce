<?php

namespace Ecommerce\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction()
    {
        return $this->render('EcommerceFrontBundle:Categorie:_menu.html.twig', array(
            'categories' => $this->get('categorie_manager')->getAll()
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categorieProduitsAction($id)
    {
        $categorie = $this->get('categorie_manager')->getCategorie($id);

        if(!$categorie){
            throw $this->createNotFoundException('La catégorie n\'existe pas');
        }

        $produits = $categorie->getProduits();
        return $this->render('EcommerceFrontBundle:Produit:produits.html.twig', array(
            'produits' => $this->get('ecommerce_pagination')->doPagination($produits),
            'panier' => $this->get('panier_session')->has('panier')
        ));
    }

}
