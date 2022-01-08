<?php

declare(strict_types=1);

namespace App\Listener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        //... do something
    }

    public function logException(ExceptionEvent $event): void
    {
        // ... do some logic
    }
}