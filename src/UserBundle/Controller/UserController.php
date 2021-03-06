<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**
     * Affiche les factures d'un utilisateur
     * @return Response
     */
    public function facturesAction()
    {
        return $this->render('@User/User/facture.html.twig', array(
            'factures' => $this->get('commande_manager')
                ->getRepository()
                ->getFacturesByUser($this->getUser())
        ));
    }

    /**
     * Imprime la facture d'un utilisateur
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function facturesPDFAction($id)
    {
        $user = $this->getUser();
        $facture = $this->get('commande_manager')->getRepository()->findOneBy(
            array('user' => $user,
            'valid' => 1,
            'id' => $id));

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirectToRoute('user_facture');
        }

        $view = $this->render('@User/User/facturePDF.html.twig', array('facture' => $facture));
        $parameters  = array('filename' => sprintf('facture_%s_%s', $user->getUsername(), $facture->getReference()));
        return $this->get('generate_facture_pdf')->genratePdf($view, $parameters);
    }
}
