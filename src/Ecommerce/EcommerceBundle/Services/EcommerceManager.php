<?php


namespace Ecommerce\EcommerceBundle\Services;


use Doctrine\ORM\EntityManager;

abstract class EcommerceManager
{
    protected $em;
    protected $repository;

    public function setEntityManager(EntityManager $em){
        $this->em = $em;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
}