<?php

namespace Ecommerce\EcommerceBundle\Services;


class ProduitManager extends EcommerceManager
{

    public function getProduit($id)
    {
        return $this->repository->find($id);
    }


}