<?php

namespace Ecommerce\FrontBundle\Services;


class TvaManager extends EcommerceManager
{

    public function getTva($id)
    {
        return $this->repository->find($id);
    }


}