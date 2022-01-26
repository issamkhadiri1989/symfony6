<?php

declare(strict_types=1);

namespace App\Acme\TestBundle\Service;

class Acme
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }
}
