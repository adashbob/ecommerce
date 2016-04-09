<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('UserBundle:UserAdmin:index.html.twig', array(
            'utilisateurs' => $utilisateurs
        ));
    }

    public function utilisateurAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UserBundle:User')->find($id);
        $route = $this->get('request_stack')->getCurrentRequest()->get('_route');

        if ($route == 'adminUser_adresses')
            return $this->render('UserBundle:UserAdmin:adresses.html.twig', array('utilisateur' => $utilisateur));
        else if ($route == 'adminUser_factures')
            return $this->render('UserBundle:UserAdmin:factures.html.twig', array('utilisateur' => $utilisateur));
        else
            throw $this->createNotFoundException('La vue n\'existe pas.');
    }
}
