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


    public function process(){
        $this->form->handleRequest($this->request);

        if($this->request->isMethod('post') && $this->form->isValid()){
            $this->onSuccess();
            return true;
        }
        else{
            return false;
        }
    }

    public function onSuccess(){
        $produit = $this->form->getData();
        $this->produit = $this->produitManager->doPersist($produit);
    }

    public function getFrom(){
        return $this->form;
    }

    public function createView(){
        return $this->form->createView();
    }

}