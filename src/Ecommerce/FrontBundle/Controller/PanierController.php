<?php

namespace Ecommerce\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction(){

        return $this->render('@EcommerceFront/Panier/Includes/_menu.html.twig', array(
            'articles' => $this->get('panier_session')->count('panier')
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajouterProduitAction($id){

        $this->get('panier_session')->addProduit($id);

        return $this->redirectToRoute('panier_index');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function supprimerProduitAction($id)
    {
        $this->get('panier_session')->removeProduit($id);

        return $this->redirectToRoute('panier_index');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function panierAction()
    {
        $panier = $this->get('panier_session')->get('panier');
        $produits = $this->get('produit_manager')
            ->findProduitsInArray(array_keys($panier));

        return $this->render('@EcommerceFront/Panier/panier.html.twig', array(
            'produits' => $produits,
            'panier' => $panier
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function livraisonAction()
    {
        $clientHandler = $this->get('client_handler');
        if($clientHandler->process()){
            $this->redirectToRoute('panier_livraison');
        }
        return $this->render('@EcommerceFront/Panier/livraison.html.twig', array(
            'form' => $clientHandler->createView(),
            'utilisateur' => $this->getUser()
        ));
    }

    /**
     * Facture la commande
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validationAction()
    {
        if ($this->get('request_stack')->getCurrentRequest()->getMethod() == 'POST')
            $this->setLivraisonOnSession();

        return $this->render('@EcommerceFront/Panier/validation.html.twig', array(
            'commande' => $this->get('facturation')->prepareCommande()
        ));
    }

    /**
     * Met les adresses de livraison et de facturation en session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function setLivraisonOnSession()
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        $panierSession = $this->get('panier_session');
        $adresse = $panierSession->get('adresse');

        if ($request->get('livraison') != null && $request->get('facturation') != null)
        {
            $adresse['livraison'] = $request->get('livraison');
            $adresse['facturation'] = $request->get('facturation');

        } else {
            return $this->redirectToRoute('panier_validation');
        }

        $panierSession->set('adresse', $adresse);
        return $this->redirectToRoute('panier_validation');
    }

}
