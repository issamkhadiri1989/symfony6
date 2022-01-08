<?php

declare(strict_types=1);

namespace App\Subscriber;

//<editor-fold desc="Use statements">
use App\Event\OrderEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//</editor-fold>

class RequestSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'checkRequest',
        ];
    }

    public function checkRequest(RequestEvent $event): void
    {
        // ...
        $request = $event->getRequest();
        $requestType = $event->getRequestType();
        $isMain = $event->isMainRequest();
    }
}
