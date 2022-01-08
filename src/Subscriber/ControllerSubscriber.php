<?php

declare(strict_types=1);

namespace App\Subscriber;

//<editor-fold desc="Use statements">
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
//</editor-fold>

class ControllerSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => [
                ['beforeEvent', 10],
                ['processEvent', 20],
                ['afterEvent', 30],
            ],
        ];
    }

    /**
     * According to the priority, this method will be executed at the end as it has the lowest priority.
     */
    public function beforeEvent(ControllerEvent $event): void
    {
        //<editor-fold desc="//...">
        $method = __METHOD__;
        $controller = $event->getController();
        //</editor-fold>
        $isStopped = $event->isPropagationStopped();

    }

    /**
     * This will be executed after the `afterEvent` method.
     */
    public function processEvent(ControllerEvent $event): void
    {
        //<editor-fold desc="//...">
        $method = __METHOD__;
        $controller = $event->getController();
        //</editor-fold>
        $event->stopPropagation();
        $isStopped = $event->isPropagationStopped();
    }

    /**
     * This method will be executed as it has the highest priority.
     */
    public function afterEvent(ControllerEvent $event): void
    {
        //<editor-fold desc="//...">
        $method = __METHOD__;
        $controller = $event->getController();
        //</editor-fold>
        $isStopped = $event->isPropagationStopped();
    }
}