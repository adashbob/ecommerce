<?php

namespace Ecommerce\EcommerceBundle\Services;

use Doctrine\ORM\EntityManager;

class ProduitManager extends EcommerceManager
{
    protected $repository;
    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
        $this->repository = $em->getRepository('EcommerceBundle:Produit');
    }


    public function getProduit($id)
    {
        return $this->repository->find($id);
    }


}