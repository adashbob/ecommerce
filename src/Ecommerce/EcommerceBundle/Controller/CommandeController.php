<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function validerCommandeAction($id)
    {
        $this->get('facturation')->validerCommande($id);
        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès');
        return $this->redirectToRoute('user_facture');
    }

}
