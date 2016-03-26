<?php

namespace Ecommerce\EcommerceBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Ecommerce\EcommerceBundle\Services\ProduitManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ProduitHandler extends BaseHandler
{
    protected $form;
    protected $produit;
    protected $produitManager;

    public function __construct(Form $form,  ProduitManager $produitManager){
        $this->form = $form;
        $this->produitManager = $produitManager;
    }

    public function onSuccess(){
        $produit = $this->form->getData();
        $this->produit = $this->produitManager->doPersist($produit);
    }
}