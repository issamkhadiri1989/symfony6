<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\OrderCanceledEvent;

class OrderCanceledListener
{
    /**
     * The default method being called as there is no `method` option in the listener declaration in services.yaml.
     *
     * @param OrderCanceledEvent $event The event being dispatched
     */
    public function onOrderCanceled(OrderCanceledEvent $event): void
    {
        $order = $event->getOrder();
        // ... do some logic
    }
}
