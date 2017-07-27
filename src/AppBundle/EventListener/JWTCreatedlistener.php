<?php 

namespace AppBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedlistener {
/**
 * @var RequestStack
 */
private $requestStack;

/**
 * @param RequestStack $requestStack
 */
public function __construct(RequestStack $requestStack)
{
    $this->requestStack = $requestStack;
}

/**
 * @param JWTCreatedEvent $event
 *
 * @return void
 */
public function onJWTCreated(JWTCreatedEvent $event)
{
    $request = $this->requestStack->getCurrentRequest();
    $expiration = new \DateTime('+1 day');
    $expiration->setTime(2, 0, 0);
    $payload       = $event->getData();
    $payload['ip'] = $request->getClientIp();
    $payload['exp'] = $expiration->getTimestamp();

    $event->setData($payload);
    
    
}

}