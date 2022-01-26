<?php


namespace App\Service;


use App\Acme\TestBundle\Service\Acme;

class Injectable
{
    public function __construct(Acme $acme)
    {
    }
}