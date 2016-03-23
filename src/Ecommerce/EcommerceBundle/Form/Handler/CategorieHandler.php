<?php

namespace Ecommerce\EcommerceBundle\Form\Handler;

use Ecommerce\EcommerceBundle\Services\CategorieManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CategorieHandler extends BaseHandler
{
    protected $form;
    protected $categorie;
    protected $categorieManager;

    public function __construct(Form $form,  CategorieManager $categorieManager){
        $this->form = $form;
        $this->categorieManager = $categorieManager;
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
        $categorie = $this->form->getData();
        $this->categorie = $this->categorieManager->doPersist($categorie);
    }



}