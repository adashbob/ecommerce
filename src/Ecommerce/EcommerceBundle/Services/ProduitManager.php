<?php

namespace Ecommerce\EcommerceBundle\Services;

use Doctrine\ORM\EntityManager;

class ProduitManager
{
    protected $repository;
    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
        $this->repository = $em->getRepository('EcommerceBundle:Produit');
    }

    public function doPersist($produit)
    {
        $this->doFlush($produit);
        return $produit;
    }

    public function doFlush($produit)
    {
        $this->em->persist($produit);
        $this->em->flush();
    }

    public function getAll(){
        return $this->repository->findAll();
    }

    public function getProduit($id)
    {
        return $this->repository->find($id);
    }

}