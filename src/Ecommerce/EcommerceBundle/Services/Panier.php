<?php


namespace Ecommerce\EcommerceBundle\Services;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class Panier
{
    private $request;
    private $session;
    private $panier;

    public function __construct(RequestStack $requestStack, Session $session)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->session = $session;

    }

    public function addProduit($id)
    {
        $this->panier =  $this->get('panier');
        $value = $this->request->query->get('qte');

        if (array_key_exists($id, $this->panier)) {
            $this->panier[$id] = $value ? $value : null;
        } else {
            $this->panier[$id] = $value ?  $value : 1;
        }

        $this->session->set('panier', $this->panier);
        $this->session->getFlashBag()->set('success', 'Article ajouté avec success');
    }

    public function removeProduit($id)
    {
        $this->panier = $this->get('panier');
        if (array_key_exists($id, $this->panier)) {
            unset($this->panier[$id]);
            $this->session->set('panier', $this->panier);
            $this->session->getFlashBag()->set('success', 'Article supprimé avec success');
        }
    }

    public function get($key){
        $session = $this->session;
        return $session->has($key) ? $session->get($key) : $this->addKey($key);
    }

    private function addKey($key)
    {
        $this->session->set($key, array());
        return $this->session->get($key);
    }


    public function has($key){
        $session = $this->session;
        return $session->has($key) ? $session->get($key) : false;
    }

    public function count($key){

         return $this->session->has($key) ? count($this->session->get($key)) : 0;
    }

    public function set($key, $value)
    {
        $this->session->set($key, $value);
    }

}