<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction(){

        return $this->render('@Ecommerce/Panier/Includes/_menu.html.twig', array(
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
            ->getRepository()
            ->findProduitsInArray(array_keys($panier));

        return $this->render('@Ecommerce/Panier/panier.html.twig', array(
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
        return $this->render('@Ecommerce/Panier/livraison.html.twig', array(
            'form' => $clientHandler->createView(),
            'utilisateur' => $this->getUser()
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validationAction()
    {
        if ($this->get('request_stack')->getCurrentRequest()->getMethod() == 'POST')
            $this->setLivraisonOnSession();

        $adresse = $this->get('panier_session')->get('adresse');
        $array = array_keys($this->get('panier_session')->get('panier'));

        return $this->render('@Ecommerce/Panier/validation.html.twig', array(
            'produits' => $this->get('produit_manager')->findProduitsInArray($array),
            'livraison' => $this->get('client_manager')->getClient($adresse['livraison']),
            'facturation' => $this->get('client_manager')->getClient($adresse['facturation']),
            'panier' => $this->get('panier_session')->get('panier')
        ));
    }

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
