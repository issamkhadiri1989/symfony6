<?php

declare(strict_types=1);

namespace App\Model;

enum OrderStatus
{
    case Placed;
    case Canceled;
    case Pending;
    case Confirmed;
    case Shipped;
}
