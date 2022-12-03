<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[AsEventListener()]
class ExceptionEventListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $error = $event->getThrowable();
        if (!$error instanceof NotFoundHttpException) {
            return;
        }

        $request = $event->getRequest();
        $acceptLanguageHeader = $request->headers->get('Accept-Language');
        $languages = explode(',', $acceptLanguageHeader);
        $language = str_replace('-', '_', explode(';', $languages[0])[0]);

        if (!str_starts_with($request->getPathInfo(), "/$language")) {
            $response = new Response(status: 302);
            $response
                ->headers
                ->add(['Location' => "/$language" . $request->getPathInfo()]);

            $event->setResponse($response);
        }
    }
}
