<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pages\PagesBundle\Entity\Page;


class PagesAdminController extends Controller
{

    public function indexAction()
    {
        return $this->render('@Pages/PagesAdmin/index.html.twig', array(
            'entities' => $this->get('page_manager')->getAll(),
        ));
    }


    public function newAction()
    {
        $pageHandler = $this->get('page_handler');
        if ($pageHandler->isCreated()) {
            return $this->redirectToRoute('adminPages_show', array('id' => $pageHandler->getPage()->getId()));
        }

        return $this->render('@Pages/PagesAdmin/new.html.twig', array(
            'form' => $pageHandler->createView()
        ));
    }

    public function showAction(Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);

        return $this->render('@Pages/PagesAdmin/show.html.twig', array(
            'entity' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    /*public function editAction(Request $request, Page $page)
    {
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm(PageType::class, $page);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            var_dump($editForm);
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('adminPages_edit', array('id' => $page->getId()));
        }
        //var_dump($page); die();
        return $this->render('@Pages/PagesAdmin/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    public function editAction(Page $page)
    {
        $pageHandler = $this->get('page_handler');
        if($pageHandler->isEdit($page)){
            return $this->redirectToRoute('adminPages_index');
        }
        return $this->render('@Pages/PagesAdmin/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $pageHandler->createView()
        ));
    }


    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('adminPages_index');
    }

    /**
     * Creates a form to delete a Page entity.
     *
     * @param Page $page The Page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminPages_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
