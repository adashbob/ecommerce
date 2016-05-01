<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pages\PagesBundle\Entity\Page;


class PagesAdminController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Pages/PagesAdmin/index.html.twig', array(
            'entities' => $this->get('page_manager')->getAll(),
        ));
    }

    public function softDelAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $em->getFilters()->disable('softdeleteable');

        $entities = $em->getRepository('PagesBundle:Page')->findByRemove();

        return $this->render('@Pages/PagesAdmin/softDel.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function restoreAction($id)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $em->getFilters()->disable('softdeleteable');

        $entity = $em->getRepository('PagesBundle:Page')->find($id);
        $entity->setDeletedAt(null);
        $em->persist($entity);
        $em->flush();

        return $this->redirectToRoute('adminPages_softdel');
    }


    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $pageHandler = $this->get('page_handler');
        if ($pageHandler->isCreated()) {
            return $this->redirectToRoute('adminPages_show', array(
                'slug' => $pageHandler->getPage()->getSlug()
            ));
        }

        return $this->render('@Pages/PagesAdmin/new.html.twig', array(
            'form' => $pageHandler->createView()
        ));
    }

    /**
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Page $page)
    {
        if(!$page){
            throw $this->createNotFoundException('La page n\'existe pas');
        }
        $deleteForm = $this->createDeleteForm($page);
        return $this->render('@Pages/PagesAdmin/show.html.twig', array(
            'entity' => $page,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Page $page)
    {
        $pageHandler = $this->get('page_handler');
        if($pageHandler->isEdit($page)){
            return $this->redirectToRoute('adminPages_index');
        }
        return $this->render('@Pages/PagesAdmin/edit.html.twig', array(
            'page' => $page,
            'edit_form' => $pageHandler->createView(),
            'delete_form' => $this->createDeleteForm($page)->createView()
        ));
    }


    /**
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Page $page)
    {
        $pageHandler = $this->get('page_handler');
        if($pageHandler->isDelete($page)){
            $this->get('session')->getFlashBag()->add('success', 'La page est supprimée');
        }
        return $this->redirectToRoute('adminPages_index');
    }


    /**
     * @param Page $page
     * @return $this|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Page $page)
    {
        return $this->get('page_handler')
                    ->createDeleteForm($this->generateUrl('adminPages_delete', array('id' => $page->getId())));
    }
}
