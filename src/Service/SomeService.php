<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Security\Core\Security;

class SomeService
{
    public function __construct(private Security $security)
    {
    }

    public function someDummyMethod()
    {
        if (true === $this->security->isGranted('...')) {
            // ... do stuff only if granted
        }
    }
}