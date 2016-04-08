<?php

namespace Ecommerce\BackBundle\Controller;

use Ecommerce\FrontBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function commandesAction()
    {
        return $this->render('@EcommerceBack/Commande/index.html.twig', array(
            'commandes' => $this->get('commande_manager')->getAll()
        ));
    }

    /**
     * @param Commande $commande
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showFactureAction(Commande $commande)
    {
        if (!$commande) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirectToRoute('back_commande');
        }
        $view = $this->render('@User/User/facturePDF.html.twig', array('facture' => $commande));
        $parameters  = array('filename' => sprintf('facture_%s_%s', $commande->getUser()->getUsername(), $commande->getReference()));

        return $this->get('generate_facture_pdf')->genratePdf($view, $parameters);
    }
}
