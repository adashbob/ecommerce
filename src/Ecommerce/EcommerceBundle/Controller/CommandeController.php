<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{

    public function validerCommandeAction($id)
    {
        $this->get('facturation')->validerCommande($id);
        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès');
        return $this->redirectToRoute('produit_produits');
    }

}
