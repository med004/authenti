<?php 

namespace AppBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

class JWTDecodedlistener {

	/**
 * @param JWTDecodedEvent $event
 *
 * @return void
 */
public function onJWTDecoded(JWTDecodedEvent $event)
{
    $request = $this->requestStack->getCurrentRequest();
    
    $payload = $event->getPayload();

    if (!isset($payload['ip']) || $payload['ip'] !== $request->getClientIp()) {
        $event->markAsInvalid();
    }
}

}