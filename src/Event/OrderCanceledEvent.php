<?php

declare(strict_types=1);

namespace App\Event;

use App\Model\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderCanceledEvent extends Event
{
    public const NAME = 'order.canceled';

    public function __construct(protected Order $order)
    {
    }

    /**
     * This is a simple getter to get the canceled order.
     *
     * @return Order the order instance
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}