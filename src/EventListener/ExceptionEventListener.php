<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionEventListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // enviar minha exceção para New Relic
        $errorMessage = $event->getThrowable()->getMessage();

        $response = new Response();
        $response->setContent($errorMessage);
        $response->setStatusCode(501);

        $event->setResponse($response);
    }
}
