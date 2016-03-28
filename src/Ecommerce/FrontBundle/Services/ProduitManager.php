<?php

namespace Ecommerce\FrontBundle\Services;


class ProduitManager extends EcommerceManager
{

    public function getProduit($id)
    {
        return $this->repository->find($id);
    }

    public function getAvailableProducts()
    {
        return $this->repository->findBy(array('available' => 1));
    }

    public function findProduitsInArray($array)
    {
        return $this->repository->findProduitsInArray($array);
    }



}