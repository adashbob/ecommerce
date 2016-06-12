<?php

namespace Ecommerce\BackBundle\Controller;

use Ecommerce\FrontBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@EcommerceBack/Produit/index.html.twig', array(
            'entities' => $this->get('produit_manager')->getAll(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|
     */
    public function createAction()
    {
        $produitHandler = $this->get('produit_handler');

        if ($produitHandler->isCreated()) {
            return $this->redirectToRoute('back_produits_show', array(
                'id' => $produitHandler->getProduit()->getId()
            ));
        }

        return $this->render('@EcommerceBack/Produit/create.html.twig', array(
            'form'   => $produitHandler->createView(),
        ));
    }


    /**
     * @param Produit $produit
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Produit $produit)
    {
        if (!$produit) {
            throw $this->createNotFoundException('Le produit n\'existe pas.');
        }

        return $this->render('@EcommerceBack/Produit/show.html.twig', array(
            'entity'      => $produit,
            'delete_form' => $this->createDeleteForm($produit)->createView()
        ));
    }


    /**
     * @param Produit $produit
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Produit $produit)
    {
        $produitHandler = $this->get('produit_handler');
        $deleteForm = $this->createDeleteForm($produit);

        if ($produitHandler->isEdit($produit)) {
            return $this->redirectToRoute('back_produits_show', array('id' => $produit->getId()));
        }

        return $this->render('@EcommerceBack/Produit/edit.html.twig', array(
            'entity'      => $produit,
            'edit_form'   => $produitHandler->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @param Produit $produit
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Produit $produit)
    {
        if(!$produit){
            return $this->createNotFoundException('Le produit n\'existe pas');
        }

        $produitHandler = $this->get('produit_handler');

        if ($produitHandler->isDelete($produit)) {
            $this->get('session')->getFlashBag()->add('success', 'Le produit est supprimé avec succès');
        }

        return $this->redirectToRoute('back_produits');
    }


    /**
     * @param Produit $produit
     * @return $this|\Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this
            ->get('produit_handler')
            ->createDeleteForm($this->generateUrl('back_produits_delete', array('id' => $produit->getId())));
    }

}
