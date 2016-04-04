<?php

namespace Ecommerce\BackBundle\Controller;

use Ecommerce\FrontBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@EcommerceBack/Categorie/index.html.twig', array(
            'entities' => $this->get('categorie_manager')->getAll(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|
     */
    public function createAction()
    {
        $categorieHandler = $this->get('categorie_handler');

        if ($categorieHandler->isCreated()) {
            return $this->redirectToRoute('back_categorie_show', array('id' => $categorieHandler->getCategorie()->getId()));
        }

        return $this->render('@EcommerceBack/Categorie/new.html.twig', array(
            'form'   => $categorieHandler->createView(),
        ));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        return $this->render('@EcommerceBack/Categorie/new.html.twig', array(
            'form'   => $this->get('categorie_handler')->createNewForm()->createView()
        ));
    }

    /**
     * @param Categorie $categorie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Categorie $categorie)
    {
        if (!$categorie) {
            throw $this->createNotFoundException('Le Categorie n\'existe pas.');
        }

        return $this->render('@EcommerceBack/Categorie/show.html.twig', array(
            'entity'      => $categorie,
            'delete_form' => $this->createDeleteForm($categorie)->createView()
        ));
    }

    /**
     * @param Categorie $categorie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Categorie $categorie)
    {
        if (!$categorie) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $deleteForm = $this->createDeleteForm($categorie);
        return $this->render('@EcommerceBack/Categorie/edit.html.twig', array(
            'entity'      => $categorie,
            'edit_form'   => $this->get('categorie_handler')->createEditForm($categorie)->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @param Categorie $categorie
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Categorie $categorie)
    {
        $categorieHandler = $this->get('categorie_handler');
        $deleteForm = $this->createDeleteForm($categorie);

        if ($categorieHandler->isEdit($categorie)) {
            return $this->redirectToRoute('back_categorie_edit', array('id' => $categorie->getId()));
        }

        return $this->render('@EcommerceBack/Categorie/edit.html.twig', array(
            'entity'      => $categorie,
            'edit_form'   => $categorieHandler->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @param Categorie $categorie
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Categorie $categorie)
    {
        $categorieHandler = $this->get('categorie_handler');
        if ($categorieHandler->isDelete($categorie)) {
            $this->get('session')->getFlashBag()->add('success', 'Le Categorie est supprimé avec succès');
        }

        return $this->redirectToRoute('back_categorie');
    }


    /**
     * @param Categorie $categorie
     * @return $this|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Categorie $categorie)
    {
        return $this->get('categorie_handler')
            ->createDeleteForm($this->generateUrl('back_categorie_delete', array('id' => $categorie->getId())));
    }
}
