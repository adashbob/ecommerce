<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Form\Type\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function produitsAction()
    {
        return $this->render('@Ecommerce/Produit/produits.html.twig', array(
            'produits' => $this->get('produit_manager')->getAvailableProducts(),
            'panier' => $this->get('panier_session')->has('panier')
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function presentationAction($id)
    {
        $produit = $this->get('produit_manager')->getProduit($id);
        if(!$produit){
            throw $this->createNotFoundException('Le produit n\'existe pas');
        }
        return $this->render('@Ecommerce/Produit/presentation.html.twig', array(
            'produit' => $produit,
            'panier' => $this->get('panier_session')->has('panier')
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rechercheAction()
    {
        $form = $this->createForm(RechercheType::class);
        return $this->renderViewSearch($form);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function traiterRechercheAction(Request $request)
    {
        $form = $form = $this->createForm(RechercheType::class);

        $form->handleRequest($request);
        if($request->isMethod('post') && $form->isValid()){
            $produits = $this->get('produit_manager')->getRepository()->recherche($form['recherche']->getData());
            return $this->render('@Ecommerce/Produit/produits.html.twig', array(
                'produits' => $produits,
                'panier' => $this->get('panier_session')->has('panier')
            ));
        }

        return $this->renderViewSearch($form);
    }

    /**
     * @param $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function renderViewSearch($form){
        return $this->render('@Ecommerce/Produit/_recherche.html.twig', array(
            'form' => $form->createView()
        ));
    }



}
