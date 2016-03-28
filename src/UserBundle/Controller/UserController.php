<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /*public function villesAction(Request $request,$cp)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $villeCodePostal = $em->getRepository('UtilisateursBundle:Villes')->findBy(array('villeCodePostal' => $cp));

            if ($villeCodePostal) {
                $villes = array();
                foreach($villeCodePostal as $ville) {
                    $villes[] = $ville->getVilleNom();
                }
            } else {
                $ville = null;
            }

            $response = new JsonResponse();
            return $response->setData(array('ville' => $villes));
        } else {
            throw new \Exception('Erreur');
        }
    }*/

    public function facturesAction()
    {
        return $this->render('@User/User/facture.html.twig', array(
            'factures' => $this->get('commande_manager')->getRepository()->getFacturesByUser($this->getUser())
        ));
    }

    public function facturesPDFAction($id)
    {
        $facture = $this->get('commande_manager')->getRepository()->findOneBy(
            array('user' => $this->getUser(),
            'valid' => 1,
            'id' => $id));

        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirectToRoute('user_facture');
        }

        $this->get('generate_facture_pdf')->facture($facture)->Output('Facture.pdf');

        $response = new Response;
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;
    }
}
