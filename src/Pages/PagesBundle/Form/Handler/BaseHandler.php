<?php

namespace Pages\PagesBundle\Form\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

abstract class BaseHandler
{
    protected $request;
    protected $security;
    protected $container;
    protected $type;

    /**
     * calls: - [setRequest, ['@service_container']]
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container){
        $this->security = $container->get('security.token_storage');
        $this->request = $container->get('request_stack')->getCurrentRequest();
        $this->container = $container;
    }

    /**
     * @return bool
     */
    private function process(){
        $this->form->handleRequest($this->request);
        if($this->request->isMethod('post') && $this->form->isValid()){
            $this->onSuccess();
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * @param $entity
     * @return bool
     */
    public function isEdit($entity){
        $this->createForm($entity);
        $this->form->add('submit', SubmitType::class, array('label' => 'Update'));
        return $this->process();
    }

    /**
     * @return bool
     */
    public function isCreated(){
        $this->form->add('submit', SubmitType::class, array('label' => 'Add'));
        return $this->process();
    }


    /**
     * @return mixed
     */
    public function getFrom(){
        return $this->form;
    }

    /**
     * @return mixed
     */
    public function createView(){
        return $this->form->createView();
    }


    /**
     * @return mixed
     */
    public function isDelete($entity){
        $this->createForm($entity);
        $this->form->add('submit', SubmitType::class, array('label' => 'Delete'));
        $this->process();
    }

    /**
     * @param $entity
     */
    private function createForm($entity){
        $this->form = $this->container->get('form.factory')->create($this->type, $entity);
    }

    /**
     * @return mixed
     */
    public abstract function onSuccess();

}