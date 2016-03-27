<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
    public function menuAction()
    {
        return $this->render('EcommerceBundle:Categorie:_menu.html.twig', array(
            'categories' => $this->get('categorie_manager')->getAll()
        ));
    }

    public function categorieProduitsAction($id)
    {
        $categorie = $this->get('categorie_manager')->getCategorie($id);

        if(!$categorie){
            throw $this->createNotFoundException('La catégorie n\'existe pas');
        }
        return $this->render('EcommerceBundle:Produit:produits.html.twig', array(
            'produits' => $categorie->getProduits(),
            'panier' => $this->get('panier_session')->has('panier')
        ));
    }

}
