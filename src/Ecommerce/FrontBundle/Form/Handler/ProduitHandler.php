<?php

namespace Ecommerce\FrontBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Ecommerce\FrontBundle\Services\ProduitManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ProduitHandler extends BaseHandler
{
    protected $form;
    protected $produit;
    protected $produitManager;

    public function __construct(Form $form,  ProduitManager $produitManager, $type){
        $this->form = $form;
        $this->produitManager = $produitManager;
        $this->type = $type;
    }

    public function onSuccess(){
        $produit = $this->form->getData();
        $this->produit = $this->produitManager->doPersist($produit);
    }
}