<?php

namespace Ecommerce\FrontBundle\Controller;

use Ecommerce\FrontBundle\Entity\Produit;
use Ecommerce\FrontBundle\Form\Type\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProduitController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function produitsAction()
    {
        $produits = $this->get('produit_manager')->getAvailableProducts();

        return $this->render('@EcommerceFront/Produit/produits.html.twig', array(
            'produits' => $this->get('ecommerce_pagination')->doPagination($produits),
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
        return $this->render('@EcommerceFront/Produit/presentation.html.twig', array(
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
            $produits = $this->get('produit_manager')
                ->getRepository()
                ->recherche($form['recherche']->getData());

            return $this->render('@EcommerceFront/Produit/produits.html.twig', array(
                'produits' => $this->get('ecommerce_pagination')->doPagination($produits),
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
        return $this->render('@EcommerceFront/Produit/_recherche.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function jsonAction(Request $request)
    {
        $produit = new Produit();
        $produit->setName('patate');
        $produit->setPrice(2);
        $p = new Produit();

        $a1 = (array)$produit;
        $a2 = (array)$p;

        $data = array(
            'nom' => 'diallo',
            'prenom' => 'bobo',
            'adresse' => 'fass',
            'produit' => $produit,
            'iscom' => (array) $produit == (array) $p
        );
        /*$data = json_encode($data);
        $response = new Response($data);
        $response->headers->set('Context-Type', 'application/json');*/
        return new JsonResponse($data);


    }

}
