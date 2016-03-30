<?php

namespace Ecommerce\FrontBundle\Form\Handler;

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
        $this->form->add('valider', SubmitType::class);
        return $this->form->createView();
    }

    /**
     * @return mixed
     */
    public function createEditView($entity){
        $this->form = $this->container->get('form.factory')->create($this->type, $entity);
        $this->form->add('Modifier', SubmitType::class);
        return $this->form->createView();
    }

    /**
     * @return mixed
     */
    public abstract function onSuccess();

}