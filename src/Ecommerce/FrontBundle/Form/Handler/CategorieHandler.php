<?php

namespace Ecommerce\FrontBundle\Form\Handler;

use Ecommerce\FrontBundle\Services\CategorieManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CategorieHandler extends BaseHandler
{
    protected $form;
    protected $categorie;
    protected $categorieManager;

    public function __construct(Form $form,  CategorieManager $categorieManager, $type){
        $this->form = $form;
        $this->categorieManager = $categorieManager;
        $this->type = $type;
    }



    public function onSuccess(){
        $categorie = $this->form->getData();
        $this->categorie = $this->categorieManager->doPersist($categorie);
    }

    public function getCategorie(){
        return $this->categorie;
    }

    public function onDelete($entity){
        $this->categorieManager->doRemove($entity);
    }



}