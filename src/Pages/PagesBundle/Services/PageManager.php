<?php

namespace Pages\PagesBundle\Services;

use Doctrine\ORM\EntityManager;

class PageManager extends PagesManager
{
    protected $repository;
    protected $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
        $this->repository = $em->getRepository('PagesBundle:Page');
    }


    public function getPage($id)
    {
        return $this->repository->find($id);
    }


}