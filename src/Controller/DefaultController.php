<?php

declare(strict_types=1);

namespace App\Controller;

use App\Acme\TestBundle\Service\Acme;
use App\Service\Injectable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route("/",name: "home")]
    public function index(Acme $service): Response
    {

        return new Response();
    }
}