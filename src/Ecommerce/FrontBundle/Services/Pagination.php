<?php


namespace Ecommerce\FrontBundle\Services;


use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\RequestStack;

class Pagination
{
    private $knpPaginator;
    private $request;

    public function __construct(Paginator $paginator, RequestStack $requestStack)
    {
        $this->knpPaginator = $paginator;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param $entity
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function doPagination($entity)
    {
        return $this->knpPaginator->paginate($entity, $this->request->query->get('page', 1), 3);;
    }
}