<?php

namespace Ecommerce\EcommerceBundle\Services;


class CommandeManager extends EcommerceManager
{

    public function getCommande($id)
    {
        return $this->repository->find($id);
    }


}