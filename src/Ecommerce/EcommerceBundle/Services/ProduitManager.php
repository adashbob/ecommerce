<?php

namespace Ecommerce\EcommerceBundle\Services;


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



}