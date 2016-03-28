<?php

namespace Ecommerce\FrontBundle\Services;


class CommandeManager extends EcommerceManager
{

    public function getCommande($id)
    {
        return $this->repository->find($id);
    }


}