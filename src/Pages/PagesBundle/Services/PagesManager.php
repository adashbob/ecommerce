<?php


namespace Pages\PagesBundle\Services;


use Pages\PagesBundle\Entity\BaseEntity;

abstract class PagesManager
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