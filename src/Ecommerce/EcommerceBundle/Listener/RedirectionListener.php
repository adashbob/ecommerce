<?php


namespace Ecommerce\EcommerceBundle\Listener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener
{
    protected $session;
    protected $securityContext;
    protected $route;

    public function __construct(ContainerInterface $containerInterface)
    {
        $this->session = $containerInterface->get('session');
        $this->securityContext = $containerInterface->get('security.token_storage');
        $this->route = $containerInterface->get('router');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');

        if($route == 'panier_livraison' || $route == 'panier_validation'){
            if ($this->session->has('panier')) {
                if (count($this->session->get('panier')) == 0)
                    $event->setResponse(new RedirectResponse($this->route->generate('panier_index')));
            }

            if (!is_object($this->securityContext->getToken()->getUser())) {
                $this->session->getFlashBag()->add('notification', 'Vous devez vous identifier');
                $event->setResponse(new RedirectResponse($this->route->generate('fos_user_security_login')));
            }
        }
    }



}