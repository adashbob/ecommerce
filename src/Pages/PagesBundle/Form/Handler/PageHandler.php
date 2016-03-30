<?php

namespace Pages\PagesBundle\Form\Handler;

use Pages\PagesBundle\Services\PageManager;
use Symfony\Component\Form\Form;

class PageHandler extends BaseHandler
{
    protected $form;
    protected $page;
    protected $pageManager;

    public function __construct(Form $form,  PageManager $pageManager, $type){
        $this->form = $form;
        $this->pageManager = $pageManager;
        $this->type = $type;
    }

    public function onSuccess(){
        $page = $this->form->getData();
        $this->page = $this->pageManager->doPersist($page);
    }

    public function getPage(){
        return $this->page;
    }


}