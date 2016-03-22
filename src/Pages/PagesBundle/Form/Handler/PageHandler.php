<?php

namespace Pages\PagesBundle\Form\Handler;

use Pages\PagesBundle\Services\PageManager;
use Symfony\Component\Form\Form;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PageHandler extends BaseHandler
{
    protected $form;
    protected $page;
    protected $pageManager;

    public function __construct(Form $form,  PageManager $pageManager){
        $this->form = $form;
        $this->pageManager = $pageManager;
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
        $page = $this->form->getData();
        $this->page = $this->pageManager->doPersist($page);
    }

    public function getFrom(){
        return $this->form;
    }

    public function createView(){
        return $this->form->createView();
    }

}