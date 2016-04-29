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
     * @param $entities
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function doPagination($entities)
    {
        return $this->knpPaginator->paginate($entities, $this->request->query->get('page', 1), 6);
    }
}