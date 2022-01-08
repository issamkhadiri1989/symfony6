<?php

declare(strict_types=1);

namespace App\Event;

/**
 * Contains all events thrown during order process.
 */
final class OrderEvents
{
    // thrown when an order is canceled
    public const CANCELED = 'order.canceled';

    // thrown when an order has been confirmed by the user
    public const CONFIRMED = 'order.confirmed';

    //thrown when a cart has been initiated
    public const CREATED = 'order.created';
}
