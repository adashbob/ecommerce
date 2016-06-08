<?php


namespace Ecommerce\FrontBundle\Listener;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class UserAgentSubcriber implements EventSubscriberInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Afficher sur les logs les infos du système et du navigateur où s'éxécute l'appli
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->logger->info(
            sprintf('The user agent is: %s', $event->getRequest()->headers->get('User-Agent'))
        );
    }
    public static function getSubscribedEvents()
    {
        return array(
            'kernel.request' => 'onKernelRequest'
        );
    }

}