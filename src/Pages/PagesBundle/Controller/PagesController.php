<?php

namespace Pages\PagesBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws EntityNotFoundException
     */
    public function showAction($id)
    {
        $page = $this->get('page_manager')->getPage($id);

        if(!$page){
            throw $this->createNotFoundException('La page n\'existe pas');
        }
        return $this->render('@Pages/Pages/show.html.twig', array(
            'page' => $page
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction()
    {
        return $this->render('@Pages/Pages/_menu.html.twig', array(
            'pages' => $this->get('page_manager')->getAll()
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pagesAction(){
        return $this->render('@Pages/Pages/pages.html.twig', array(
            'pages' => $this->get('page_manager')->getAll()
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(){
        $pageHandler = $this->get('page_handler');

        if($pageHandler->process()){
            return $this->redirectToRoute('page_all');
        }
        return $this->render('PagesBundle:Pages:create.html.twig', array(
            'form' => $pageHandler->createView()
        ));
    }

}
