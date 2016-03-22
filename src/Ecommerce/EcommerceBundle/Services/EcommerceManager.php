<?php


namespace Ecommerce\EcommerceBundle\Services;


use Ecommerce\EcommerceBundle\Entity\BaseEntity;

abstract class EcommerceManager
{

    public function doPersist(BaseEntity $entity)
    {
        $this->doFlush($entity);
        return $entity;
    }

    public function doFlush(BaseEntity $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function getAll(){
        return $this->repository->findAll();
    }
}