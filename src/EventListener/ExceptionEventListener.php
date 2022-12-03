<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener()]
class ExceptionEventListener
{
    public function __invoke(ExceptionEvent $event)
    {
        // enviar minha exceção para New Relic
        $errorMessage = $event->getThrowable()->getMessage();

        $response = new Response();
        $response->setContent($errorMessage);
        $response->setStatusCode(501);

        $event->setResponse($response);
    }
}
