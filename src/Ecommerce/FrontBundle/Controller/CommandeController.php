<?php

namespace Ecommerce\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{

    /**
     * Validation d'une commande
     * Redirection sur l'url user_commande_success pour executer l'evenement verification d'authen
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function validerCommandeAction($id)
    {
        $this->get('facturation')->validerCommande($id);
        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès');
        return $this->redirectToRoute('user_commande_success', array('id' => $id));
    }

    /**
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function successAction($id){
        return $this->redirectToRoute('user_facture');;
    }


}
