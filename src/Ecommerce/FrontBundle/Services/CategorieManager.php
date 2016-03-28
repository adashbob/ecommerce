<?php

namespace Ecommerce\FrontBundle\Services;


class CategorieManager extends EcommerceManager
{

    public function getCategorie($id)
    {
        return $this->repository->find($id);
    }


}