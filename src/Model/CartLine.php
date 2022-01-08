<?php

declare(strict_types=1);

namespace App\Model;

class CartLine
{
    public function __construct(private string $label)
    {
    }
}