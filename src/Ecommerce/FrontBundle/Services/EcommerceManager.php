<?php


namespace Ecommerce\FrontBundle\Services;


use Doctrine\ORM\EntityManager;
use Ecommerce\FrontBundle\Entity\BaseEntity;

abstract class EcommerceManager
{
    protected $em;
    protected $repository;

    /**
     * calls: [setEntityManager, ['@doctrine.orm.entity_manager']]
     * @param EntityManager $em
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * - [setRepository, [FrontBundle:Categorie]]
     * @param $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $this->em->getRepository($repository);
    }

    /**
     * @param BaseEntity $entity
     * @return BaseEntity
     */
    public function doPersist(BaseEntity $entity)
    {
        $this->doFlush($entity);
        return $entity;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param BaseEntity $entity
     */
    public function doFlush(BaseEntity $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->repository->findAll();
    }

    public function persit(BaseEntity $entity)
    {
        $this->em->persist($entity);
    }

    public function flushEntity()
    {
        $this->em->flush();
    }
}